<?php
namespace frontend\models;

use Yii;
use yii\web\Request;
use yii\base\InvalidArgumentException;
use yii\base\Model;

use common\models\User;
use common\models\ManageUser;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $cNewPassword;

    /**
     * @var \common\models\ManageUser
     */
    private $_user;

    public function __construct()
    {
        parent::__construct();
    }




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['oldPassword', 'required','message'=>'Old Password is required'],
            ['newPassword', 'required','message'=>'New Password is required'],
            ['cNewPassword', 'required','message'=>'Confirm New Password is required'],
            ['cNewPassword', 'compare', 'compareAttribute'=>'newPassword','message'=>'New Password & confirm password not matched'],
            ['oldPassword', 'ValidateOldPassword'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Old Password',
            'newPassword' => 'New Password',
            'cNewPassword' => 'Confirm New Password'
        ];
    }

    public function ValidateOldPassword($attribute, $params){
        if(!($this->errors)){
            $user_id = Yii::$app->user->identity->id;
            $user = ManageUser::findOne(['id'=>$user_id]);
            if ( ($user) && !$this->validatePassword($this->oldPassword,$user->password_hash) ){
                $this->addError($attribute, 'Old password is incorrect.');
            }
        }
    }


    public function validatePassword($password,$current)
    {
        return Yii::$app->security->validatePassword($password, $current);
    }


    public function savePassword($password)
    {
        $user_id = Yii::$app->user->identity->id;
        $user = ManageUser::findOne(['id'=>$user_id]);
        if($user){
            $user->password_hash = Yii::$app->security->generatePasswordHash($password);
            if($user->save()){
                return true;
            }else{
                return false;
            }
        }
    }


}

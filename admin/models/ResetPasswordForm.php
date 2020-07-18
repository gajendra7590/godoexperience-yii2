<?php
namespace admin\models;
use Yii;
use yii\web\Request;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\helpers\SendEmail;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($config = [])
    {
       
        parent::__construct($config);
    }


    public function validateResetToken($token = ''){
        if (empty($token) || !is_string($token)) {
            return false;
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required','message'=>'Please enter your new password.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        $saved =  $user->save(false);
        if($saved){
            SendEmail::passwordChangeEmailNotification($user); 
        }
        return $saved;
    }
}

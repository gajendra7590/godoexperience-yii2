<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $bussiness_name
 * @property string $email
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $verification_token
 * @property string|null $profile_photo
 * @property int|null $phone_home
 * @property int|null $phone_office
 * @property string|null $gender
 * @property string|null $dob
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $zip
 * @property string|null $ip_address
 * @property string|null $social_google_uid
 * @property string|null $social_google_picture
 * @property string|null $social_google_last_login
 * @property string|null $social_fb_uid
 * @property string|null $social_fb_picture
 * @property string|null $social_fb_last_login
 * @property string|null $social_twitter_uid
 * @property string|null $social_twitter_picture
 * @property string|null $social_twitter_last_login
 * @property string|null $social_linkedin_uid
 * @property string|null $social_linkedin_picture
 * @property string|null $social_linkedin_last_login
 * @property string|null $social_github_uid
 * @property string|null $social_github_picture
 * @property string|null $social_github_last_login
 * @property int $status
 * @property int $role_id
 * @property string|null $last_login
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Experiences[] $experiences
 * @property UserRoles $role
 */
class ManageUser extends ActiveRecord
{
    public $temp_image;
    public $password;
    public $update_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'username','first_name','last_name'], 'required'],
            [['phone_home', 'phone_office', 'status', 'role_id'], 'integer'],
             [['phone_home','phone_office'], 'string', 'max' => 12],
             ['password', 'required','message'=>'Please choose the password', 'on' => 'create'], 
             ['email','email'],
             [['temp_image'], 'file', 'extensions' => 'png,jpg,jpeg','skipOnEmpty' => true, 'wrongExtension'=>'Allowed only {extensions} files',],
             [['zip','gender'], 'string', 'max' => 6],
             [['ip_address'], 'string', 'max' => 50],
             ['update_password', 'string', 'min' => 6, 'message' => 'Password length should be atliest 6'], 
             [['middle_name','bussiness_name','city','state','country','zip'], 'string', 'max' => 50],
             [['temp_image'], 'file', 'extensions' => 'png,jpg,jpeg','skipOnEmpty' => true, 'wrongExtension'=>'{extensions} files only',],
             [['city','state','country'], 'string', 'max' => 50],
             ['email', 'unique', 'targetClass' => '\common\models\ManageUser', 'message' => 'Email is already been taken.'],
             ['username', 'unique', 'targetClass' => '\common\models\ManageUser', 'message' => 'Username is already been taken'], 
            [['password_reset_token'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRoles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'bussiness_name' => 'Bussiness Name',
            'email' => 'Email',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'profile_photo' => 'Profile Photo',
            'phone_home' => 'Phone Home',
            'phone_office' => 'Phone Office',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zip' => 'Zip',
            'ip_address' => 'Ip Address',
            'social_google_uid' => 'Social Google Uid',
            'social_google_picture' => 'Social Google Picture',
            'social_google_last_login' => 'Social Google Last Login',
            'social_fb_uid' => 'Social Fb Uid',
            'social_fb_picture' => 'Social Fb Picture',
            'social_fb_last_login' => 'Social Fb Last Login',
            'social_twitter_uid' => 'Social Twitter Uid',
            'social_twitter_picture' => 'Social Twitter Picture',
            'social_twitter_last_login' => 'Social Twitter Last Login',
            'social_linkedin_uid' => 'Social Linkedin Uid',
            'social_linkedin_picture' => 'Social Linkedin Picture',
            'social_linkedin_last_login' => 'Social Linkedin Last Login',
            'social_github_uid' => 'Social Github Uid',
            'social_github_picture' => 'Social Github Picture',
            'social_github_last_login' => 'Social Github Last Login',
            'status' => 'Status',
            'role_id' => 'Role ID',
            'last_login' => 'Last Login',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'update_password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Experiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experiences::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRoles::className(), ['id' => 'role_id']);
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord){            
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s'); 
        }else{
            $this->updated_at = date('Y-m-d H:i:s');
        }             
        return parent::beforeSave($insert);
    }   

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }



    public function setUserRole($role = 3)
    {
        $this->role_id = $role;        
    }


}

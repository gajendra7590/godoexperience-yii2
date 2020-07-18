<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [        
            ['email', 'required','message' => 'Please enter your email addrees'],
            ['email', 'email','message' => 'Please enter valid email address'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            [ 'password', 'required','message' => 'Please enter your password'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();             

            //Account is not verified             
            if($user && $user->status == 0){
                $this->addError($attribute, 'Your account is not verified, please verify first.');
            } 
            
            //Check if email & password not match
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email address or password.');
            }

            
        }
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $login_status =  Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            if($login_status){
                $user->last_login = date('Y-m-d H:i:s');
                $user->save();
            } 
            return $login_status;
        }
        
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmailFrontEnd($this->email);
        }

        return $this->_user;
    }
}

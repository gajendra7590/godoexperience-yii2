<?php

namespace common\helpers;

use Yii; 
use common\models\User;

class SendEmail
{ 
    

     /**
     * Function for frontend
     * Function for send password reset token
     */

    public static function sendPasswordResetToken($email){  
       /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $email,
        ]); 

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName']])
            ->setTo($email)
            ->setSubject('Password reset for ' . Yii::$app->params['appName'])
            ->send();
    }

     /**
     * Function for frontend
     * Function for send account verify link after registration
     */

    public static function accountVerifyEmail($user){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'accountVerifyLink'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName'] ])
            ->setTo($user->email)
            ->setSubject('Your account created successfully at ' . Yii::$app->params['appName'])
            ->send(); 
    }

     /**
     * Function for frontend
     * Function for send success message after changed password
     */
    public static function passwordChangeEmailNotification($user){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordChangedSuccess'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName'] ])
            ->setTo($user->email)
            ->setSubject('Your password changed successfully at ' . Yii::$app->params['appName'])
            ->send(); 
    }
     
    /**
     * Function for frontend
     * Function for send success message after reset password
     */
    public static function passwordResetSuccessNotification($user){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetSuccess'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName'] ])
            ->setTo($user->email)
            ->setSubject('Your password changed successfully at ' . Yii::$app->params['appName'])
            ->send(); 
    }
 
    /**
     * Function for frontend
     * Function for send success email after verify account
     */
    public static function AccountSuccessNotification($user){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'accountSuccess'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName'] ])
            ->setTo($user->email)
            ->setSubject('Account Verified Success at ' . Yii::$app->params['appName'])
            ->send(); 
    }


    /**
     * Function for backend
     * Function for send contact us reply email
     */
    public static function ContactReply($contactData){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'contactReply'],
                ['contactData' => $contactData]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName'] ])
            ->setTo($contactData->contact_email)
            ->setSubject($contactData->reply_subject)
            ->send();
    }
 
    
     
}
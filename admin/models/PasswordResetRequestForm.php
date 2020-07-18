<?php
namespace admin\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required','message'=>'Please enter your registered email address'],
            ['email', 'email','message'=>'Please enter valid email address.'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'This email address is not associated with godo experience'
            ],
        ];
    } 
    
}

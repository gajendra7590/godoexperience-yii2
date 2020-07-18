<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property int $id
 * @property string $contact_name
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_message
 * @property string $contact_time
 * @property string $reply_subject
 * @property string $reply_email
 * @property string $reply_body
 * @property string $reply_time
 * @property int $reply_user
 * @property int $is_reply
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_name', 'contact_email','contact_phone','contact_message'], 'required','on' => ['contactForm'] ],
            [['reply_subject', 'reply_body'], 'required','on' => ['replyEmail'] ],
            [['contact_phone','is_reply','reply_user'], 'number'],
            [['contact_email'], 'email'],
            [['contact_time','reply_time'], 'safe'],
            [['contact_message','reply_body','reply_email','reply_subject'], 'string'],
            [['contact_name'], 'string', 'max' => 100],
            [['contact_email'], 'string', 'max' => 256],
        ];
    }


    // Before Save/Update Set Default values
    public function beforeSave($insert) {
        if ($this->isNewRecord){
            $this->contact_time = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }


//    public function validatePhone($attribute, $params){
//        echo $this->contact_phone;die;
//        if (!$this->hasErrors()) {
//
//            if(is_int($this->contact_phone)){
//                $this->addError($attribute, 'Phone field should allowed valid number.');
//
//            }
//
//        }
//
//    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_name' => 'Name',
            'contact_email' => 'Email',
            'contact_phone' => 'Phone',
            'contact_message' => 'Message',
            'contact_time' => 'Time',
            'is_reply' => 'Reply Status',
            'reply_time' => 'Reply Time',
            'reply_user' => 'Reply User',
        ];
    }
}

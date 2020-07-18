<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "testimonial".
 *
 * @property int $id
 * @property string|null $client_name
 * @property string|null $client_position
 * @property string|null $client_message
 * @property string|null $client_image
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Testimonial extends \yii\db\ActiveRecord
{
    public $tm_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testimonial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_name', 'client_position','client_message'], 'required'],
            [['client_message','client_image'], 'string'],
            [['tm_image'], 'file', 'extensions' => 'png,jpg,jpeg','skipOnEmpty' => true, 'wrongExtension'=>'{extensions} files only',],
            [['created_at', 'updated_at'], 'safe'],
            [['client_name', 'client_position'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Client Name',
            'client_position' => 'Client Profession',
            'client_message' => 'Client Message',
            'tm_image' => 'Client Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


     // Before Save/Update Set Default values
     public function beforeSave($insert) { 
        if ($this->isNewRecord){
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
        }else{
            $this->updated_at = date('Y-m-d H:i:s');
        }             
        return parent::beforeSave($insert);
    }

}

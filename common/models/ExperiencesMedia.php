<?php

namespace common\models;
use common\models\Experiences;

use Yii;

/**
 * This is the model class for table "experiences_media".
 *
 * @property int $id
 * @property int $image_name
 * @property int $experiences_id
 * @property string $image_url
 * @property string $uploaded_at
 *
 * @property Experiences $experiences
 */
class ExperiencesMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiences_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiences_id', 'image_name', 'image_url', 'uploaded_at'], 'required'],
            [['experiences_id'], 'integer'],
            [['uploaded_at'], 'safe'],
            [['image_url','image_name'], 'string', 'max' => 100],
            [['experiences_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiences::className(), 'targetAttribute' => ['experiences_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_name' => 'Image Name',
            'experiences_id' => 'Experiences ID',
            'image_url' => 'Image Url',
            'uploaded_at' => 'Uploaded At',
        ];
    }

     // Before Save/Update Set Default values
     public function beforeSave($insert) { 
        if ($this->isNewRecord){
            $this->uploaded_at = date('Y-m-d H:i:s'); 
        }             
        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[Experiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasOne(Experiences::className(), ['id' => 'experiences_id']);
    }
}

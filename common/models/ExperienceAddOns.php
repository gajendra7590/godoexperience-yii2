<?php

namespace common\models;
use common\models\Experiences;

use Yii;
use yii\db\ActiveRecord;
 

/**
 * This is the model class for table "experience_add_ons".
 *
 * @property int $id
 * @property int $experiences_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $price
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Experiences $experiences
 */
class ExperienceAddOns extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience_add_ons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiences_id'], 'required'],
            [['experiences_id', 'price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
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
            'experiences_id' => 'Experiences ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
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

    public function addOnsUpdate($data,$id){

    }

    public function addOnsCreate($data){
        
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

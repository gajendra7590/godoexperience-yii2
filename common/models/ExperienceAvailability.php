<?php

namespace common\models;

use common\models\Experiences;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "experience_availability".
 *
 * @property int $id
 * @property int $experiences_id
 * @property int $year
 * @property int $month
 * @property int $date
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Experiences $experiences
 */
class ExperienceAvailability extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience_availability';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiences_id','year','month','date'], 'required'],
            [['experiences_id','year','month','date'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'year' => 'Year',
            'month' => 'Month',
            'date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    // Before Save/Update Set Default values
    public function beforeSave($insert) { 
        if ($this->isNewRecord){
            $this->created_at = date('Y-m-d');
            $this->updated_at = date('Y-m-d');
        }else{
            $this->updated_at = date('Y-m-d');
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

<?php

namespace common\models;

use common\models\Experiences;
use common\models\User;

use Yii;

/**
 * This is the model class for table "experiences_saved".
 *
 * @property int $id
 * @property int $experiences_id
 * @property int $user_id
 * @property string|null $created_at
 *
 * @property Experiences $experiences
 * @property User $user
 */
class ExperiencesSaved extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiences_saved';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiences_id', 'user_id'], 'required'],
            [['experiences_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['experiences_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiences::className(), 'targetAttribute' => ['experiences_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    // Before Save/Update Set Default values
    public function beforeSave($insert) {
        if ($this->isNewRecord){
            $this->created_at = date('Y-m-d H:i:s');
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

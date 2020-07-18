<?php

namespace common\models;

use Yii;

use common\models\Experiences;
use common\models\ExperiencesPayment;
use common\models\User;
use common\models\ExperienceGuest;

/**
 * This is the model class for table "experiences_order".
 *
 * @property int $id
 * @property int $experience_id
 * @property int $user_id
 * @property int $payment_id
 * @property int $experience_price
 * @property int $experience_adons_price
 * @property int $net_pay
 * @property string|null $experience_adons_ids
 * @property string|null $experience_adons_detail
 * @property int $experience_avl_id
 * @property string|null $experience_start_date
 * @property string|null $experience_end_date
 * @property string|null $schedule_detail
 * @property int|null $total_guest_adults
 * @property int|null $total_guest_children
 * @property int|null $total_guest_infants Age under 2 years age
 * @property int|null $phone_number
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Experiences $experience
 * @property User $user
 * @property ExperiencesPayment $payment
 * @property ExperienceGuest $guest
 */
class ExperiencesOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiences_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experience_id', 'user_id','payment_id','experience_price','experience_adons_price','net_pay'], 'required'],
            [['experience_id', 'payment_id', 'experience_price', 'experience_adons_price', 'total_guest_adults', 'total_guest_children', 'total_guest_infants','experience_avl_id','phone_number'], 'integer'],
            [['experience_adons_detail'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['experience_adons_ids'], 'string', 'max' => 50],
            [['experience_start_date','experience_end_date'], 'date'],
            [['schedule_detail'], 'string', 'max' => 256],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiences::className(), 'targetAttribute' => ['experience_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExperiencesPayment::className(), 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'experience_id' => 'Experience ID',
            'user_id' => 'User ID',
            'payment_id' => 'Payment ID',
            'experience_price' => 'Experience Price',
            'experience_adons_price' => 'Experience Adons Cost',
            'experience_adons_ids' => 'Experience Adons Ids',
            'net_pay' => 'Total Pay',
            'experience_adons_detail' => 'Experience Adons Detail',
            'experience_avl_id'=> 'experience_avl_id',
            'experience_start_date' => 'Experience Start Date',
            'experience_end_date' => 'Experience End Date',
            'schedule_detail' => 'Schedule Detail',
            'total_guest_adults' => 'Total Guest Adults',
            'total_guest_children' => 'Total Guest Children',
            'total_guest_infants' => 'Total Guest Infants',
            'phone_number' => 'Phone Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function beforeSave($insert) {
        if ($this->isNewRecord){            
            $this->created_at = date('Y-m-d H:i:s');
        }else{
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
        }              
        return parent::beforeSave($insert);
    } 

    /**
     * Gets query for [[Experience]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperience()
    {
        return $this->hasOne(Experiences::className(), ['id' => 'experience_id']);
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

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(ExperiencesPayment::className(), ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[ExperienceGuest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(ExperienceGuest::className(), ['order_id' => 'id']);
    }
}

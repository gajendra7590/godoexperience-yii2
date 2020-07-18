<?php

namespace common\models;
use yii\db\ActiveRecord;

use Yii;

use common\models\Experiences;
use common\models\ExperiencesOrder;
use common\models\User;

/**
 * This is the model class for table "experiences_payment".
 *
 * @property int $id
 * @property string $payment_success_id
 * @property int $user_id
 * @property int $experience_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $payment_description
 * @property int|null $payment_amount
 * @property int|null $payment_created
 * @property string|null $payment_currency
 * @property string|null $payment_receipt_email
 * @property string|null $payment_receipt_url
 * @property string|null $payment_brand
 * @property int|null $payment_exp_month
 * @property int|null $payment_exp_year
 * @property int|null $payment_last4
 * @property string|null $payment_country
 * @property string|null $payment_network
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string|null $billing_country
 * @property string|null $billing_postal_code
 * @property string|null $billing_line1
 * @property string|null $billing_line2
 * @property int|null $payment_status 0=>failure,1=>success
 * @property string|null $created_at
 *
 * @property ExperiencesOrder[] $experiencesOrders
 * @property User $user
 * @property Experiences $experience
 */
class ExperiencesPayment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiences_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_success_id', 'user_id', 'experience_id'], 'required'],
            [['user_id', 'experience_id', 'payment_amount', 'payment_status'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'email', 'payment_brand', 'payment_country', 'billing_city', 'billing_state', 'billing_country', 'billing_postal_code', 'billing_line1', 'billing_line2'], 'string', 'max' => 50],
            [['payment_description','payment_receipt_email','payment_success_id'], 'string', 'max' => 100],
            [['payment_receipt_url'], 'string', 'max' => 256],
            [['payment_exp_month', 'payment_exp_year', 'payment_last4', 'payment_created'], 'integer'],
            [['payment_currency','payment_network'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiences::className(), 'targetAttribute' => ['experience_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_success_id' => 'Payment Success ID',
            'user_id' => 'User ID',
            'experience_id' => 'Experience ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'payment_description' => 'Payment Description',
            'payment_amount' => 'Payment Amount',
            'payment_created' => 'Payment Created',
            'payment_currency' => 'Payment Currency',
            'payment_receipt_url' => 'Payment Receipt Url',
            'payment_brand' => 'Payment Brand',
            'payment_exp_month' => 'Payment Exp Month',
            'payment_exp_year' => 'Payment Exp Year',
            'payment_last4' => 'Payment Last4',
            'payment_country' => 'Payment Country',
            'payment_network' => 'Payment Network',
            'billing_city' => 'Billing City',
            'billing_state' => 'Billing State',
            'billing_country' => 'Billing Country',
            'billing_postal_code' => 'Billing Postal Code',
            'billing_line1' => 'Billing Line1',
            'billing_line2' => 'Billing Line2',
            'payment_status' => 'Payment Status',
            'created_at' => 'Created At',
        ];
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord){            
            $this->created_at = date('Y-m-d H:i:s');
        }              
        return parent::beforeSave($insert);
    }   

    /**
     * Gets query for [[ExperiencesOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencesOrders()
    {
        return $this->hasMany(ExperiencesOrder::className(), ['payment_id' => 'id']);
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
     * Gets query for [[Experience]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperience()
    {
        return $this->hasOne(Experiences::className(), ['id' => 'experience_id']);
    }
}

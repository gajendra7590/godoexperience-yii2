<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $company_owner
 * @property string|null $company_name
 * @property string|null $company_logo
 * @property string|null $company_desc
 * @property string $company_phone
 * @property string $company_city
 * @property string $company_state
 * @property string $company_country
 * @property string $company_zip
 * @property string|null $company_full_address
 * @property string $company_email
 * @property string|null $company_instagram
 * @property string|null $company_facebook
 * @property string|null $company_twiiter
 * @property string|null $company_pinterest
 * @property int $status
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_owner','company_name', 'company_phone', 'company_city', 'company_state', 'company_country', 'company_zip', 'company_email'], 'required'],
            [['company_email'], 'email'],
            [['status'], 'integer'],
            [['company_owner', 'company_name', 'company_logo', 'company_desc', 'company_instagram', 'company_facebook', 'company_twiiter', 'company_pinterest'], 'string', 'max' => 100],
            [['company_phone', 'company_city', 'company_state', 'company_country', 'company_zip', 'company_full_address', 'company_email'], 'string', 'max' => 256],
        ];
    }

    // Before Save/Update Set Default values
    public function beforeSave($insert) {
        if ($this->isNewRecord){
            $this->status = 1;
        }
        $this->company_full_address = $this->company_city .' , '.$this->company_state.' '.$this->company_zip.' '.$this->company_country;
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_owner' => 'Owner Name',
            'company_name' => 'Company Name',
            'company_logo' => 'Company Logo',
            'company_desc' => 'About Company',
            'company_phone' => 'Phone Number',
            'company_city' => 'City',
            'company_state' => 'State',
            'company_country' => 'Country',
            'company_zip' => 'Zip',
            'company_full_address' => 'Full Address',
            'company_email' => 'Company Email',
            'company_instagram' => 'Instagram Link',
            'company_facebook' => 'Facebook Link',
            'company_twiiter' => 'Twiiter Link',
            'company_pinterest' => 'Pinterest Link',
            'status' => 'Status',
        ];
    }
}

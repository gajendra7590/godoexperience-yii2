<?php

namespace common\models;

use Yii;
use common\models\Categories;

/**
 * This is the model class for table "amenities".
 *
 * @property int $id
 * @property int $category_id
 * @property string $icon
 * @property string $title
 * @property string $description
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Categories $category
 */
class Amenities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amenities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'description'], 'required'],
            [['category_id', 'status'], 'integer'],
            ['icon', 'validateIcon'],
            [['created_at', 'updated_at'], 'safe'],
            [['icon', 'title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 256],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'icon' => 'Choose icon',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function validateIcon($attribute, $params){
        if (!$this->hasErrors()) {
            if ($this->icon == 'empty') {
                $this->addError($attribute, 'Please choose icon.');
            }
        }
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

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    public function getCategoryList(){
        $categories = Categories::find()->select('id, name')->where(['status'=>'1'])->asArray()->all();
        $new_array = [''=>'Select Category'];
        if(!empty($categories)){
            foreach($categories as $cat){
                $new_array[ $cat['id'] ] = $cat['name'];
            }
        }
        return $new_array;
    }
}

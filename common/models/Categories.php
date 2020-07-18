<?php

namespace common\models;
use common\models\Experiences;

use Yii;

/**
 * This is the model class for table "experience_categories".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string|null $description
 * @property string|null $slug
 * @property string|null $category_image_url
 * @property string|null $category_video_url
 * @property int|null $parent_id
 * @property int $status
 * @property int|null $featured
 * @property string|null $featured_date
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Experiences[] $experiences
 */
class Categories extends \yii\db\ActiveRecord
{    
    public $category_image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
             ['name', 'unique', 'targetClass' => '\common\models\Categories', 'message' => 'Category name already exist.'],
            [['category_image'], 'file', 'extensions' => 'png,jpg,jpeg','skipOnEmpty' => true, 'wrongExtension'=>'{extensions} files only',],
            [['description','slug'], 'string'],
            [['parent_id', 'status','featured'], 'integer'],
            [['created_at', 'updated_at','featured_date'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 256],
            [['category_image', 'category_video_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category Name',
            'title' => 'Category Title',
            'description' => 'Category Description',
            'category_image_url' => 'Category Image Url',
            'category_video_url' => 'Category Video Url',
            'parent_id' => 'Parent ID',
            'featured' => 'Featured Category',
            'status' => 'Category Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Experiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experiences::className(), ['category_id' => 'id']);
    }


    // Before Save/Update Set Default values
    public function beforeSave($insert) {
        $this->updateSlug();
        $this->featured_date = date('Y-m-d H:i:s');
        if ($this->isNewRecord){
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');            
        }else{ 
            $this->updated_at = date('Y-m-d H:i:s');
        }             
        return parent::beforeSave($insert);
    }

    public function updateSlug(){ 
        $slug =  trim($this->name);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $slug); 
        $slug = strtolower($slug); 
        $this->slug = $slug;
    }

    public function getUniqueFileName()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}

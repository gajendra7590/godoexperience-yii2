<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Categories;
use common\models\User;
use common\models\ExperienceAddOns;
use common\models\ExperienceAvailability;
use common\models\ExperiencesMedia;
use common\models\ExperiencesSaved;

/**
 * This is the model class for table "experiences".
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $sub_title
 * @property string|null $description
 * @property string|null $slug
 * @property string|null $experiences_image_url
 * @property string|null $experiences_video_url
 * @property int $price
 * @property int $duration
 * @property string $duration_type
 * @property int $group_size
 * @property string $activity_level
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $latitude
 * @property string $longitude
 * @property int $status
 * @property int $featured
 * @property string|null $featured_date
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Categories $category
 * @property User $user
 * @property ExperienceAddOns $adons
 * @property ExperienceAvailability $availability
 * @property ExperiencesMedia $media
 * @property ExperiencesSaved $saved
 */
class Experiences extends ActiveRecord
{
 
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiences';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title','price','duration','duration_type','group_size','activity_level'], 'required'],
             ['title', 'unique', 'targetClass' => '\common\models\Experiences', 'message' => 'Experience name is already exist'],
            [['image'], 'file', 'extensions' => 'png,jpg,jpeg','skipOnEmpty' => true, 'wrongExtension'=>'Only allowed {extensions} files'],
            [['category_id', 'user_id', 'status','featured','price','duration','group_size'], 'integer'],
            [['title', 'sub_title', 'description','slug','activity_level','country','state','city','latitude','longitude'], 'string'],
            [['created_at', 'updated_at','featured_date'], 'safe'],
            [['experiences_image_url', 'experiences_video_url'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Experience Category',
            'user_id' => 'User ID',
            'title' => 'Experience Name',            
            'sub_title' => 'Experience Sub Title',
            'description' => 'Experience Description',
            'experiences_image_url' => 'Experience Image',
            'image' => 'Experience Image',
            'experiences_video_url' => 'Experience Video',
            'price' => 'Experience Price',            
            'duration' => 'Experience Duration', 
            'duration_type' => 'Duration Type', 
            'group_size' => 'Max Group Size',  
            'activity_level' => 'Activity Level', 
            'country' => 'Country Name',   
            'state' => 'State Name',   
            'city' => 'City Name',   
            'latitude' => 'Latitude', 
            'longitude'=>'Longitude',         
            'status' => 'Experience Status',
            'featured' => 'Featured Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    // Before Save/Update Set Default values
    public function beforeSave($insert) {
        $this->updateSlug();
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
     * Gets query for [[ExperienceAddOns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdons()
    {
        return $this->hasMany(ExperienceAddOns::className(), ['experiences_id' => 'id']);
    }


    /**
     * Gets query for [[ExperienceAvailability]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvailability()
    {
        return $this->hasMany(ExperienceAvailability::className(), ['experiences_id' => 'id']);
    }


    /**
     * Gets query for [[ExperiencesMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(ExperiencesMedia::className(), ['experiences_id' => 'id']);
    }

    /**
     * Gets query for [[ExperiencesSaved]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaved()
    {
        return $this->hasMany(ExperiencesSaved::className(), ['experiences_id' => 'id']);
    }


    
    public function updateSlug(){ 
        $slug =  trim($this->title);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $slug);  
        $slug = strtolower($slug);
        $this->slug = $slug;
    }

    public function getCategoryList(){
        $categories = Categories::find()->select('id, name')->where(['status'=>'1'])->asArray()->all(); 
        $new_array = [''=>'Select Experience Category'];
        if(!empty($categories)){
            foreach($categories as $cat){
                $new_array[ $cat['id'] ] = $cat['name'];
            }            
        } 
        return $new_array; 
    }
}

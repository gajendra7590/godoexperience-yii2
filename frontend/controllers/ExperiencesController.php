<?php

namespace frontend\controllers;

use Yii; 
use yii\web\Controller;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\controllers\BaseController;
use common\models\Categories;
use common\models\Experiences;


class ExperiencesController extends BaseController
{ 
    
     /**
     * Experiences List By Category OR All
     */
    public function actionExperiences()
    {   
        $category = Yii::$app->request->get('category');
        $cat_id = 0;
        if($category!=''){
            $cat_id = $this->validateCategorySlug($category);
        }

       // echo $cat_id;die;

        return $this->render(
        '@app/views/experiences/exp_list',[
            'exp_featured' => $this->getFeaturedExperiences($cat_id),
            'exp_prod' => $this->getProdExperiences($cat_id),
            'singleExp' => $this->getOneExperiences($cat_id),
        ]);
    }

    /**
     * Function is associated with actionExperiences()
     * Validate Experince page category is valid OR Not
    */
    protected function validateCategorySlug($slug = ''){
        $is_exist =  Categories::findOne(['slug'=>$slug]);
        if($is_exist){
           return $is_exist->id;
        }
        throw new \yii\web\NotFoundHttpException();
    }

     /**
     * Function Associated With actionExperiences
     * Get Top5 Featured Experiences For Index Function
    */
    protected function getFeaturedExperiences($cat_id = ''){

        $where = array('status' => 1);
        if($cat_id > 0){
            $where['category_id'] = $cat_id;
        }

        return Experiences::find()
                ->select('id,price,duration,duration_type,group_size, category_id,user_id,title,sub_title,slug,experiences_image_url')
                ->with(['category'])
                ->where($where)
                ->orderBy(['created_at' => SORT_DESC])
                // ->where(['featured' => 1])
                ->orderBy(['featured' => SORT_DESC]) 
                ->limit(8)
                ->All(); 
    }

    /**
     * Function Associated With actionExperiences
     * Get Top6 Rated Experiences For Index Function
    */
    protected function getProdExperiences($cat_id = ''){

        $where = array('status' => 1);
        if($cat_id > 0){
            $where['category_id'] = $cat_id;
        }

        return Experiences::find()
                ->select('id,price,duration,duration_type,group_size, category_id,user_id,title,sub_title,slug,experiences_image_url')
                ->with(['category'])
                ->where($where)
                ->orderBy(['created_at' => SORT_DESC]) 
                ->limit(12)
                ->All(); 
    }

    /**
     * Function Associated With actionIndex
     * Get One Category Detail
     */
    protected function getOneExperiences($cat_id = ''){

        $where = array('status' => 1);
        $exp = NULL;
        if($cat_id > 0){
            $exp =  Categories::find()->where(['id'=>$cat_id])->asArray()->One();
            $exp['filter_by_cat'] = true;
        }else{
            $exp =  Experiences::find()->where($where)->orderBy(new \yii\db\Expression('rand()'))->asArray()->One();
            $exp['filter_by_cat'] = false;
        }

        if($exp){
            return $exp;
        }else{
            return [];
        }
    }

}

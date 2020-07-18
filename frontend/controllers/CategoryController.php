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


class CategoryController extends BaseController
{    
    
    /**
     * Category List
     */
    public function actionIndex()
    {
        return $this->render('@app/views/experiences/categories',[
            'sinle_cat' => $this->getOneCategory(),
            'featured_cat' => $this->getFeaturedCategory(),
            'all_cat' => $this->getAllCategory(),
        ]);
    }


    /**
     * Function Associated With actionIndex
     * Get Top5 Featured Category For Index Function
    */
    protected function getFeaturedCategory(){
        $categories = Categories::find()
                ->where(['status' => 1])
                ->orderBy(['featured' => SORT_DESC]) 
                ->orderBy(['featured_date' => SORT_DESC])
                ->limit(8)
                ->asArray()
                ->All(); 

        if($categories){
            foreach($categories as $k => $c){ 
                $categories[$k]['total_exp'] =  Experiences::find()->where(['category_id'=>$c['id']])->count(); 
            }
        }   
        return $categories;
    }

    /**
     * Function Associated With actionIndex
     * Get Top6 Rated Experiences For Index Function
    */
    protected function getAllCategory(){
        $categories = Categories::find()
                ->where(['status' => 1])
                ->orderBy(['created_at' => SORT_DESC])  
                ->orderBy(['featured_date' => SORT_DESC])
                ->asArray()
                ->All(); 
         if($categories){
            foreach($categories as $k => $c){ 
                $categories[$k]['total_exp'] =  Experiences::find()->where(['category_id'=>$c['id']])->count(); 
            }
         }   
        return $categories;     


    }

    /**
     * Function Associated With actionIndex
     * Get One Category Detail 
    */
    protected function getOneCategory(){   
       return Categories::find()->where(['status' => 1])->orderBy(new \yii\db\Expression('rand()'))->One();
    } 
 
}

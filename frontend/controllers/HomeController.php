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
use common\models\Testimonial;
use common\models\ContactUs;
use common\models\Company;


class HomeController extends BaseController
{
     
    /**
     * Home page / Index Page / Main Page
     */
    public function actionIndex()
    {
        return $this->render('@app/views/experiences/exp_home',[
            'top3_categories' => $this->getTop3FeaturedCategories(),
            'top5_worldarround_exp' => $this->getTop5WorldAroundExperiences(),
            'top4_featured_exp' => $this->getTop4FeaturedExperiences(),
            'top6_rated_exp' => $this->getTop6RatedExperiences(),
            'testimonials' => $this->getTestimonials(),
            'singleExp' => $this->getOneExperiences(),
        ]);
    }
    
    /**
     * Function Associated With Index
     * Get Top3 Featured Categories For Index Function
     */
    protected function getTop3FeaturedCategories(){
        $categories = Categories::find()
                ->select('id, name,title,slug,category_image_url,featured')
                ->where(['status' => 1])
                ->orderBy(['featured' => SORT_DESC])
                ->limit(3)
                ->asArray()
                ->All(); 
         if($categories){
             foreach($categories as $k => $c){ 
                $categories[$k]['total_experiences'] =  Experiences::find()->where(['category_id'=>$c['id']])->count(); 
             }
         }
         return $categories;
    }

    /**
     * Function Associated With Index
     * Get Top5 World Around Categories For Index Function
    */
    protected function getTop5WorldAroundExperiences(){         
        return Experiences::find()
            ->select('id,price,duration,duration_type,group_size,category_id,user_id,title,sub_title,slug,experiences_image_url')
            ->with(['category'])
            ->where(['status' => 1])
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->All(); 
    }

    /**
     * Function Associated With Index
     * Get Top5 Featured Experiences For Index Function
    */
    protected function getTop4FeaturedExperiences(){
        return Experiences::find()
                ->select('id,price,duration,duration_type,group_size,category_id,user_id,title,sub_title,slug,experiences_image_url')
                ->with(['category'])
                ->where(['status' => 1])
                ->orderBy(['id' => SORT_DESC])
                ->limit(4)
                ->All(); 
    }

    /**
     * Function Associated With Index
     * Get Top6 Rated Experiences For Index Function
    */
    protected function getTop6RatedExperiences(){
        return Experiences::find()
                ->select('id,price,duration,duration_type,group_size,category_id,user_id,title,sub_title,slug,experiences_image_url')
                ->with(['category'])
                ->where(['status' => 1])
                ->orderBy(['created_at' => SORT_DESC])
                ->limit(6)
                ->All(); 
    } 
   
    /**
     * Function Associated With Index
     * Get Testimonial
    */
    protected function getTestimonials(){
        return Testimonial::find()
                ->orderBy(['created_at' => SORT_DESC]) 
                ->limit(6)
                ->asArray()
                ->All(); 
    }

    /**
     * Function Associated With actionIndex
     * Get One Category Detail
     */
    protected function getOneExperiences(){
        $where = array('status' => 1);
        $exp = Experiences::find()->where($where)->orderBy(new \yii\db\Expression('rand()'))->asArray()->One();
        if($exp){
            return $exp;
        }else{
            return [];
        }
    }


    public function actionFaq(){

        $this->view->params['header_bg'] = 'header_bg';
        return $this->render('@app/views/other_pages/faq',[
            'pageData'=>[]
        ]);
    }


    public function actionAboutUs(){

        $this->view->params['header_bg'] = 'header_bg';
        return $this->render('@app/views/other_pages/about_us',[
            'pageData'=>[]
        ]);

    }

    public function actionContactUs(){

        $company_info = Company::find()->where(['status'=>'1'])->asArray()->one();
        $model = new ContactUs();
        $model->scenario = "contactForm";
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()){
                Yii::$app->session->setFlash('success', "Your query has been submitted.");
                return $this->redirect(['/contact-us']);
            }
        }

        $this->view->params['header_bg'] = 'header_bg';
        return $this->render('@app/views/other_pages/contact_us',[
            'model' => $model,
            'company_info' => $company_info,
        ]);
    }

    public function actionPrivacyPolicy(){

        $this->view->params['header_bg'] = 'header_bg';
        return $this->render('@app/views/other_pages/privacy_policy',[
            'pageData'=>[]
        ]);
    }

    public function actionTermsAndConditions(){

        $this->view->params['header_bg'] = 'header_bg';
        return $this->render('@app/views/other_pages/terms_and_conditions',[
            'pageData'=>[]
        ]);
    }
     

}

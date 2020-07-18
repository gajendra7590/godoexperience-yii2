<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\controllers\BaseController;
use common\models\Categories;
use common\models\Experiences;
use common\models\ExperienceAddOns;
use common\models\ExperienceAvailability;
use common\models\ExperiencesMedia;
use common\models\ExperiencesSaved;


class ExperienceDetailController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['experience','events-cal', 'events-avl-dates','events-guest','get-event-with-adons','get-event-cart','experience-saved'],
                'rules' => [
                    [
                        'actions' => ['experience','events-cal','events-avl-dates','events-guest','get-event-with-adons','get-event-cart','experience-saved'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'experience' => ['get'],
                    'events-cal' => ['post'],
                    'events-avl-dates' => ['post'],
                    'events-guest' => ['post'],
                    'get-event-with-adons' => ['post'],
                    'get-event-cart' => ['post']
                ],
            ],
        ];
    }
 

 /**
     * Experience detail/single page
     */
    public function actionExperience($slug)
    {
        if($slug==''){
            return $this->redirect(['/']);
        } 

        $ver = Yii::$app->request->get('ver');
        $view = 'exp_one_v2';
        if($ver!=NULL && $ver == '2'){
            $view = 'exp_one';
        }  

        $validate = $this->validateSlug($slug);  
        if($validate == false){
            throw new \yii\web\NotFoundHttpException();
        }

        $experince = $this->experienceDetail($slug);
        $experience_saved = $this->experienceSaved($experince->id);

        $experince_media = ExperiencesMedia::find()
            ->where(['experiences_id'=>$experince->id])
            ->select('image_url')
            ->asArray()->limit(4)->all();
        $count = 0;
        if($experince_media){
            $experince_media = array_column($experince_media, 'image_url');
            $count = count($experince_media);
        }
        $experince_media[$count] = $experince['experiences_image_url'];
        $experince_media = array_values(array_reverse($experince_media,true));
        $this->view->params['bodyClass'] = 'single__Page--product single_page-flow2'; //Get This class into layout page
        return $this->render('@app/views/experiences/'.$view,[
            'experience_detail' => $experince,
            'experience_saved' => $experience_saved,
            'experience_adons' => $this->experienceAdons($experince->id),
            'experince_media' => $experince_media
        ]);
    }

    protected function experienceDetail($slug){
        $experinces = Experiences::find()->with('category')->where(['slug'=>$slug])->one();
        return $experinces;
    }

    protected function experienceSaved($id){
        if(Yii::$app->user->isGuest){
            return NULL;
        }else{
            return ExperiencesSaved::find()->where(['experiences_id'=>$id,'user_id'=>(Yii::$app->user->identity->id)])->asArray()->one();
        }
    }

    protected function experienceAdons($exp_id){
        return ExperienceAddOns::find()->where(['experiences_id'=>$exp_id])->asArray()->all(); 
    }

    protected function validateSlug($slug = ''){
        $is_exist =  Experiences::findOne(['slug'=>$slug]); 
        if($is_exist == NULL){
            return false;           
        } 
        return true;
    }


    public function actionEventsCal($id){

        if( (!Yii::$app->request->isPost) || (!Yii::$app->request->isAjax)){
            throw new ForbiddenHttpException();
        }

        $params = Yii::$app->request->post();
        $year = (isset($params['year']))?($params['year']):(date('Y'));
        $month = (isset($params['month']))?($params['month']):(date('m'));
        $guest = (isset($params['guest']))?($params['guest']):1;
        $month = (int) ($month); //Conver String to Int
        $year = (int) ($year); //Conver String to Int
        $guest = (int) ($guest); //Conver String to Int
        $month_name = date('F');
        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $where = ['month'=>$month,'year'=>$year];
        $dates = ExperienceAvailability::find()
                ->where(['experiences_id'=>$id])
                ->andWhere($where) 
                ->select(["GROUP_CONCAT(date SEPARATOR ',') as dates"])
                ->groupBy(['experiences_id','year','month'])
                ->scalar();  
        if($dates){
            $dates = explode(',',$dates);
        }else{
            $dates = [];
        }
        return $this->renderAjax('@app/views/experiences/ajax/event_calendar',[
            'dates' => $dates, 
            'days_in_month' => $days,
            'month_name' => $month_name,
            'month' => $month,
            'year' => $year,
            'guest' => $guest
        ]);
    } 

    public function actionEventsAvlDates($id){

        if( (!Yii::$app->request->isPost) || (!Yii::$app->request->isAjax)){
            throw new ForbiddenHttpException();
        }


        $params = Yii::$app->request->post();
        $year = (isset($params['year']))?($params['year']):(date('Y'));
        $month = (isset($params['month']))?($params['month']):(date('m'));
        $date = (isset($params['date']))?($params['date']):null;
        $guest = (isset($params['guest']))?($params['guest']):1;
        $month = (int) ($month); //Conver String to Int
        $year = (int) ($year); //Conver String to Int
        $date = (int) ($date );
        $guest = (int) ($guest);
        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $where = ['year'=>$year,'month'=>$month];
        if($date > 0){ $where['date'] = $date; }
        $exp_detail = Experiences::find()
                    ->select('id,category_id,title,price,duration,duration_type,group_size,activity_level,country')  
                    ->where(['id'=>$id]) 
                    ->asArray()
                    ->one();
        if(!$exp_detail){
            return false;            
        }
        //echo $guest;
          $dates = ExperienceAvailability::find()
          ->select("experience_availability.id,experience_availability.experiences_id,year,month,date")
          ->joinWith(['experiences' => function (yii\db\ActiveQuery $query) use ($guest) {
             return $query->select('id,category_id,title,price,duration,duration_type,group_size,activity_level,country');
                          //->andWhere(['>=', 'experiences.group_size', $guest]);
           }])
          ->where(['experiences_id'=>$id])
          ->andWhere($where)
          ->orderBy(['year' => SORT_DESC,'month'=>SORT_ASC,'date'=>SORT_ASC])
          ->asArray()
          ->all();

        $data = array();
        foreach ( $dates as $k => $date){
            $d = date('Y-m-d',strtotime($date['year'].'-'.$date['month'].'-'.$date['date']));
            $today = date('Y-m-d');
            if($d >= $today){
                $data[] = $date;
            }
        }

        return $this->renderAjax('@app/views/experiences/ajax/avaliable_events',[
            'dates' => $data,
            'exp_detail' => $exp_detail,
            'days_in_month' => $days 
        ]);

    }

    public function actionEventsGuest($id){

        if( (!Yii::$app->request->isPost) || (!Yii::$app->request->isAjax)){
            throw new ForbiddenHttpException();
        }


        $params = Yii::$app->request->post();
        $year = (isset($params['year']))?($params['year']):(date('Y'));
        $month = (isset($params['month']))?($params['month']):(date('m'));
        $date = (isset($params['date']))?($params['date']):null;
        $guest = (isset($params['guest']))?($params['guest']):1;
        $month = (int) ($month); //Conver String to Int
        $year = (int) ($year); //Conver String to Int
        $date = (int) ($date );
        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $where = ['year'=>$year,'month'=>$month];
        if($date > 0){ $where['date'] = $date; }
        $exp_detail = Experiences::find()
            ->select('id,category_id,title,price,duration,duration_type,group_size,activity_level,country')
            ->where(['id'=>$id])
            ->asArray()
            ->one();
        if(!$exp_detail){
            return false;
        }

        return $this->renderAjax('@app/views/experiences/ajax/event_guest',[
            'exp_detail' => $exp_detail,
            'days_in_month' => $days,
            'year'=>$year,
            'month'=>$month,
            'date'=>$date
        ]);

    }

    public function actionGetEventWithAdons($id){

        if( (!Yii::$app->request->isPost) || (!Yii::$app->request->isAjax)){
            throw new ForbiddenHttpException();
        }

        $params = Yii::$app->request->post();
        if( isset($params['event_id']) && ($params['event_id'] > 0)){
            $event_date = ExperienceAvailability::find()
            ->with(['experiences' => function($model){
                $model->with(['adons'])->select('id,category_id,title,sub_title,experiences_image_url,price,duration,duration_type,group_size,activity_level,featured,country');
            }])
            ->where(['id'=> $params['event_id']])
            ->asArray()
            ->one();

            if($event_date){
                return $this->renderAjax('@app/views/experiences/ajax/avaliable_event_with_adons',[
                    'event' => $event_date,
                    'params' => $params
                ]);

            }

        }

    }


    public function actionGetEventCart($id){

        if( (!Yii::$app->request->isPost) || (!Yii::$app->request->isAjax)){
            throw new ForbiddenHttpException();
        }

        $params = Yii::$app->request->post();
        $adons = isset($params['adons'])?explode(',',$params['adons']):[];
        $session_array = [
            'experience_id'=>$params['id'],
            'adult'=>$params['adult'],
            'children'=>$params['children'],
            'infants'=>$params['infants'],
            'total'=>$params['total'],
            'event_id'=>$params['event_id'],
            'ad_ons' => $adons
        ];

        Yii::$app->session->set('booking_sess',$session_array);  //set in session

        //echo '<pre>';var_dump($params);
        if( isset($params['event_id']) && ($params['event_id'] > 0)){
            $event_date = ExperienceAvailability::find()
                ->with(['experiences' => function($model){
                    $model->with(['adons'])->select('id,category_id,title,sub_title,experiences_image_url,price,duration,duration_type,group_size,activity_level,featured,country');
                }])
                ->where(['id'=> $params['event_id']])
                ->asArray()
                ->one();

            if($event_date){
                return $this->renderAjax('@app/views/experiences/ajax/cart',[
                    'event' => $event_date,
                    'params' => $params,
                    'id' => $id,
                    'adons'=> $adons
                ]);

            }

        }

    }

    public function actionExperienceSaved($id){
        if(Yii::$app->user->isGuest){
            return null;
        }else{

            if( (!Yii::$app->request->isPost) || (!Yii::$app->request->isAjax)){
                throw new ForbiddenHttpException();
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();

            $model = ExperiencesSaved::findOne(['experiences_id' => $id,'user_id'=>Yii::$app->user->identity->id]);
            if($model){
                $model->delete();
                return $this->asJson([
                    'success' => true,
                    'action' => '',
                    'text' => 'Save'
                ]);
               // return $model->id;
            }else{
                $newModel = new ExperiencesSaved();
                $newModel->experiences_id = $id;
                $newModel->user_id = Yii::$app->user->identity->id;
                $newModel->insert();
                return $this->asJson([
                    'success'=>true,
                    'action'=>'saved_item_true',
                    'text' => 'Saved'

                ]);
            }
        }
}





}

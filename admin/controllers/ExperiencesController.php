<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;
use yii\bootstrap\ActiveForm;

use admin\controllers\BaseController;
use common\helpers\Utils;
use common\models\Experiences;
use common\models\ExperiencesSearch;
use common\models\ExperienceAddOns;
use common\models\ExperienceAvailability;
use common\models\ExperiencesMedia;
use common\models\ExperiencesOrder;



/**
 * ExperiencesController implements the CRUD actions for Experiences model.
 */
class ExperiencesController extends BaseController
{  
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles'=>['?']
                    ],
                    [
                        'actions' => ['index','view','create', 'update','delete','upload-media','delete-media','manage-availability','save-revoke-date','ajax-validation','get-addons','get-dates','get-dateschange','check-adons'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->response->redirect(['/']);
                    return false;
                 },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'ajax-validation' => ['post'],
                    'save-revoke-date'=> ['post'],
                    'upload-media' => ['post'],
                    'delete-media' => ['post'],
                    'check-adons' => ['post']
                ],
            ],
        ];
    }

    public function init(){
        if (Yii::$app->user->isGuest) {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    /**
     * Lists all Experiences models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Experiences();
        $searchModel = new ExperiencesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->pagination->route = 'experiences';  
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $model->getCategoryList()
        ]);
    }  
    
    /**
     * ajaxForm Validation
    */
    public function actionAjaxValidation($id = null)
    {
        $model = new Experiences();
        if($id){
            $model = $this->findModel($id);
        }
        $categories = $model->getCategoryList(); 
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) { 
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }
        }
    }

    /**
     * Creates a new Experiences model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Experiences();
        $categories = $model->getCategoryList(); 
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate()) {   
           
            //file upload code start
            $temp_image = UploadedFile::getInstance($model, 'image');  
            if($temp_image){
                $file_name = Utils::getUniqueFileName().'.'.$temp_image->extension; 
                $is_success = $temp_image->saveAs('../../uploads/experiences/'.$file_name);
                if($is_success){
                    $model->experiences_image_url = 'uploads/experiences/'.$file_name;
                } 
            }    
            //file upload code end 

            $model->user_id = Yii::$app->user->identity->id;  
            if($model->save()){ 

                // Code for save Addons start
                    $insert_id = Yii::$app->db->getLastInsertID(); 
                    $add_ons = Yii::$app->request->post('add_ons');
                    if($add_ons){
                        $this->addOnsSave($add_ons,$insert_id);
                    }      
                // Code for save Addons end   
                $media_img = Yii::$app->request->post('media_image'); 
                if($media_img){
                    foreach($media_img as $v){  
                        $source = realpath(dirname(__FILE__).'/../../').'/uploads/temp_upload/'.$v;
                        $dest = realpath(dirname(__FILE__).'/../../').'/uploads/experiences/'.$v; 
                        if (file_exists($source)) { 
                            rename($source , $dest); 
                            $media = new ExperiencesMedia;
                            $media->experiences_id  = $insert_id;
                            $media->image_name  = $v;
                            $media->image_url  = 'uploads/experiences/'.$v;
                            $media->save(false);
                        }                        
                    } 
                } 
                Yii::$app->session->setFlash('success', "New Experiences Added Successfully,Please set upcoming available schedule");
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $this->asJson([
                    'success'=>true,
                    'redirect_url'=>Url::to(['/experiences/manage-availability','id'=>$insert_id]),
                    'message'=>'New Experiences Added Successfully,Please set available schedule'
                ]);
            }    
        }

        return $this->render('create', [
            'model' => $model,
            'categories'=>$categories,
            'addOnsHtml'=>'', 
        ]);
    }

    /**
     * Updates an existing Experiences model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = $model->getCategoryList();
        $addOnsList = ExperienceAddOns::find()->where(['experiences_id'=>$id])->asArray()->all();  
        $mediaList = ExperiencesMedia::find()->where(['experiences_id'=>$id])->asArray()->all();  

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate()) {  
            //file upload code start
            $temp_image = UploadedFile::getInstance($model, 'image'); 
            if($temp_image){
                $file_name = Utils::getUniqueFileName().'.'.$temp_image->extension; 
                $is_success = $temp_image->saveAs('../../uploads/experiences/'.$file_name);
                if($is_success){
                    $model->experiences_image_url = 'uploads/experiences/'.$file_name;
                } 
            }               
            //file upload code end   
            if($model->save()){
                // Code for save Addons start 
                    $add_ons = Yii::$app->request->post('add_ons');                      
                    if($add_ons){
                        $this->addOnsSave($add_ons,$id);
                    }      
                // Code for save Addons end    
                Yii::$app->session->setFlash('success', "Experience detail saved successfully,You can add/edit upcoming available schedule");
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $this->asJson([
                    'success'=>true,
                    'redirect_url'=>Url::to(['/experiences/manage-availability','id' => $id]),
                    'message'=>'Experience detail saved successfully'
                ]);
            }    
        }
        // Get addOnsHtml 
        $addOnsHtml =  ($addOnsList)?$this->renderPartial('ajax/addon_more',['addons'=>$addOnsList]):'';
        $mediaListHtml = ($mediaList)?($this->renderAjax('ajax/media', ['media_images'=>$mediaList])):'';

        // echo $mediaListHtml;die;

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'addOnsHtml' => $addOnsHtml,
            'mediaHtml' => $mediaListHtml
        ]);

    }

    /**
     * Deletes an existing Experiences model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $exp = $this->findModel($id); 
       // Remove Media Code  
        if($exp){
           $exp->status = 2;
           $exp->save();
           Yii::$app->session->setFlash('success', 'Success!! Experience archieved successfully.');
           return $this->redirect(['/experiences']);
        }
        Yii::$app->session->setFlash('error', 'Opps!! Error in delete.');
        return $this->redirect(['/experiences']);       
    }

    public function actionUploadMedia(){
        if (Yii::$app->user->isGuest) { return $this->goHome(); }

        if ( (Yii::$app->request->isAjax) && (Yii::$app->request->isPost) ) {  
            $exp_id = Yii::$app->request->post('exp_id');
            $media_id = 0;
            $action_type = 'insert';
            $temp_image = UploadedFile::getInstanceByName('upload_media');
            $upload_path = 'uploads/temp_upload/';
            if($exp_id > 0){ 
                $upload_path = 'uploads/experiences/';
            }
                
            if($temp_image){
                $file_name = Utils::getUniqueFileName().'.'.$temp_image->extension; 
                $is_success = $temp_image->saveAs('../../'.$upload_path.$file_name);
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($is_success){

                     $image_path = 'uploads/temp_upload/'.$file_name;
                     if($exp_id > 0){
                        $media = new ExperiencesMedia;
                        $media->experiences_id = $exp_id;
                        $media->image_name = $file_name;
                        $media->image_url = $upload_path.$file_name;
                        $save = $media->save(false); 
                        if($save){
                            $media_id = $media->id; 
                            $action_type = 'update';
                            $image_path = 'uploads/experiences/'.$file_name;
                        } 
                     }      

                    return $this->renderAjax('ajax/media', [
                        'single_upload' => [
                            'img' => $image_path,
                            'image_name' => $file_name,
                            'exp_id' => $exp_id,
                            'media_id' => $media_id,
                            'action_type' => $action_type
                        ] 
                    ]); 
                        
                }else{ 
                    return false;
                } 
            }   
              
        }

    }


    public function actionDeleteMedia(){
        if ( (Yii::$app->request->isAjax) && (Yii::$app->request->isPost) ) {  
              $media_id = Yii::$app->request->post('media_id');
              $exp_id = Yii::$app->request->post('exp_id');
              $image_name = Yii::$app->request->post('image_name'); 
              if($media_id == 0 && $exp_id == 0){ 
                  $img_path = realpath(dirname(__FILE__).'/../../').'/uploads/temp_upload/'.$image_name; 
                  unlink($img_path);
                  return true; 
              }else{ 
                    $media =  ExperiencesMedia::findOne(['id' => $media_id]);
                    if($media){
                       $media->delete();
                       $img_path = realpath(dirname(__FILE__).'/../../').'/uploads/experiences/'.$image_name;
                       unlink($img_path);
                       return true; 
                    } 
              } 
        }
        
    }

    /**
     * Finds the Experiences model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Experiences the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $where = ['id'=>$id];
        if (($model = Experiences::findOne($where)) !== null) {
            if( (Yii::$app->user->identity->role_id == '2')  ){
                if($model->user_id != Yii::$app->user->identity->id){
                    throw new \yii\web\UnauthorizedHttpException('Your are not authorised to access this.');
                }else{
                    return $model;
                }
            } else{
                return $model;
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    } 

    /**
     * Get Adons Html dynamics click on add more button
     */
    public function actionGetAddons(){
        return $this->renderPartial('ajax/addon_more', [
             'model' => '',
         ]); 
     }
    
    /**
     * Function for save addOns Data
     */
    protected function addOnsSave($post_form = array(),$experience_id){ 
        if(!empty($post_form)){
            // echo '<pre>';print_r($post_form);die;
            foreach($post_form as $k => $form){ 
                if(isset($form['id']) && $form['id'] > 0){
                     if( isset($form['is_deleted']) && $form['is_deleted'] == '1' ){
                        $model = ExperienceAddOns::find()->where(['id'=>$form['id']])->one();
                        if($model){ $model->delete(); } //delete                        
                     }else{
                        $model = ExperienceAddOns::find()->where(['id'=>$form['id']])->one(); 
                        if($model){
                            $model->name = $form['name'];
                            $model->description = $form['description'];
                            $model->price = $form['price']; 
                            $model->save();
                        }                        
                     }
                }else{
                    $model = new ExperienceAddOns;
                    $model->experiences_id = $experience_id;
                    $model->name = $form['name'];
                    $model->description = $form['description'];
                    $model->price = $form['price']; 
                    $model->insert();
                } 
            }
        } 
        return true;
    }
    
    
    // Below all functions for manage avaliability  
    public function actionManageAvailability($id)
    {
        $model = $this->findModel($id);   
        if(Yii::$app->request->isAjax ) { 
            return $this->renderAjax('ajax/event_calendar', [
                'model' => $model,
                'params' => Yii::$app->request->get(),
                'days' => $this->getNumberOfDays(),
                'available_dates' => $this->getEventData()
            ]);        
        }
        return $this->render('ajax/manage_availability', [
            'model' => $model,
        ]);
    }

    public function actionSaveRevokeDate($id)
    {
        $model = $this->findModel($id);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if( ($model) && Yii::$app->request->isAjax) { 
            $post = Yii::$app->request->post();
            $avlModel = ExperienceAvailability::find()->where([
                    'experiences_id' => $id,
                    'year' => $post['year'],
                    'month' => $post['month'],
                    'date' => $post['date']
                ])->one();
            if($avlModel){
                $is_booked = ExperiencesOrder::findOne(['experience_avl_id'=>$avlModel->id]);
                if($is_booked){
                    return $this->asJson([
                        'success' => 2,
                        'message' => "This event date can not be deleted,because already booked",
                    ]);
                }else{
                    $avlModel->delete();
                    return $this->asJson([
                        'success' => 1,
                        'message' => "Event date deleted successfully",
                    ]);
                }
            }else{ 
                $new_obj = new ExperienceAvailability();
                $new_obj->experiences_id = $id;
                $new_obj->year = $post['year'];
                $new_obj->month = $post['month'];
                $new_obj->date = $post['date']; 
                if($new_obj->save()){
                    return $this->asJson([
                        'success' => 1,
                        'message' => "New Event Date Added",
                    ]);
                }else{
                    return $this->asJson([
                        'success' => 0,
                        'message' => "error in Add event date",
                    ]);
                }
            }  
        }         
    }

    protected function getNumberOfDays(){
        $params = Yii::$app->request->get();
        $year = 0;  $month = 0;
        if( (!isset($params['year'])) || ($params['year'] == '0') || ($params['year'] == '') ){
            $year = date('Y');
        }else{ $year = trim($params['year']); }

        if( (!isset($params['month'])) || ($params['month'] == '0') || ($params['month'] == '') ){
            $month = date('m');
        }else{ $month = trim($params['month']); }  
        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        return $days;
    }

    protected function getEventData(){
        $params = Yii::$app->request->get();
        $year = 0;  $month = 0;
        if( (!isset($params['year'])) || ($params['year'] == '0') || ($params['year'] == '') ){
            $year = date('Y');
        }else{ $year = trim($params['year']); }

        if( (!isset($params['month'])) || ($params['month'] == '0') || ($params['month'] == '') ){
            $month = date('m');
        }else{ $month = trim($params['month']); }   

        $dates = ExperienceAvailability::find()->where([
                'experiences_id' => $params['id'],
                'year' => $year,
                'month'=>$month
            ])
        ->select(["GROUP_CONCAT(date SEPARATOR ',') as dates"])
        ->groupBy(['experiences_id','year','month'])
        ->scalar(); 
        if($dates){
            return explode(',',$dates);
        }else{
            return [];
        }
    }

    public function actionCheckAdons(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        if( (Yii::$app->request->isPost) && (Yii::$app->request->isAjax) ) {
            $post = Yii::$app->request->post();
            if( isset($post['id']) && isset($post['exp_id'])){
                $find = ExperiencesOrder::find()
                ->where(new \yii\db\Expression('FIND_IN_SET(:adon_id,experience_adons_ids)'))
                ->addParams([':adon_id' => $post['id']])
                ->count();
                if($find > 0){
                    return $this->asJson([
                        'success' => 0,
                        'message' => "This adon is booked",
                    ]);
                }else{
                    return $this->asJson([
                        'success' => 1
                    ]);
                }

            }


        }

    }


    
}

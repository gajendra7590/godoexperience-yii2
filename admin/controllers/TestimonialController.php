<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;

use admin\controllers\BaseController;
use common\models\Testimonial;
use common\models\TestimonialSearch;
use common\helpers\Utils;

/**
 * TestimonialController implements the CRUD actions for Testimonial model.
 */
class TestimonialController extends BaseController
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
                        'actions' => ['index','view','create', 'update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){  
                            if( isset(Yii::$app->user->identity->role_id) && (Yii::$app->user->identity->role_id == '1') ){
                                return true;
                            }else{
                                Yii::$app->session->setFlash('error', "You are not authorised to access this."); 
                                return false;
                            }                            
                        }
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->response->redirect(['/login']); 
                 },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
     * Lists all Testimonial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestimonialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->pagination->route = 'testimonial';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testimonial model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Testimonial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Testimonial();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {  
            //file upload code start
            $uploaded_file = UploadedFile::getInstance($model, 'tm_image'); 
            if($uploaded_file){
                $file_name = Utils::getUniqueFileName().'.'.$uploaded_file->extension; 
                $is_success = $uploaded_file->saveAs('../../uploads/testimonial/'.$file_name);
                if($is_success){
                    $model->client_image = 'uploads/testimonial/'.$file_name;
                } 
            }               
            //file upload code end

            if($model->save()){
                Yii::$app->session->setFlash('success', "New Testimonial created successfully.");
                return $this->redirect(['/testimonial']);
            }    
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Testimonial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {  
            //file upload code start
            $uploaded_file = UploadedFile::getInstance($model, 'tm_image'); 
            if($uploaded_file){
                $file_name = Utils::getUniqueFileName().'.'.$uploaded_file->extension; 
                $is_success = $uploaded_file->saveAs('../../uploads/testimonial/'.$file_name);
                if($is_success){
                    $model->client_image = 'uploads/testimonial/'.$file_name;
                } 
            }               
            //file upload code end

            if($model->save()){
                Yii::$app->session->setFlash('success', "Testimonial updated successfully.");
                return $this->redirect(['/testimonial']);
            }    
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Testimonial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $find = $this->findModel($id); 
        if($find){
            $find->delete();
            Yii::$app->session->setFlash('success', "Testimonial deleted Successfully.");
            return $this->redirect(['/testimonial']);
        } 
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Testimonial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Testimonial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Testimonial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

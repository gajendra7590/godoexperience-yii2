<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\UploadedFile;

use admin\controllers\BaseController;
use common\models\ManageUser;
use common\models\ManageUserSearch;
use common\helpers\Utils;

/**
 * ClientsController implements the CRUD actions for ManageUser model.
 */
class ClientsController extends BaseController
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
     * Lists all ManageUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManageUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,3);
        $dataProvider->pagination->pageSize = 5;
        $dataProvider->pagination->route = 'clients'; 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ManageUser model.
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
     * Creates a new ManageUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ManageUser();
        $model->scenario = 'create';
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {  
            //file upload code start
            $temp_image = UploadedFile::getInstance($model, 'temp_image'); 
            if($temp_image){
                $file_name = Utils::getUniqueFileName().'.'.$temp_image->extension; 
                $is_success = $temp_image->saveAs('../../uploads/users/'.$file_name);
                if($is_success){
                    $model->profile_photo = 'uploads/users/'.$file_name;
                } 
            }               
            //file upload code end
            
            $model->setUserRole(3);
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->ip_address = Utils::get_ipAddr();
            // var_dump($model->save());die;
            if($model->save()){
                Yii::$app->session->setFlash('success', "New client created successfully.");
                return $this->redirect(['/clients']);
            }    
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ManageUser model.
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
            $temp_image = UploadedFile::getInstance($model, 'temp_image'); 
            if($temp_image){
                $file_name = Utils::getUniqueFileName().'.'.$temp_image->extension; 
                $is_success = $temp_image->saveAs('../../uploads/users/'.$file_name);
                if($is_success){
                    $model->profile_photo = 'uploads/users/'.$file_name;
                } 
            }               
            //file upload code end

            //Save New Password If Update
            if($model->update_password!=''){
                $model->setPassword($model->update_password); 
            } 

            $model->ip_address = Utils::get_ipAddr();
             
            if($model->save()){
                Yii::$app->session->setFlash('success', "Client detail updated successfully.");
                return $this->redirect(['/clients']);
            }    
        }  

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ManageUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $client = $this->findModel($id);
        if($client){
            $client->status = 2;
            $client->save();
            Yii::$app->session->setFlash('success', "Client Archive Successfully.");
            return $this->redirect(['/clients']);
        } 
        throw new NotFoundHttpException('The requested page does not exist.');

    }

    /**
     * Finds the ManageUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManageUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = ManageUser::find()->where(['id'=>$id,'role_id'=>'3'])->one(); 
        if ($model !== null) {
            return $model;
        } 

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

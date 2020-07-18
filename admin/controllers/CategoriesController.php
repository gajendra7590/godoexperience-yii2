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
use common\models\Categories;
use common\models\Amenities;
use common\models\CategoriesSearch;
use common\helpers\Utils;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends BaseController
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
     * Lists all ExperienceCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriesSearch();  
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->pagination->route = 'categories'; 
         
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);        

    }

    /**
     * Displays a single ECategories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories(); 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {  
            //file upload code start
            $uploaded_file = UploadedFile::getInstance($model, 'category_image');
            if($uploaded_file){
                $file_name = Utils::getUniqueFileName().'.'.$uploaded_file->extension;
                $is_success = $uploaded_file->saveAs('../../uploads/categories/'.$file_name);
                if($is_success){
                    $model->category_image_url = 'uploads/categories/'.$file_name;
                }
            }
            //file upload code end

            if($model->save()){
                $this->createDefaultAmenities($model->id);
                Yii::$app->session->setFlash('success', "New Category created successfully.");
                return $this->redirect(['/categories']);
            }    
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categories model.
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
            $uploaded_file = UploadedFile::getInstance($model, 'category_image'); 
            if($uploaded_file){
                $file_name = Utils::getUniqueFileName().'.'.$uploaded_file->extension; 
                $is_success = $uploaded_file->saveAs('../../uploads/categories/'.$file_name);
                if($is_success){
                    $model->category_image_url = 'uploads/categories/'.$file_name;
                } 
            }               
            //file upload code end

            if($model->save()){
                $this->createDefaultAmenities($id);
                Yii::$app->session->setFlash('success', "Category Updated Successfully.");
                return $this->redirect(['/categories']);
            }    
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $find = $this->findModel($id); 
        if($find){
            $find->status = 2;
            $find->save();
            Yii::$app->session->setFlash('success', "Category Archieved Successfully.");
            return $this->redirect(['/categories']);
        } 
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Create some Defaul Eminities
    protected function createDefaultAmenities($category_id){

        $mdoel = Amenities::find()->where(['id'=>$category_id])->count();
        if($mdoel == 0){
            $amenArray = array(
                [
                    'icon' => 'fa fa-cutlery',
                    'title' => 'Passionate',
                    'description' => 'Donec feugiat id augue consequat vulputate at magna mattis dignissim libero fringilla leo aiquam veh.',
                ],
                [
                    'icon' => 'fa fa-cog',
                    'title' => 'Intimate settings',
                    'description' => 'Donec feugiat id augue consequat vulputate at magna mattis dignissim libero fringilla leo aiquam.',
                ],
                [
                    'icon' => 'fa fa-check',
                    'title' => 'Vetted by GoDo Experience',
                    'description' => 'Donec feugiat id augue consequat vulputate at magna mattis dignissim libero fringilla leo aiquam.',
                ]
            );

            foreach ($amenArray as $item){
                $item['category_id'] = $category_id;
                $insertObj = new Amenities();
                $insertObj->attributes = $item;
                $insertObj->save();
            }

        }
    }
}

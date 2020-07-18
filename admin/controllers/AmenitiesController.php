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
use common\models\AmenitiesSearch;

/**
 * AmenitiesController implements the CRUD actions for Amenities model.
 */
class AmenitiesController extends BaseController
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
     * Lists all Amenities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmenitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Amenities();

        $dataProvider->pagination->pageSize = 10;
        $dataProvider->pagination->route = 'amenities';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'categories' => $model->getCategoryList()
        ]);
    }

    /**
     * Creates a new Amenities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Amenities();
        $categories = $model->getCategoryList();

        //var_dump($model->validate());die;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()){
                Yii::$app->session->setFlash('success', "New Amenities created successfully.");
                return $this->redirect(['/amenities']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    /**
     * Updates an existing Amenities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = $model->getCategoryList();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$post = Yii::$app->request->post();
           // echo '<pre>';print_r($post);die;
            if($model->save()){
                Yii::$app->session->setFlash('success', "Amenities Updated Successfully.");
                return $this->redirect(['/amenities']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    /**
     * Deletes an existing Amenities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id); //->delete();
        if($model){
            $model->status = 2;
            if($model->save()){
                Yii::$app->session->setFlash('success', "Amenity Archieved Successfully.");
                return $this->redirect(['/amenities']);
            }
        }
    }

    /**
     * Finds the Amenities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Amenities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Amenities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use admin\controllers\BaseController;
use common\helpers\Utils;
use common\models\Company;


class CompanyController extends BaseController
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
                        'actions' => ['index'],
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
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    public function init(){
        if (Yii::$app->user->isGuest) {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }


    public function actionIndex()
    {
        $model = Company::find()->where(['status'=>'1'])->One(); // if company exist
        if(!$model){
            $model = new Company(); // if no company
        }
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
                Yii::$app->session->setFlash('success', "Company Detail Updated Successfully.");
                return $this->redirect(['/categories']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}

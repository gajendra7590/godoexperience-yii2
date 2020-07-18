<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\bootstrap\ActiveForm;

use admin\controllers\BaseController;
use common\models\Categories;
use common\models\ContactUs;
use common\models\ContactUsSearch;
use common\helpers\SendEmail;


class ContactEnquiriesController extends BaseController
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
                        'actions' => ['index','reply','reply-preview','reply-ajax-validation'],
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
                    'reply-preview' => ['get'],
                    'reply-ajax-validation' => ['post'],
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
        $searchModel = new ContactUsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;
        $dataProvider->pagination->route = 'contact-enquiries';

        return $this->render('@app/views/contact_enquiries/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);

    }

    public function actionReplyAjaxValidation($id){
        $model = ContactUs::find()->where(['id'=>$id])->one();
        $model->scenario = "replyEmail";
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }
        }
    }


    public function actionReply($id){
        $model = ContactUs::find()->where(['id'=>$id])->one();
        $model->scenario = "replyEmail";
        if($model) {

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->reply_email = Yii::$app->params['senderEmail'];
                $model->reply_time = date('Y-m-d h:i:s');
                $model->reply_user = Yii::$app->user->identity->id;
                $model->is_reply = 1;
                $status = SendEmail::ContactReply($model); //send email
                if($status){
                    $model->save();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $this->asJson([
                        'success'=>true,
                        'message'=>'Your email has been sent successfully'
                    ]);
                }else{
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $this->asJson([
                        'success'=>false,
                        'message'=>'Opps! Error in sent email'
                    ]);
                }
            }
            return $this->renderAjax('@app/views/contact_enquiries/reply_modal', [
                'model' => $model,
            ]);
        }else{
            return false;
        }
    }

    public function actionReplyPreview($id){
        $model = ContactUs::find()->where(['id'=>$id])->asArray()->one();
        if($model){
            return $this->renderAjax('@app/views/contact_enquiries/reply_preview_modal', [
                'model' => $model,
            ]);
        }else{
            return false;
        }
    }

}

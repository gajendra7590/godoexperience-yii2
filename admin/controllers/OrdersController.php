<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use admin\controllers\BaseController;
use common\models\ExperiencesOrder;
use common\models\ExperiencesOrderSearch;
use common\models\Experiences;
use common\models\ExperienceGuest;
use common\models\ExperienceAddOns;
use common\models\ExperiencesPayment;


class OrdersController extends BaseController
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
                        'actions' => ['index','view','create', 'update','delete','view-order-summary'],
                        'allow' => true,
                        'roles' => ['@']
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


    public function actionIndex()
    {
        $searchModel = new ExperiencesOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->pagination->route = 'orders';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewOrderSummary($id){
        if((Yii::$app->request->isGet) && (Yii::$app->request->isAjax)){

            $orderDetail = ExperiencesOrder::find()->select(['experiences_order.*',
                '(total_guest_adults+total_guest_children+total_guest_infants) as guest_t',
                '(total_guest_adults*experience_price) as adults_tp',
                '(total_guest_children*experience_price) as children_tp',
                '(total_guest_infants*experience_price) as infants_tp',
            ])->where(['id'=>$id])
            ->with([
                'experience' => function($query){
                    $query->select('id, title,sub_title,experiences_image_url,price,duration,duration_type,group_size,country,state,city');
                },
                'user' => function($query){
                    $query->select('id, first_name, last_name, email,profile_photo');
                },
                'payment'=>function($query){
                    $query->select('id, payment_success_id, payment_receipt_email,payment_created,payment_receipt_url, payment_brand,payment_exp_month,payment_exp_year,payment_last4');

                },
                'guests'
             ])
            ->asArray()
            ->one();
            $orderDetail['experience_adons_detail'] = unserialize($orderDetail['experience_adons_detail']);
            $orderDetail['schedule_detail'] = unserialize($orderDetail['schedule_detail']);
            return $this->renderAjax('@app/views/orders/view_order_summary', [
                'model' => [],
                'orderDetail'=>$orderDetail
            ]);

        }
    }



} //Main class closed here

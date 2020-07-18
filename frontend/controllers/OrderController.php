<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\controllers\BaseController;
use common\models\Categories;
use common\models\Experiences;
use common\models\ExperiencesOrder;
use common\models\ExperienceGuest;


class OrderController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['order-detail', 'guest-save'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['order-detail', 'guest-save'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'my-orders' => ['get'],
                    'order-detail' => ['get'],
                    'guest-save' => ['post']
                ],
            ],
        ];
    }

    public function actionOrderDetail($id)
    {
         if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
         }

         $order = ExperiencesOrder::find()
                  ->select(['experiences_order.*',
                            '(total_guest_adults+total_guest_children+total_guest_infants) as guest_t',
                            '(total_guest_adults*experience_price) as adults_tp',
                            '(total_guest_children*experience_price) as children_tp',
                            '(total_guest_infants*experience_price) as infants_tp',
                  ])
                 ->with(
                     [
                       'experience' => function($model){
                         $model->with(['user'=> function($m){ $m->select(["CONCAT(first_name, ' ', last_name) AS hosted_by"]); }])
                         ->select('user_id,title,sub_title,description,experiences_image_url,price,duration,duration_type,group_size,country,state,city');
                       },
                       'user' => function($model){
                           $model->select('first_name,last_name,email,phone_home,gender,profile_photo,status');
                       },
                       'payment'=>function($model){
                           $model->select('name,payment_success_id,payment_description,
                                           payment_amount,payment_created,payment_currency,payment_receipt_email,
                                           payment_brand,payment_exp_month,payment_exp_year,payment_last4,payment_country,payment_network');
                       },
                       'guests' => function($model){
                           $model->orderBy(['booked_self'=>SORT_DESC]);

                       }
                     ]
                  )
         ->where(['id'=>$id,'user_id'=>Yii::$app->user->identity->id])
         ->asArray()
         ->one();
        if($order == NULL){
             Yii::$app->session->setFlash('error', "You are accessing invalid order.");
             return $this->redirect(['order/my-orders']);
         }else{
            if( date('Y-m-d',strtotime($order['experience_end_date'])) >= date('Y-m-d')){
                $order['experience_adons_detail'] = unserialize($order['experience_adons_detail']);
                $this->view->params['header_bg'] = 'header_bg';
                return $this->render('@app/views/order/single-order',[
                    'order'=>$order
                ]);
            }else{
                return $this->redirect(['/my-account']);
            }

         }

    }

    public function actionGuestSave($id){
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if( ($request->isPost ) ){
            $guest = $request->post('guest');
            $phone_number = $request->post('phone_number');
            $order_id = $request->post('order_id');


            //Save Order Phone
            $orderModel = ExperiencesOrder::findOne($order_id);
            $orderModel->phone_number = $phone_number;
            $orderModel->save(false);

            if( isset($guest) && (!empty($guest))){
                //$order_id = $request->post('order_id');
                $order = ExperiencesOrder::findOne(['id'=>$order_id]);
                if($order == NULL){
                    throw new UnauthorizedHttpException();
                }
                foreach ($guest as $gst){
                    $guestModel = ExperienceGuest::findOne(['id'=>$gst['id'],'order_id'=>$order_id]);
                    if($guestModel){
                        $guestModel->first_name = $gst['first_name'];
                        $guestModel->last_name = $gst['last_name'];
                        $guestModel->email = $gst['email'];
                        $guestModel->gender = $gst['gender'];
                        $guestModel->save(false);
                    }
                }
                return $this->asJson(['success'=>true]);
            }
        }else{
            return $this->asJson(['success'=>false]);
        }
    }

}

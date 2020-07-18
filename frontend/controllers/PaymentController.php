<?php

namespace frontend\controllers;



use Yii;
use yii\web\Controller;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\Response;

use frontend\controllers\BaseController;
use common\models\Categories;
use common\models\Experiences;
use common\models\ExperiencesPayment;
use common\models\ExperiencesOrder;
use common\models\ExperienceGuest;
use common\models\ExperienceAddOns;
use common\models\ExperienceAvailability;
use common\helpers\PaymentHelpers;
use common\helpers\Utils;

class PaymentController extends BaseController
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
                        'actions' => ['payment-success'],
                        'allow' => true                         
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->response->redirect(['/login']); 
                 },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'payment-success' => ['post'],
                ],
            ],
        ];
    }

    protected function sendEmail( $id ){
        $orderDetail = \common\models\ExperiencesOrder::find()->select(['experiences_order.*',
            '(total_guest_adults+total_guest_children+total_guest_infants) as guest_t',
            '(total_guest_adults*experience_price) as adults_tp',
            '(total_guest_children*experience_price) as children_tp',
            '(total_guest_infants*experience_price) as infants_tp',
        ])->where(['id' => $id])
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
        return Yii::$app
        ->mailer
        ->compose(
            ['html' => 'experienceBooking'],
            ['orderDetail' => $orderDetail]
        )
        ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['appName']])
        ->setTo('gajendra@bitcot.com')
        ->setSubject('Order booking confirmation')
        ->send();
    }


    public function actionPaymentSuccess($id)
    {
        if( (Yii::$app->request->post())){

            if(Yii::$app->user->isGuest){
                Yii::$app->session->setFlash('error', 'Opps! Your session got expired');
                return $this->redirect(['/login']);
            }

            $booking_sess =  Yii::$app->session->get('booking_sess');

            $experience_model = Experiences::findOne($id);
            if(!$experience_model){
                Yii::$app->session->setFlash('error', 'Invalid experience ID'); 
                return $this->goBack(Yii::$app->request->referrer); 
            }


            // SET ALL PARAMS
                $ad_ons_id = null;
                $ad_ons_price = 0;
                $ad_ons_detail = null;
                $total_guest_adults = isset($booking_sess['adult'])?intval($booking_sess['adult']):1;
                $total_guest_children =isset($booking_sess['children'])?intval($booking_sess['children']):0;
                $total_guest_infants = isset($booking_sess['infants'])?intval($booking_sess['infants']):0;
                $total_guest = isset($booking_sess['total'])?intval($booking_sess['total']):1;
                $experience_avl_id = null;
                $experience_start_date = null;
                $experience_end_date = null;
                $schedule_detail = null;
            //SET ALL PARAMS END


            //Get Event Detail
            if(isset($booking_sess['event_id'])){
                $get_booking = ExperienceAvailability::find()->where(['id'=>$booking_sess['event_id']])->asArray()->one();
                $experience_start_date = date('Y-m-d',strtotime($get_booking['year']."-".$get_booking['month']."-".$get_booking['date']));
                $experience_end_date = date('Y-m-d',strtotime($get_booking['year']."-".$get_booking['month']."-".$get_booking['date']));
                $experience_avl_id = $booking_sess['event_id'];
            }

            //Get Adons Detail
            if(isset($booking_sess['ad_ons']) && (!empty($booking_sess['ad_ons']))){
                $adons = ExperienceAddOns::find()->where(['in','id',$booking_sess['ad_ons']])->asArray()->all();
                $detail = [];
                $ids = [];
                foreach ($adons as $ad){
                    $detail[] = [
                        'id' => $ad['id'],
                        'name' => $ad['name'],
                        'price' => $ad['price']
                    ];
                    $ad_ons_price+=intval($ad['price']);
                    array_push($ids,$ad['id']);
                }
                //$ad_ons_price = ($ad_ons_price*$total_guest);
                $ad_ons_id = implode(',',$ids);
                $ad_ons_detail = serialize($detail);
            }

            $total =  ( intval($experience_model->price ) + $ad_ons_price);
            $total_pay = ( $total * $total_guest );
            $ad_ons_price = ($ad_ons_price*$total_guest);
            $desc = "Booking For : ".$total_guest.' Guest '.Utils::cc()."($total_guest ×  $total ) = ".Utils::cc()."$total_pay";
            if($experience_model->duration_type == 'day'){
                if($experience_model->duration > 1){
                    $duration = intval($experience_model->duration) - 1;
                    $experience_end_date = date('Y-m-d', strtotime($experience_end_date. ' + '.$duration.' days'));
                }
            }
            $schedule_detail =  serialize(array(
                'duration' => $experience_model->duration,
                'duration_type' => $experience_model->duration_type,
                'group_size' => $experience_model->group_size
            ));

            $user = Yii::$app->user->identity;
            $request = Yii::$app->request->post(); 
            $chargeObj = [
                "amount" => $total_pay,
                "currency" => "USD",  
                "source" => $request['stripeToken'], 
                'receipt_email' => $user->email,
                "description" => $desc
            ];

            $payment =  PaymentHelpers::charge($chargeObj);
            if( isset($payment['error']) && ($payment['error'] == false) ){ 
                $model = new ExperiencesPayment;    
                $model->payment_success_id = isset($payment['response']['id'])?$payment['response']['id']:NULL;   
                $model->user_id = $user->id;
                $model->experience_id = $id;
                $model->name = isset($payment['response']['billing_details']['name'])?($payment['response']['billing_details']['name']):NULL;
                $model->email = isset($payment['response']['billing_details']['email'])?($payment['response']['billing_details']['email']):NULL;
                $model->phone = isset($payment['response']['billing_details']['phone'])?($payment['response']['billing_details']['phone']):NULL;
                $model->payment_description = isset($payment['response']['description'])?$payment['response']['description']:NULL;
                $model->payment_amount = isset($payment['response']['amount'])?$payment['response']['amount']:0;
                $model->payment_created = isset($payment['response']['created'])?$payment['response']['created']:NULL;
                $model->payment_currency = isset($payment['response']['currency'])?$payment['response']['currency']:NULL; 
                $model->payment_receipt_email = isset($payment['response']['receipt_email'])?$payment['response']['receipt_email']:'';
                $model->payment_receipt_url = isset($payment['response']['receipt_url'])?$payment['response']['receipt_url']:NULL;
                $model->payment_brand = isset($payment['response']['payment_method_details']['card']['brand'])?$payment['response']['payment_method_details']['card']['brand']:'';
                $model->payment_exp_month = isset($payment['response']['payment_method_details']['card']['exp_month'])?$payment['response']['payment_method_details']['card']['exp_month']:'';
                $model->payment_exp_year = isset($payment['response']['payment_method_details']['card']['exp_year'])?$payment['response']['payment_method_details']['card']['exp_year']:'';
                $model->payment_last4 = isset($payment['response']['payment_method_details']['card']['last4'])?$payment['response']['payment_method_details']['card']['last4']:'';
                $model->payment_country = isset($payment['response']['payment_method_details']['card']['country'])?$payment['response']['payment_method_details']['card']['country']:'';
                $model->payment_network = isset($payment['response']['payment_method_details']['card']['network'])?$payment['response']['payment_method_details']['card']['network']:'';
                $model->billing_city = ($payment['response']['billing_details']['address']['city'])?$payment['response']['billing_details']['address']['city']:NULL;
                $model->billing_state = ($payment['response']['billing_details']['address']['state'])?$payment['response']['billing_details']['address']['state']:NULL;
                $model->billing_country = ($payment['response']['billing_details']['address']['country'])?$payment['response']['billing_details']['address']['country']:NULL;
                $model->billing_postal_code = ($payment['response']['billing_details']['address']['postal_code'])?$payment['response']['billing_details']['address']['postal_code']:NULL;
                $model->billing_line1 = ($payment['response']['billing_details']['address']['line1'])?$payment['response']['billing_details']['address']['line1']:NULL;
                $model->billing_line2 = ($payment['response']['billing_details']['address']['line2'])?$payment['response']['billing_details']['address']['line2']:NULL;
                $model->payment_status = 1;
                $save = $model->save(false);
                if($save){
                    $order = new ExperiencesOrder;
                    $order->experience_id = $id; 
                    $order->user_id = $user->id;
                    $order->payment_id = $model->id;
                    $order->experience_price = intval($experience_model->price);
                    $order->experience_adons_price = $ad_ons_price;
                    $order->net_pay = $total_pay;
                    $order->experience_adons_ids = $ad_ons_id;
                    $order->experience_adons_detail = $ad_ons_detail;
                    $order->experience_avl_id = $experience_avl_id;
                    $order->experience_start_date = $experience_start_date;
                    $order->experience_end_date = $experience_end_date;
                    $order->schedule_detail = $schedule_detail;
                    $order->total_guest_adults = $total_guest_adults;
                    $order->total_guest_children = $total_guest_children;
                    $order->total_guest_infants = $total_guest_infants;   
                    $order->save(false);

                    $order_id = $order->id;

                    for($i = 0;$i < $total_guest;$i++){
                        $expGuestModel = new ExperienceGuest();
                        $expGuestModel->order_id = $order_id;
                        $expGuestModel->booked_self = 0;
                        $expGuestModel->first_name = NULL;
                        $expGuestModel->last_name = NULL;
                        $expGuestModel->email = NULL;
                        $expGuestModel->gender = NULL;
                        $expGuestModel->insert(false);
                    }

                    //send Email
                    $this->sendEmail($order_id);

                    Yii::$app->session->setFlash('success', 'You order has been confirmed.');
                    return $this->redirect(['/order/order-detail','id' => $order_id]);
                } 

            } else if( isset($payment['error']) && ($payment['error'] == true) ){ 
                Yii::$app->session->setFlash('error', 'We are getting error in complete your payment');
                return $this->goBack(Yii::$app->request->referrer);
            } 

        }else{
            throw new \yii\web\NotFoundHttpException();
        } 
    }

}

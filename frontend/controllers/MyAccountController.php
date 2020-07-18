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
use yii\bootstrap\ActiveForm;
use yii\web\UploadedFile;

//All Models
use common\models\Experiences;
use common\models\ExperiencesSaved;
use common\models\ExperiencesPayment;
use common\models\ExperiencesOrder;
use common\models\ExperienceGuest;
use common\models\User;
use common\models\ManageUser;
use frontend\models\ChangePasswordForm;
use common\helpers\Utils;




class MyAccountController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','profile','profile-validation','change-password',
                    'change-password-validation','order-detail','wishlist-remove','guest-info-form'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','profile','profile-validation','change-password',
                            'change-password-validation','order-detail','wishlist-remove','guest-info-form'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'profile' => ['post'],
                    'profile-validation' => ['post'],
                    'change-password' => ['post'],
                    'change-password-validation' => ['post'],
                    'order-detail' => ['get'],
                    'wishlist-remove' => ['post'],
                ],
            ],
        ];
    }


    /*
     * Function for profile form ajax validation handler
     */
    public function actionProfileValidation(){
        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        $user_id = Yii::$app->user->identity->id;
        $model =  ManageUser::find()->where(['id'=>$user_id])->one();
        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) ) {
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }

        }
    }


    /*
     * Function for Change password Form Ajax Validation Handler
     */
    public function actionChangePasswordValidation(){
        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        $user_id = Yii::$app->user->identity->id;
        $model =  new ChangePasswordForm();
        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) ) {
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }

        }
    }


    /**
     * @return Response
     * Function for save change password data
     */
    public function actionChangePassword(){
        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        $model =  new ChangePasswordForm();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if( (Yii::$app->request->isAjax) && ($model->load(Yii::$app->request->post())) ) {
            if ($model->validate()) {
                $isSave = $model->savePassword($model->cNewPassword);
                if($isSave){
                    return $this->asJson([
                        'success'=>true,
                        'message'=>'Your Password Changed Successfully'
                    ]);
                }else{
                    return $this->asJson([
                        'success'=>false,
                        'message'=>'Error in change your password.'
                    ]);
                }
            }
        }else{
            throw new \yii\web\UnauthorizedHttpException();
        }

    }


    /**
     * @return Response
     *  Function for Save Profile
     */
    public function actionProfile(){

        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        $user_id = Yii::$app->user->identity->id;
        $model =  ManageUser::find()->where(['id'=>$user_id])->one();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if( (Yii::$app->request->isAjax) && ($model->load(Yii::$app->request->post())) ) {
            if ($model->validate()) {
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
                if($model->save()){
                    return $this->asJson([
                        'success'=>true,
                        'message'=>'Profile updated successfully'
                    ]);

                }else{
                    return $this->asJson([
                        'success'=>false,
                        'message'=>'Opps!! Update in profile update'
                    ]);
                }
            }

        }else{
            throw new \yii\web\UnauthorizedHttpException();
        }
    }


    public function actionGuestInfoForm($order_id){

        $guest = ExperienceGuest::find()->where(['order_id'=>$order_id])
            ->orderBy(['booked_self' => SORT_DESC])
            ->asArray()->all();
        $orderDetail = ExperiencesOrder::find()->where(['id'=>$order_id])->select(['experiences_order.*',
            '(total_guest_adults+total_guest_children+total_guest_infants) as guest_t',
            '(total_guest_adults*experience_price) as adults_tp',
            '(total_guest_children*experience_price) as children_tp',
            '(total_guest_infants*experience_price) as infants_tp',
        ])->asArray()->one();
        if($guest){
            return $this->renderAjax('@app/views/my-account/ajax/guest_info_form', [
                'model' => [],
                'orderDetail'=>$orderDetail,
                'guests' => $guest
            ]);
        }else{
            return false;
        }
    }


    /**
     * Function for show order summary modal
     * @param $id
     * @return string
     * @throws \yii\web\UnauthorizedHttpException
     */
    public function actionOrderDetail($id){

        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        if( (Yii::$app->request->isAjax) && (Yii::$app->request->isGet) ) {
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
            return $this->renderAjax('@app/views/my-account/ajax/view_order_summary', [
                'model' => [],
                'orderDetail'=>$orderDetail
            ]);

        }

    }

    public function actionWishlistRemove($id){

        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        if( (Yii::$app->request->isAjax) && (Yii::$app->request->isPost) ) {
           $user_id = Yii::$app->user->identity->id;
           $saved = ExperiencesSaved::findOne(['experiences_id'=>$id,'user_id'=>$user_id]);
           Yii::$app->response->format = Response::FORMAT_JSON;
           if($saved){
               $saved->delete();
               return $this->asJson([
                   'success'=>true,
                   'message'=>'Removed From wishlist'
               ]);
           }
        }
    }

    /**
     * function for load user profile section
     * @return string
     * @throws \yii\web\UnauthorizedHttpException
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        if( (Yii::$app->request->isAjax) ){  //Loade Tab with ajax

            $page = Yii::$app->request->get('page');
            $view = '';
            $pageData = [];
            switch ($page) {
                case "profile":
                    $view = 'profile';
                    $pageData = $this->getMyProfile();
                    break;
                case "change_password":
                    $view = 'change_password';
                    $pageData = new ChangePasswordForm();
                    break;
                case "orders":
                    $view = 'orders';
                    $pageData = $this->getMyOrdersList();
                    break;
                case "wishlist":
                    $view = 'wishlist';
                    $pageData = $this->getMyWishList();
                    break;
                default:
                    $view = 'profile';
                    $pageData = $this->getMyProfile();
            }
//            echo '<pre>';print_r($pageData);die;

            return $this->renderAjax('@app/views/my-account/ajax/'.$view,['pageData' => $pageData]);
        }else{
            $this->view->params['header_bg'] = 'header_bg';
            return $this->render('@app/views/my-account/index',[]);
        }

    }


    /**
     * Callback function to get My Orders List
     * @return array
     */
    protected function getMyOrdersList(){
        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        $user_id = Yii::$app->user->identity->id;
        return ExperiencesOrder::find()->select('experiences_order.*,(total_guest_adults+total_guest_children+total_guest_infants) as totalGuest')
                ->with([
                'experience' => function($model){
                   $model->select('id,title,experiences_image_url');
                },
                'user'=>function($model){
                    $model->select('id,first_name,last_name,profile_photo');
                }
           ])
        ->where(['user_id' => $user_id])
        ->asArray()->all();
    }

    /**
     * Callback function to get My wishlist Experiences
     * @return array
     */
    protected function getMyWishList(){

        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }

        $user_id = Yii::$app->user->identity->id;
        return ExperiencesSaved::find()
            ->with([
                'experiences' => function($model){
                    $model->with(['category'=> function($model){
                        $model->select('id,name,slug');
                    }])->select('id,title,slug,experiences_image_url,category_id,price,duration,
                    duration_type,group_size,activity_level,country,state,city,featured');
                },
                'user'=>function($model){
                    $model->select('id,first_name,last_name,profile_photo');
                }
            ])
            ->where(['user_id' => $user_id])
            ->asArray()->all();

    }

    /**
     * Callback function to get My Profile
     * @return array
     */
    protected function getMyProfile(){
        if(Yii::$app->user->isGuest){
            throw new \yii\web\UnauthorizedHttpException();
        }
        $user_id = Yii::$app->user->identity->id;
        return ManageUser::find()->where(['id'=>$user_id])->one();

    }

}

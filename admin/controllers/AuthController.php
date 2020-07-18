<?php
namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use admin\controllers\BaseController;
use admin\models\PasswordResetRequestForm;
use admin\models\ResetPasswordForm;
use common\models\AdminLoginForm;
use common\models\ManageUser;
use common\models\User;
use common\models\Experiences;
use common\models\ExperiencesOrder;
use common\helpers\Utils;
use common\helpers\SendEmail;
use admin\models\ChangePasswordForm;

/**
 * Auth controller
 */
class AuthController extends BaseController
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
                        'actions' => ['login','request-password-reset','reset-password', 'error','manage-profile','change-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','manage-profile','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->response->redirect(['/login']);
                 },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    //This is for 404 page not found handler
    public function beforeAction($action) {
        $exception = Yii::$app->getErrorHandler()->exception;
        if(parent::beforeAction($action)) {
            if( ($action->id == 'error') && isset($exception->statusCode) && ($exception->statusCode == '404') ){
                Yii::$app->session->setFlash('error', 'Sorry!! Request page not found.');
                Yii::$app->response->redirect(['/login']);
                return false;
            }
        }
        return true;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(['/dashboard']);
        }else{
            Yii::$app->response->redirect(['/login']);
        } 
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'auth_layout';

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

        /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'auth_layout';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (SendEmail::sendPasswordResetToken($model->email)) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }


        /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
     public function actionResetPassword($token)
     {
        $model = new ResetPasswordForm();
        $validate =  $model->validateResetToken($token);
        if(!$validate){
            Yii::$app->session->setFlash('error', 'Sorry, password reset link is invalid/expire');
            return $this->redirect('request-password-reset');
        } 

        $this->layout = 'auth_layout';
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Success! Your new password changed successfully.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
 

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if (Yii::$app->user->isGuest) {
            throw new \yii\web\MethodNotAllowedHttpException();
        }else {
            Yii::$app->user->logout();
            Yii::$app->session->setFlash('success', 'You have been logged out successfully');
            return $this->goHome();
        }
    } 

    /**
     * Manage Profile action.
     *
     * @return string
     */
    public function actionManageProfile(){

        if (Yii::$app->user->isGuest) {
            throw new \yii\web\UnauthorizedHttpException();
        }else{

            $user_id = Yii::$app->user->identity->id;
            $model = ManageUser::findOne($user_id);
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

                if($model->save()){
                    Yii::$app->session->setFlash('success', "Your Profile Updated Successfully.");
                    return $this->redirect(['/manage-profile']);
                }
            }

            return $this->render('@app/views/auth/profile_update', [
                'model' => $model,
            ]);

        }



    }

     /**
     * Manage Profile action.
     *
     * @return string
     */
    public function actionChangePassword(){

        if (Yii::$app->user->isGuest) {
            throw new \yii\web\UnauthorizedHttpException();
        }else{
            $model = new ChangePasswordForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if($model->savePassword($model->cNewPassword)){
                    Yii::$app->session->setFlash('success', "Your Password Changed Successfully.");
                    return $this->redirect(['/change-password']);
                }
            }

            return $this->render('@app/views/auth/change_password', [
                'model' => $model,
            ]);
        }




    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $this->goHome();
        }
    }

}

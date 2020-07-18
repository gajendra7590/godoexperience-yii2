<?php

namespace frontend\controllers;


use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\controllers\BaseController;
use yii\bootstrap\ActiveForm;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\components\AuthHandler;


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
                'only' => ['logout','login', 'register','forgot-password','verify-email','register-validate','forgot-password-validate','set-new-password-validate'],
                'rules' => [
                    [
                        'actions' => ['login', 'register','forgot-password','verify-email','register-validate','forgot-password-validate','set-new-password-validate'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->response->redirect(['/']); 
                 },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'register-validate' => ['post'],
                    'forgot-password-validate' => ['post'],
                    'set-new-password-validate' => ['post']
                ],
            ],
        ];
    }

      

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    //Manage Social Login
    public function onAuthSuccess($client)
    { 
        (new AuthHandler($client))->handle();
    }


    public function actionIndex()
    {
        return $this->render('index');
    }
 
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $get = Yii::$app->request->queryParams;
        $this->layout = 'auth';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Welcome back,'.Yii::$app->user->identity->first_name);
            if(isset($get['ref']) &&($get['ref']!='')){
                $this->redirect($get['ref']);
            }else{
                $this->redirect(Yii::$app->request->referrer);
                //return $this->goBack();
            }
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * This function is only for registraion form validation with Ajax
     */
    public function  actionRegisterValidate(){

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $this->layout = 'auth';
        $model = new SignupForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }
        }
    }


     /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        } 
        $this->layout = 'auth'; 
        $model = new SignupForm();
        if ( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', "Congratulations! Your account has been created successfully.<br/>Please verify your account(verification link sent on your email address).");
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->asJson([
                'success' => true,
                'redirect_url' => \yii\helpers\Url::to(['/login']),
                'message' => 'You have been registered successfully'
            ]);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }


    /**
     * Function is for validate forgot password ajax form
     */
    public function  actionForgotPasswordValidate(){

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'auth';
        $model = new PasswordResetRequestForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionForgotPassword()
    { 
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        } 
        
        $this->layout = 'auth';
        $model = new PasswordResetRequestForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Reset password link sent successfully, <br/> Please check your email inbox.');
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $this->asJson([
                    'success' => true,
                    'redirect_url' => \yii\helpers\Url::to(['/login']),
                    'message' => 'Reset Password Link Sent Successfully'
                ]);

            } else {
                Yii::$app->session->setFlash('error', 'Sorry, We are unable to sent email on your email address.');
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $this->asJson([
                    'success' => false,
                    'message' => 'Error in sent email on your email address'
                ]);
            }
        }

        return $this->render('forgotPassword', [
            'model' => $model,
        ]);
    }


    /**
     * Function is for validate forgot password ajax form
     */
    public function  actionSetNewPasswordValidate($token){

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {

            Yii::$app->session->setFlash('error', 'Sorry! Your reset password link is invalid/expired,please resend link.');
            return $this->redirect(['/forgot-password']);
        }


        $this->layout = 'auth';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }else{
                return true;
            }
        }
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
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) { 

            Yii::$app->session->setFlash('error', 'Sorry! Your reset password link is invalid/expired,please resend link.'); 
            return $this->redirect(['/forgot-password']);
        }

        $this->layout = 'auth';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Congratulations! You have been changed your password successfully .');
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->asJson([
                'success' => true,
                'redirect_url' => \yii\helpers\Url::to(['/login']),
                'message' => 'Congratulations! You have been changed your password successfully'
            ]);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            Yii::$app->session->setFlash('error', 'Verify email token is invalid/expired,please try again later.'); 
            return $this->redirect(['/login']);
            //throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

     /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    { 
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'You have been logged out successfully');
        $this->redirect(Yii::$app->request->referrer);
        //return $this->redirect(['/']);
    }

}

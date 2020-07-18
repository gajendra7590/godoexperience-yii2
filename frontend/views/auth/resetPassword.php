<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Experiences - Reset Password'; 
$this->params['breadcrumbs'][] = $this->title;

$token = Yii::$app->request->get('token');

?>
<div class="login_Content">
    <aside class="login_Form forget_Content">
        <div class="fields">
            <h1>Set New Password</h1>
            <div class="overlayer-myac"></div>
            <div class="loader-myac">
                <span class="loader-inner-myac"></span>
            </div>
            <!-- Yii Form Start Here -->
            <?php $form = ActiveForm::begin(['id'=>'set_new_password_form',
                'action' => Url::to(['/auth/set-new-password-validate','token'=>$token]),
                'enableClientValidation' => false,
                'enableAjaxValidation' => true,
                'options' => ['enctype' => 'multipart/form-data','submit-url' => Url::to(['/reset-password','token'=>$token])]]);
            ?>
                <?= $form->field($model, 'password',[
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form_group_modify has-feedback' 
                        ],
                        'template'=>'<label for="email" class="label_modify">Enter New Password</label>{input}{error}{hint}',
                ])->passwordInput(['placeholder'=>'*********','class' => 'input_modify','autocomplete'=>'off']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save New Password', ['class' => 'btn btn-primary register_Btn btn_load', 'name' => 'login-button']) ?>
                </div>

                <div class="forget_Password">
                    <a class="underline" href="<?php echo Url::to(['/forgot-password']);?>"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i>  Resend Password Reset Link</a>
                </div>
            <?php ActiveForm::end(); ?> 
            <!-- Yii Form End Here -->
        </div>
    </aside>
    <article class="login_Details">
        <div class="login_Details_Content">
            <div class="login_Img">
                <img src="<?php echo Url::to('@web/asset/images/thumnails/login_img.png');?>" alt="logo">
            </div>
            <div class="login_Note">
                <?= $this->render('_side_content'); ?>
            </div>
        </div>
    </article>
</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?> 
 
<div class="login_Content">
    <aside class="login_Form forget_Content">
        <div class="fields">
            <h1>Reset Password</h1>
            <p>Please enter the email address you used when creating your account.</p>
            <div class="overlayer-myac"></div>
            <div class="loader-myac">
                <span class="loader-inner-myac"></span>
            </div>
            <!-- Yii Form Start Here -->
            <?php $form = ActiveForm::begin(['id'=>'reset_password_form',
                'action' => Url::to(['/auth/forgot-password-validate']),
                'enableClientValidation' => false,
                'enableAjaxValidation' => true,
                'options' => ['enctype' => 'multipart/form-data','submit-url' => Url::to(['/forgot-password'])]]);
            ?>
                <?= $form->field($model, 'email',[
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form_group_modify has-feedback' 
                        ],
                        'template'=>'<label for="email" class="label_modify">EMAIL ADDRESS</label>{input}{error}{hint}',
                ])->textInput(['placeholder'=>'Email Address','class' => 'input_modify','autocomplete'=>'off']) ?>

                <div class="form-group">
                    <?= Html::submitButton('send reset email', ['class' => 'btn btn-primary register_Btn btn_load', 'name' => 'login-button']) ?>
                </div>

                <div class="forget_Password">
                    <a class="underline" href="<?php echo Url::to(['/login']);?>"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Go back to sign-in</a>
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

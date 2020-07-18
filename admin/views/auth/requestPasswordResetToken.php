<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login_Content">
        <aside class="login_Form forget_Content">
            <div class="fields">
                <h1>Reset Password</h1>
                <p>Please enter the email address you used when creating your account.</p> 

                <!--Yii form start  -->
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'email',[
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form_group_modify has-feedback' 
                        ],
                        'template'=>'<label for="email" class="label_modify">Email Address</label>{input}{error}{hint}',
                    ])->textInput(['placeholder'=>'EMAIL ADDRESS','class' => 'input_modify','autocomplete'=>'off']) ?>  
                    &nbsp;
                    <div class="form-group">
                        <?= Html::submitButton('send reset email', ['class' => 'btn btn-primary register_Btn', 'name' => 'login-button']) ?>
                    </div>

                    <div class="forget_Password">
                        <a class="underline" href="<?php echo Url::to('login');?>"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Go back to sign-in</a>
                    </div>

                 <?php ActiveForm::end(); ?>  
                 <!--Yii form end  -->
            </div>
        </aside>
        <article class="login_Details">
            <div class="login_Details_Content">
                <div class="login_Img">
                    <img src="<?= Url::to('asset/images/thumnails/login_img.png');?>" alt="logo">
                </div>
                <div class="login_Note">
                    <?= $this->render('_side_content'); ?>
                </div>
            </div>
        </article>
    </div>


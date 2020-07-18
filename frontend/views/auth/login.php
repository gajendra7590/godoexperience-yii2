<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Experiences - Login Your Account'; 
$this->params['breadcrumbs'][] = $this->title;
?>
    
<div class="login_Content"> 
    <aside class="login_Form">
        <div class="fields">
            <h1>Sign In</h1>

               <!--Yii form start  -->
               <?php $form = ActiveForm::begin(['id' => 'login-form']); ?> 
                    <?= $form->field($model, 'email',[
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form_group_modify has-feedback' 
                        ],
                        'template'=>'<label for="email" class="label_modify">Email</label>{input}{error}{hint}',
                    ])->textInput(['placeholder'=>'Email Address','class' => 'input_modify','autocomplete'=>'off']) ?>

                    <?= $form->field($model, 'password',[
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form_group_modify has-feedback' 
                        ],
                        'template'=>'<label for="password" class="label_modify">Password</label>{input}{error}{hint}',
                    ])->passwordInput(['placeholder'=>'Password','class' => 'input_modify','autocomplete'=>'off']) ?>  

                    <?= $form->field($model, 'rememberMe',[
                        'options' => [
                            'tag' => 'label',
                            'class' => 'login_checkbox' 
                        ],
                        'template'=>'Keep me signed in {input}<span class="checkmark_Login"></span>{error}{hint}',
                    ])->label(false)->checkbox([], false); ?>

                    <div class="form-group">
                        <?= Html::submitButton('sign in', ['class' => 'btn register_Btn', 'name' => 'login-button']) ?>
                    </div>

                    <div class="or-div"> OR</div>

                    <?php $authAuthChoice = AuthChoice::begin([
                            'baseAuthUrl' => ['social/auth'],
                            'popupMode' => false,
                          ]); ?>
                            <ul>
                                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                                    <?php if($client->getName() == 'google'){?>
                                            <li>
                                                <?= $authAuthChoice->clientLink($client,
                                                    '<i class="fa fa-google icon-google"></i>  Sign in with Google </button>',[
                                                        'class' => 'google_Btn',
                                                ])?>
                                            </li>
                                    <?php }?>
                                <?php endforeach; ?>
                            </ul>
                    <?php AuthChoice::end(); ?> 


                    <div class="forget_Password">
                        <a class="underline" href="<?php echo Url::to('forgot-password');?>">Forgot your password?</a>
                    </div>  
                    <div class="step-info">
                        Don’t have an account .
                        <a class="underline" href="<?php echo Url::to(['/register']);?>">Register</a>
                    </div>
                <?php ActiveForm::end(); ?>  
                <!--Yii form end  --> 
        </div>
    </aside>
    <article class="login_Details">
        <div class="login_Details_Content">
            <div class="login_Img">
                <img src=" <?php echo Url::to('@web/asset/images/thumnails/login_img.png');?>" alt="logo">
            </div>
            <div class="login_Note">
                <?= $this->render('_side_content'); ?>
            </div>
        </div>
    </article>
</div>

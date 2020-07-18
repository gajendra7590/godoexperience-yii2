<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\authclient\widgets\AuthChoice;

$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Experiences - Create New Account';
?>
<div class="register_From">
    <h1>Get your free Go DO Experience account now.</h1>
    <div class="fields">
            <div class="overlayer-myac"></div>
            <div class="loader-myac">
                <span class="loader-inner-myac"></span>
            </div>
            <!--Yii form start  -->
            <?php $form = ActiveForm::begin(['id'=>'register_form',
                'action' => Url::to(['/auth/register-validate']),
                'enableClientValidation' => false,
                'enableAjaxValidation' => true,
                'options' => ['enctype' => 'multipart/form-data','submit-url' => Url::to(['/register'])]]); ?>
                <?= $form->field($model, 'first_name',[
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form_group_modify has-feedback' 
                    ],
                    'template'=>'<label for="First Name" class="label_modify">First Name</label>{input}{error}{hint}',
                ])->textInput(['placeholder'=>'Enter First Name','class' => 'input_modify','autocomplete'=>'off']) ?>

                <?= $form->field($model, 'last_name',[
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form_group_modify has-feedback' 
                    ],
                    'template'=>'<label for="Last Name" class="label_modify">Last Name</label>{input}{error}{hint}',
                ])->textInput(['placeholder'=>'Enter Last Name','class' => 'input_modify','autocomplete'=>'off']) ?>


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

                <div class="form-group">
                    <?= Html::submitButton('Let\'s get started <i class="fa fa-angle-right"></i>', ['class' => 'btn register_Btn', 'name' => 'login-button']) ?>
                </div>

                <div class="or-div">OR</div>

                        <?php $authAuthChoice = AuthChoice::begin([
                            'baseAuthUrl' => ['social/auth'],
                            'popupMode' => false,
                          ]); ?>
                            <ul>
                                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                                    <?php if($client->getName() == 'google'){?>
                                            <li>
                                                <?= $authAuthChoice->clientLink($client,
                                                    '<i class="fa fa-google icon-google"></i> Sign up with Google',[
                                                        'class' => 'google_Btn',
                                                ])?>
                                            </li>
                                    <?php }?>
                                <?php endforeach; ?>
                            </ul>
                        <?php AuthChoice::end(); ?> 

                <!-- <button class="google_Btn"><i class="fa fa-google icon-google"></i> Sign up with Google</button> -->
                <div class="step-info">
                    Already have an account? <a class="underline" href="<?php echo Url::to(['/login']);?>">Sign in now</a>
                </div>
            <?php ActiveForm::end(); ?>  
            <!--Yii form end  -->  
    </div>
</div>

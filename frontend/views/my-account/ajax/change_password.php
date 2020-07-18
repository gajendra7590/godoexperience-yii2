<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;
?>
<!--My Account Changes Password-->
<section class="myac-psw-chnage">
    <div class="my-ac-title">
        <h3>Password change</h3>
    </div>
    <?php $form = ActiveForm::begin([
        'id'=>'change_password_form',
        'action' => Url::to(['/my-account/change-password-validation']),
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'options' => ['enctype' => 'multipart/form-data','submit-url' => Url::to(['/my-account/change-password']) ]
    ]); ?>
        <div class="row">
            <?= $form->field($pageData, 'oldPassword',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-12'
                ],
                'template'=>'<label for="email" class="label_Mod">Current Password <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Enter Your Current Password...','class' => 'input_modify','autocomplete'=>'off']) ?>
        </div>
        <div class="row">
            <?= $form->field($pageData, 'newPassword',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="email" class="label_Mod">New Password <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Enter Your New Password...','class' => 'input_modify','autocomplete'=>'off']) ?>
            <?= $form->field($pageData, 'cNewPassword',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="email" class="label_Mod">Confirm New Password <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Enter Confirm Password...','class' => 'input_modify','autocomplete'=>'off']) ?>
        </div>
        <div class="my-ac-btn">
            <button class="btn_Primary">Change Password</button>
        </div>
    <?php ActiveForm::end(); ?>
</section>
<!--My Account Changes Password-->

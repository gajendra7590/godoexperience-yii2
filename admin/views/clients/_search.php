<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ManageUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manage-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'bussiness_name') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'profile_photo') ?>

    <?php // echo $form->field($model, 'phone_home') ?>

    <?php // echo $form->field($model, 'phone_office') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'social_google_uid') ?>

    <?php // echo $form->field($model, 'social_google_picture') ?>

    <?php // echo $form->field($model, 'social_google_last_login') ?>

    <?php // echo $form->field($model, 'social_fb_uid') ?>

    <?php // echo $form->field($model, 'social_fb_picture') ?>

    <?php // echo $form->field($model, 'social_fb_last_login') ?>

    <?php // echo $form->field($model, 'social_twitter_uid') ?>

    <?php // echo $form->field($model, 'social_twitter_picture') ?>

    <?php // echo $form->field($model, 'social_twitter_last_login') ?>

    <?php // echo $form->field($model, 'social_linkedin_uid') ?>

    <?php // echo $form->field($model, 'social_linkedin_picture') ?>

    <?php // echo $form->field($model, 'social_linkedin_last_login') ?>

    <?php // echo $form->field($model, 'social_github_uid') ?>

    <?php // echo $form->field($model, 'social_github_picture') ?>

    <?php // echo $form->field($model, 'social_github_last_login') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'role_id') ?>

    <?php // echo $form->field($model, 'last_login') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

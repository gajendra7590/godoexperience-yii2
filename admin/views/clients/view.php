<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ManageUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manage Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manage-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'bussiness_name',
            'email:email',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'verification_token',
            'profile_photo',
            'phone_home',
            'phone_office',
            'gender',
            'dob',
            'city',
            'state',
            'country',
            'zip',
            'ip_address',
            'social_google_uid',
            'social_google_picture',
            'social_google_last_login',
            'social_fb_uid',
            'social_fb_picture',
            'social_fb_last_login',
            'social_twitter_uid',
            'social_twitter_picture',
            'social_twitter_last_login',
            'social_linkedin_uid',
            'social_linkedin_picture',
            'social_linkedin_last_login',
            'social_github_uid',
            'social_github_picture',
            'social_github_last_login',
            'status',
            'role_id',
            'last_login',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use admin\assets\AuthAsset;
use Yii\helpers\Url;
use common\helpers\Utils;

AuthAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= Utils::IMG_URL('uploads/other/fav_icn.png');?>" type="image/x-icon" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="register_Contnet">
        <div class="register_Logo">
            <a href="<?= Url::to('');?>"><img src="<?= Url::to('asset/images/icons/logo_header.png');?>" alt="logo"></a>
        </div> 
        <div class="login-alert">
            <div class="auth-layout-alert">
           <?php if(Yii::$app->session->hasFlash('success')):?>
                <div class="alert-success alert-dismissible alert_box">             
                    <?php echo Yii::$app->session->getFlash('success'); ?>
                </div>
            <?php endif; ?>
            <?php if(Yii::$app->session->hasFlash('error')):?>
                <div class="alert-danger alert-dismissible alert_box">             
                   <?php echo Yii::$app->session->getFlash('error'); ?>
                </div>
            <?php endif; ?>
            <?php if(Yii::$app->session->hasFlash('warning')):?>
                <div class="alert-warning alert-dismissible alert_box">             
                    <?php echo Yii::$app->session->getFlash('warning'); ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </div>  
    <!-- Content Appended here -->
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

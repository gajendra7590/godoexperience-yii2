<?php

/* @var $this \yii\web\View */
/* @var $content string */

use admin\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use common\helpers\Utils;

AppAsset::register($this);
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
<body class="app sidebar-mini rtl">
<?php $this->beginBody() ?>
 
<?php 
    echo $this->render('header'); 
    echo $this->render('sidebar'); 
?> 
<!-- App Content Start -->
<main class="app-content"> 
    <div class="admin-alert"> 
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
     <?php echo $content; ?>
</main> 
<!-- App Content Closed -->
 <!-- Footer Area Start -->
<footer class="footer_content">
        <p>&copy; 2020 Go Do Experiences, All rights reserved</p>
</footer>
<!-- Footer Area Closed -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

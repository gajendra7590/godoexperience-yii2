<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ManageUser */

$this->title = 'Create Client';
$this->params['breadcrumbs'][] = ['label' => 'Create Client', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?> 
    </div>
</section>

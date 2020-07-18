<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Amenities */

$this->title = 'Create Amenities';
?>

<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele">
        <?= $this->render('_form', [
            'model' => $model,
            'categories' => $categories
        ]) ?>
    </div>
    <!-- Edit add_new_client section -->
</section>

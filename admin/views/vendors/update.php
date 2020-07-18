<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ManageUser */

$this->title = 'Update Vendor'; 
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?> 
    </div>
</section>


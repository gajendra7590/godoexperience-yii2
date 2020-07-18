<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ExperienceCategories */

$this->title = 'Add New Category';
$this->params['breadcrumbs'][] = ['label' => 'Experience Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele"> 
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?> 
    </div>
    <!-- Edit add_new_client section -->
</section>
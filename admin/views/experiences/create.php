<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ManageUser */

$this->title = 'Create Experiences';
$this->params['breadcrumbs'][] = ['label' => 'Create Experiences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele">
        <?= $this->render('_form', [
            'model' => $model,
            'categories' => $categories,
            'addOnsHtml' => isset($addOnsHtml)?$addOnsHtml:'',
            'mediaHtml' => isset($mediaHtml)?$mediaHtml:'', 
            'experiencesDatesHtml'=> isset($experiencesDatesHtml)?$experiencesDatesHtml:''
        ]) ?> 
    </div>
</section>

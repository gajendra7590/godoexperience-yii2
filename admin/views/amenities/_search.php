<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\AmenitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="amenities-search">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => ''
            ],
        ]); ?>
            <div class="col-sm-12 col-lg-3">
                <?= $form->field($model, 'category_id')->dropDownList(
                        $categories,[
                         'class'=>'form-control input_modifier select_mod',
                         'onchange'=>'this.form.submit()'])
                ?>
            </div>
      <?php ActiveForm::end(); ?>
</div>

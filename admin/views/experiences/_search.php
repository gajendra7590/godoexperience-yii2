<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>

<div class="experiences-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => ''
        ],
    ]); ?>
    <div class="col-sm-12">
        <div class="filter-title">
            <h3>filter</h3>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <?= $form->field($model, 'featured')->dropDownList(
            [''=>'Select option','1'=>'Yes','0'=>'No'],
            ['class'=>'form-control input_modifier select_mod',
                'onchange'=>'this.form.submit()'])->label('Filter experiences by featured')
        ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <?= $form->field($model, 'status')->dropDownList(
            [''=>'Select experience status','1'=>'Active','0'=>'InActive'],
            ['class'=>'form-control input_modifier select_mod',
                'onchange'=>'this.form.submit()'])->label('Filter experiences by status')
        ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <?= $form->field($model, 'category_id')->dropDownList(
            $categories,[
            'class'=>'form-control input_modifier select_mod',
            'onchange'=>'this.form.submit()'])->label('Filter experiences by categories')
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

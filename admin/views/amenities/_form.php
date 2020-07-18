<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;

$btn_title = ( isset($model->id) && ($model->id > 0))?'Update Amenity':'Create Amenity';
?>

<div class="experience-categories-form">
    <?php $form = ActiveForm::begin(); ?>
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'category_id')->dropDownList($categories,['class'=>'form-control input_modifier select_mod']) ?>
        </div>
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'title')->textarea(['class'=>'form-control input_modifier','placeholder'=>'Enter Amenities title']) ?>
        </div>
    </div>
    <!--End row block -->
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'description')->textarea(['class'=>'form-control input_modifier','placeholder'=>'Enter Amenities Description']) ?>
        </div>
        <div class="col-sm-12 col-lg-6">

            <?= $form->field($model, 'icon')->widget('\insolita\iconpicker\Iconpicker',
                [
                    'iconset'=>'fontawesome',
                    'clientOptions'=>['rows'=>8,'cols'=>10,'placement'=>'right'],
                ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'status')->dropDownList([
                1 => 'Active',
                0 => 'Inactive'
            ],['class'=>'form-control input_modifier select_mod']) ?>
        </div>
    </div>
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="exp__Frm--btn">
                <?= Html::submitButton($btn_title, ['class' => 'btn btn_primary cst_btn mr-10']) ?>
                <a href="<?= Url::to(['/categories']); ?>" class="btn btn-secondary cst_btn">Cancel</a>
            </div>
        </div>
    </div>
    <!--End row block -->
    <?php ActiveForm::end(); ?>
</div>

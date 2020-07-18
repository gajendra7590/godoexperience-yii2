<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Update Company Info';

?>

<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele">
        <div class="experience-categories-form">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_owner')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Owner name...']) ?>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_name')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Company name..']) ?>
                </div>
            </div>
            <!--End row block -->
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_email')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category Name']) ?>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_phone')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category title']) ?>
                </div>
            </div>
            <!--End row block -->
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_city')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category Name']) ?>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_state')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category title']) ?>
                </div>
            </div>
            <!--End row block -->
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_country')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category Name']) ?>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_zip')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category title']) ?>
                </div>
            </div>
            <!--End row block -->
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_facebook')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter facebook page link']) ?>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_instagram')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter instagram page link']) ?>
                </div>
            </div>
            <!--End row block -->
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_twiiter')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter twitter page link']) ?>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <?= $form->field($model, 'company_pinterest')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter pinterest page link']) ?>
                </div>
            </div>
            <!--End row block -->
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <?= $form->field($model, 'company_desc')->textarea(
                            ['class'=>'form-control input_modifier','placeholder'=>'Enter Category Description','rows'=>5]
                    ) ?>
                </div>
            </div>
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="exp__Frm--btn">
                        <?= Html::submitButton('Update Company Info', ['class' => 'btn btn_primary cst_btn mr-10']) ?>
                        <a href="<?= Url::to(['/']); ?>" class="btn btn-secondary cst_btn">Cancel</a>
                    </div>
                </div>
            </div>
            <!--End row block -->
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- Edit add_new_client section -->
</section>
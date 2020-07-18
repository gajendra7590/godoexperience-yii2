<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $model app\models\ExperienceCategories */
/* @var $form yii\widgets\ActiveForm */ 
$btn_title = ( isset($model->id) && ($model->id > 0))?'Update Category':'Create Category';
$img_url = ($model->category_image_url!='')?(Utils::IMG_URL($model->category_image_url) ):'../asset/images/icons/upload_img.png';
?>

<div class="experience-categories-form"> 
    <?php $form = ActiveForm::begin(); ?>  
    <!-- profile upload Section-->
    <div class="exp__Prfile">
        <div class="row">
            <div class="col-sm-12">
                <div class="exp__Prfile--img">
                    <div class="exp__Prfile--edit"> 
                    <?= $form->field($model, 'category_image')->fileInput(['id'=>'imageUpload'])->label(false) ?>                        
                    </div>
                    <div class="exp__Prfile--preview">
                        <div id="imagePreview" style='background-image: url(<?php echo $img_url;?>);'>
                        <!-- ../asset/images/icons/upload_img.png -->
                        </div>
                    </div>
                </div>
                <div class="exp__Prfile--btn">
                    <label for="imageUpload" class="btn btn_primary--outline cst_btn mr-10">Choose Image</label>
                    <!-- <button class="btn btn-secondary cst_btn">Remove</button> -->
                    <p>At least 256 X 256px PNG or JPG file</p>
                </div>
            </div>
        </div>
    </div>
    <!--End of profile upload Section--> 
       <!-- row block -->
        <div class="row"> 
            <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'name')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Category Name']) ?> 
            </div>
            <div class="col-sm-12 col-lg-6">
                <?= $form->field($model, 'title')->textarea(['class'=>'form-control input_modifier','placeholder'=>'Enter Category title']) ?>
            </div>  
        </div>
       <!--End row block --> 
       <!-- row block -->
        <div class="row"> 
            <div class="col-sm-12 col-lg-6">
                <?= $form->field($model, 'description')->textarea(['class'=>'form-control input_modifier','placeholder'=>'Enter Category Description']) ?>
            </div>   
            <div class="col-sm-12 col-lg-6">
                <?= $form->field($model, 'status')->dropDownList([
                    1 => 'Active', 
                    0 => 'Inactive'
                ],['class'=>'form-control input_modifier select_mod']) ?>
            </div>  
        </div>
       <!-- row block -->
       <!-- row block -->
       <div class="row">   
            <div class="col-sm-6">
                    <?= $form->field($model, 'featured',[
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form_group has-feedback' 
                    ],
                    'template'=>'<div class="custom_checkboxGreen">
                                    <div class="checkbox_block">
                                        <span class="checkbox_lable"></span>{input} Mark as featured <span class="checkmark"></span>
                                    </div>
                                 </div>',
                    ])->checkbox()->label(false)->checkbox([], false); ?>
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


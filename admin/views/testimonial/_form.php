<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $model app\models\ExperienceCategories */
/* @var $form yii\widgets\ActiveForm */ 
$btn_title = ( isset($model->id) && ($model->id > 0))?'Update Testimonial':'Create Testimonial';
$img_url = ($model->client_image!='')?(Utils::IMG_URL($model->client_image)):'../asset/images/icons/upload_img.png';
?>

<div class="experience-categories-form"> 
    <?php $form = ActiveForm::begin(); ?>  
    <!-- profile upload Section-->
    <div class="exp__Prfile">
        <div class="row">
            <div class="col-sm-12">
                <div class="exp__Prfile--img">
                    <div class="exp__Prfile--edit"> 
                    <?= $form->field($model, 'tm_image')->fileInput(['id'=>'imageUpload'])->label(false) ?>                        
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
            <?= $form->field($model, 'client_name')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Client Name']) ?> 
            </div>
            <div class="col-sm-12 col-lg-6">
                <?= $form->field($model, 'client_position')->textarea(['class'=>'form-control input_modifier','placeholder'=>'Enter Client Position']) ?>
            </div>  
        </div>
       <!--End row block --> 
       <!-- row block -->
       <div class="row"> 
       <div class="col-sm-12 col-lg-12">
            <?= $form->field($model, 'client_message')->widget(CKEditor::className(), [
                        'options' => [
                            'rows' => 15, 
                        ],
                        'preset' => 'custom', 
                        'clientOptions' => [ 
                            ['height' => 200],
                            'toolbarGroups' => [
                                ['name' => 'document', 'groups' => ['mode', 'document', 'doctools' ]],
                                ['name' => 'clipboard', 'groups' => ['clipboard', 'undo' ]],
                                ['name' => 'editing', 'groups' => ['find', 'selection', 'spellchecker' ]],
                                '/',
                                ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup' ]],
                                ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi' ]],
                                ['name' => 'links'],
                                ['name' => 'insert'],
                                '/',
                                ['name' => 'styles'],
                                ['name' => 'size'],
                                ['name' => 'colors'],
                                ['name' => 'tools'],
                                ['name' => 'others']
                            ],
                        ],
                    ]) ?>
                
            </div>  
        </div>
       <!--End row block -->         
       
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


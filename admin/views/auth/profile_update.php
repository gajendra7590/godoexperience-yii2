<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update Your Profile';
$this->params['breadcrumbs'][] = ['label' => 'User Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$img_url = ($model->profile_photo!='')?(Utils::IMG_URL($model->profile_photo)):'asset/images/icons/upload_img.png';

?>

<section class="exp__Frm--cst">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele"> 
        <div class="experience-categories-form"> 
    <?php $form = ActiveForm::begin(); ?>  
    <!-- profile upload Section-->
    <div class="exp__Prfile">
        <div class="row">
            <div class="col-sm-12">
                <div class="exp__Prfile--img">
                    <div class="exp__Prfile--edit"> 
                    <?= $form->field($model, 'temp_image')->fileInput(['id'=>'imageUpload'])->label(false) ?>                        
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
            <div class="col-sm-12 col-lg-4">
            <?= $form->field($model, 'first_name')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter First Name']) ?> 
            </div>
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'last_name')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Last Name']) ?>
            </div>
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'username')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter user name']) ?>
            </div>            
        </div>
       <!--End row block --> 

       <!-- row block -->
       <div class="row"> 
            <div class="col-sm-12 col-lg-4">
            <?= $form->field($model, 'email')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Email']) ?> 
            </div>
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'phone_home')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Phone Home']) ?>
            </div>
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'phone_office')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Phone Office']) ?>
            </div>            
        </div>
       <!--End row block --> 

       <!-- row block -->
       <div class="row"> 
            <div class="col-sm-12 col-lg-4">
            <?= $form->field($model, 'city')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter City']) ?> 
            </div>
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'state')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter State']) ?>
            </div>
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'country')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Country']) ?>
            </div> 
            <div class="col-sm-12 col-lg-4">
                <?= $form->field($model, 'zip')->textInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Zip']) ?>
            </div>            
        </div>
       <!--End row block --> 
         
        <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="exp__Frm--btn"> 
                        <?= Html::submitButton('Update Profile Info', ['class' => 'btn btn_primary cst_btn mr-10']) ?>
                        <a href="<?= Url::to(['/dashboard']); ?>" class="btn btn-secondary cst_btn">Cancel</a>
                    </div>
            </div>
        </div>
       <!--End row block --> 
    <?php ActiveForm::end(); ?>
</div>


         
    </div>
    <!-- Edit add_new_client section -->
</section>
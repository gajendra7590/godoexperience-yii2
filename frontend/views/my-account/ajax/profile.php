<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;

//echo '<pre>';print_r($pageData);
?>
<!-- My Account Profile-->
<div class="my-ac-title">
    <h3>Profile</h3>
</div>
<section class="my-ac-profile">
    <!--Yii form start  -->
    <?php $form = ActiveForm::begin([
        'id'=>'profile_form',
        'action' => Url::to(['/my-account/profile-validation']),
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'options' => ['enctype' => 'multipart/form-data','submit-url' => Url::to(['/my-account/profile'])]
    ]); ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="myac-profile-img">
                    <div class="myac-pro-user">
                        <div class="field-imageUpload">
                            <?= $form->field($pageData, 'temp_image')->fileInput(['id'=>'imageUpload'])->label(false) ?>
                        </div>
                        <div id="imagePreview" style='background-image: url(<?= ($pageData->profile_photo!='')?(Utils::IMG_URL($pageData->profile_photo)):'../godoexperience-php/asset/images/background/upload_img.png';?>);'>
                        </div>
                    </div>
                    <div class="myac-profile-btn">
                        <label for="imageUpload" class="btn btn_Primary">Choose Image</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <?= $form->field($pageData, 'first_name',[
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form_group col-sm-6'
                    ],
                    'template'=>'<label for="email" class="label_Mod">First Name <sub>*</sub> </label>{input}{error}{hint}',
                ])->textInput(['placeholder'=>'First Name','class' => 'input_modify','autocomplete'=>'off']) ?>

                <?= $form->field($pageData, 'last_name',[
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form_group col-sm-6'
                    ],
                    'template'=>'<label for="email" class="label_Mod">Last Name <sub>*</sub> </label>{input}{error}{hint}',
                ])->textInput(['placeholder'=>'Last Name','class' => 'input_modify','autocomplete'=>'off']) ?>
        </div>
        <div class="row">
            <?= $form->field($pageData, 'email',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="email" class="label_Mod">Email Address <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Email Address','class' => 'input_modify','autocomplete'=>'off']) ?>

            <?= $form->field($pageData, 'phone_home',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="phone_home" class="label_Mod">Phone <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Phone','class' => 'input_modify','autocomplete'=>'off']) ?>

        </div>
        <div class="row">
            <?= $form->field($pageData, 'gender',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="phone_home" class="label_Mod">DOB <sub>*</sub> </label>{input}{error}{hint}',
            ])->dropDownList([
                'male' => 'Male',
                'female' => 'Female',
            ],['class'=>'form-control input_modify select_Mod']) ?>

            <?= $form->field($pageData, 'dob',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="phone_home" class="label_Mod">DOB <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Date Of Birth','class' => 'input_modify','autocomplete'=>'off']) ?>

        </div>
        <div class="row">
            <?= $form->field($pageData, 'city',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="email" class="label_Mod">City <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'City','class' => 'input_modify','autocomplete'=>'off']) ?>

            <?= $form->field($pageData, 'state',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="phone_home" class="label_Mod">State <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'State','class' => 'input_modify','autocomplete'=>'off']) ?>

        </div>
        <div class="row">
            <?= $form->field($pageData, 'country',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="country" class="label_Mod">Country <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Country','class' => 'input_modify','autocomplete'=>'off']) ?>

            <?= $form->field($pageData, 'zip',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'form_group col-sm-6'
                ],
                'template'=>'<label for="zip" class="label_Mod">Zip Code <sub>*</sub> </label>{input}{error}{hint}',
            ])->textInput(['placeholder'=>'Zip','class' => 'input_modify','autocomplete'=>'off']) ?>

        </div>
        <div class="my-ac-btn">
            <button type="submit" class="btn_Primary loader-btn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Update Profile">
                Update Profile</button>
        </div>

    <?php ActiveForm::end(); ?>
    <!--Yii form end  -->
</section>
<!-- // My Account Profile-->
<script>
    /*upload images client file*/
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                jQuery('#imagePreview').css('background-image', 'url('+e.target.result +')');
                jQuery('#imagePreview').hide();
                jQuery('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });

//    $('.loader-btn').on('click', function() {
//        var $this = $(this);
//        $this.button('loading');
//        setTimeout(function() {
//            $this.button('reset');
//        }, 8000);
//    });

</script>

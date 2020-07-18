<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;
use dosamigos\ckeditor\CKEditor;
use yii\jui\DatePicker;

$btn_title = (isset($model->id) && ($model->id > 0)) ? 'Update' : 'Create';
$img_url = ($model->experiences_image_url != '') ? (Utils::IMG_URL($model->experiences_image_url)) : Url::to('@web/asset/images/icons/upload_img.png');
$form_action = ($model && isset($model->id)) ? Yii::$app->request->url : Url::to(['/experiences/create']);
$valdiation = ($model && isset($model->id)) ? Url::to(['/experiences/ajax-validation', 'id' => $model->id]) : Url::to(['/experiences/ajax-validation']);;
?>

<div class="experience-categories-form">
    <?php $form = ActiveForm::begin([
        'id' => 'experiences_form',
        'action' => $valdiation,
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'options' => ['enctype' => 'multipart/form-data', 'submit-url' => $form_action, 'redirect-url' => Url::to(['/experiences'])]
    ]); ?>
    <!-- profile upload Section-->
    <div class="exp__Prfile">
        <div class="row">
            <div class="col-sm-12">
                <?php if (isset($model->id)) { ?>
                    <div class="manage_avaliablity-btn">
                        <a href="<?php echo Url::to(['/experiences/manage-availability?id=' . $model->id]); ?>"
                           class="btn btn-sm add_new_btn">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Manage Avaliablity
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-12">
                <div class="exp__Prfile-Content">
                    <div class="exp__Prfile--img">
                        <div class="exp__Prfile--edit">
                            <?= $form->field($model, 'image')->fileInput(['id' => 'imageUpload'])->label(false) ?>
                        </div>
                        <div class="exp__Prfile--preview">
                            <div id="imagePreview" style='background-image: url(<?php echo $img_url; ?>);'>
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
    </div>
    <!--End of profile upload Section-->
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'title')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Enter experience name']) ?>
        </div>
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'category_id')->dropDownList($categories, ['class' => 'form-control input_modifier select_mod']) ?>
        </div>
    </div>
    <!--End row block -->
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'price')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Enter experience price']) ?>
        </div>
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'status')->dropDownList([
                1 => 'Active',
                0 => 'Inactive'
            ], ['class' => 'form-control input_modifier select_mod']) ?>
        </div>
    </div>
    <!-- row block -->
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <?= $form->field($model, 'sub_title')->textArea(['rows' => '3', 'class' => 'form-control input_modifier', 'placeholder' => 'Enter experience sub title']) ?>
        </div>
    </div>
    <!-- row block -->
    <!-- row block -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => [
                    'rows' => 15,
                ],
                'preset' => 'custom',
                'clientOptions' => [
                    ['height' => 200],
                    'toolbarGroups' => [
                        ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
                        ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
                        ['name' => 'editing', 'groups' => ['find', 'selection', 'spellchecker']],
                        '/',
                        ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                        ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
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
    <!-- row block -->
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'duration')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Experience Duraion']) ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'duration_type')->dropDownList([
                'day' => 'Day',
                'hours' => 'Hours',
                'minutes' => 'Minutes',
            ], ['class' => 'form-control input_modifier select_mod']) ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'group_size')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Experience Group Size']) ?>
        </div>
    </div>
    <!-- row end -->
    <!-- row block -->
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'activity_level')->dropDownList([
                'light' => 'Light',
                'moderate' => 'Moderate',
                'strenuous' => 'Strenuous',
                'extreme' => 'Extreme'
            ], ['class' => 'form-control input_modifier select_mod']) ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'country')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Country']) ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'state')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'State']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'city')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'City']) ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'latitude')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Latitude']) ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
            <?= $form->field($model, 'longitude')->textInput(['class' => 'form-control input_modifier', 'placeholder' => 'Longitude']) ?>
        </div>
    </div>
    <!-- row end -->
    <!-- This Row is for Addons -->
    <div class="row">
        <div class="col-sm-12">
            <div id="addons">
                <h3> Experience Adons </h3>
                <a href="javascript:void(0);" id="AdonMoreBtn"
                   data-url="<?php echo Url::to(['/experiences/get-addons']); ?>" class="btn cst_btn btn-secondary">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                </a>
                <div id="add_on_container">
                    <?php echo isset($addOnsHtml) ? $addOnsHtml : ''; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- This Row is for Addons -->
    <!-- This Row is for Addons -->
    <div class="row">
        <div class="col-sm-12">
            <div id="addons" class="media_container">
                <div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Set Slider Images</h3>
                            <div class="upload_wrapper">
                                <input type="file" name="slide_img" id="slide_img"
                                       data-exp_id="<?= isset($model->id) ? $model->id : 0; ?>"
                                       data-url="<?php echo Url::to(['experiences/upload-media/']); ?>">
                                <input type="hidden" name="remove_action" id="remove_action"
                                       data-url="<?php echo Url::to(['experiences/delete-media/']); ?>">
                                <label for="slide_img" class="btn btn_primary--outline cst_btn mr-10">
                                    <i class="fa fa-upload" aria-hidden="true"></i> Upload
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="col-sm-12">
                            <div class="image_upload_section add_on_container">
                                <?php echo isset($mediaHtml) ? $mediaHtml : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- This Row is for Addons -->
        <!-- row block -->
        <?php if (Yii::$app->user->identity->role_id == 1) { ?>
            <div class="col-sm-12 col-lg-6">
                <?= $form->field($model, 'featured', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form_group has-feedback'
                    ],
                    'template' => '<div class="custom_checkboxGreen">
                                        <div class="checkbox_block">
                                            <span class="checkbox_lable"></span>{input} Mark as featured <span class="checkmark"></span>
                                        </div>
                                    </div>',
                ])->checkbox()->label(false)->checkbox([], false); ?>
            </div>
        <?php } ?>
        <!-- row block -->
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="exp__Frm--btn">
                    <?= Html::submitButton($btn_title, ['class' => 'btn btn_primary cst_btn mr-10']) ?>
                    <a href="<?= Url::to(['/experiences']); ?>" class="btn btn-secondary cst_btn">Cancel</a>
                </div>
            </div>
        </div>
        <!--End row block -->
        <?php ActiveForm::end(); ?>
    </div>
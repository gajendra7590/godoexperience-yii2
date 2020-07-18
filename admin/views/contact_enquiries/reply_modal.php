<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;
use dosamigos\ckeditor\CKEditor;
?>
<div class="body_container">
    <div class="admin_message_info_section">
        <div class="overlay_admin">
            <div class="overlay__inner_admin">
                <div class="overlay__content_admin">
                    <div class="spinner_admin">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <p class="spinner_admin_text">Processing...</p>
                </div>
            </div>
        </div>
        <div class="contact_reply_form_section">
            <?php $form = ActiveForm::begin([
                'id'=>'contact_us_reply_form',
                'action' =>  Url::to(['/contact-enquiries/reply-ajax-validation?id='.$model->id]),
                'enableClientValidation' => false,
                'enableAjaxValidation' => true,
                'options' => [
                    'enctype' => 'multipart/form-data',
                    'submit-url' => Url::to(['/contact-enquiries/reply?id='.$model->id]),
                    'redirect-url' => Url::to(['/contact-enquiries'])
                ]
            ]); ?>
            <div id="row">
                <div class="col-sm-12 col-lg-12">
                    <?= $form->field($model, 'reply_subject')->textArea(
                            ['rows' => '3','class'=>'form-control input_modifier','placeholder'=>'Write subject']
                    )->label('Subject') ?>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <?= $form->field($model, 'reply_body')->widget(CKEditor::className(), [
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
                    ])->label('Message') ?>
                </div>
            </div>
            <!-- row block -->
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="exp__Frm--btn">
                        <button type="button" class="btn btn-secondary cst_btn" data-dismiss="modal">Close</button>
                        <?= Html::submitButton('Send Email', ['class' => 'btn btn_primary cst_btn mr-10']) ?>
                    </div>
                </div>
            </div>
            <!--End row block -->
            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
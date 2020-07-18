<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\Utils;
?>
<div class="body_container">

<div class="client_message_info_section">

        <!--client msg col-->
        <div class="client-msg-col">
            <span class="client-msg-title">Contact Name </span>
            <span class="client-msg-sub"><?= isset($model['contact_name'])?$model['contact_name']:'';?></span>
        </div>
        <!-- // client msg col-->
        <!--client msg col-->
        <div class="client-msg-col">
            <span class="client-msg-title">Contact email</span>
            <span class="client-msg-sub"><?= isset($model['contact_email'])?$model['contact_email']:'';?></span>
        </div>
        <!--// client msg col-->
        <!--client msg col-->
        <div class="client-msg-col">
            <span class="client-msg-title">Contact phone</span>
            <span class="client-msg-sub"><?= isset($model['contact_phone'])?$model['contact_phone']:'';?></span>
        </div>
        <!--// client msg col-->

      <!-- Client details Msg -->
        <div class="client_details-msg">
          <!-- client msg title -->
            <div class="client_message-title">
                <h3>Contact body</h3>
            </div>
        <!-- // client msg title -->
            <div class="client-msg-col">
                <span class="client-msg-sub">
                    <p id="contact_message">
                        <?= isset($model['contact_message'])?$model['contact_message']:'';?>
                    </p>
                </span>
            </div>
            <!-- // client msg col-->
        </div>
        <!-- // Client details Msg -->
 
        <!-- admin message info section -->
        <div class="admin_message_info_section">
        <!-- client msg title -->
            <div class="client_message-title">
                <h3>Reply body</h3>
            </div>
        <!-- // client msg title -->
        <!-- contact  msg client -->
            <div class="contact-msg-client">
                <span>
                    <p class="client-details-name">Hi, <?= isset($model['contact_name'])?$model['contact_name']:'';?></p>
                    <p id="contact_message"><?= isset($model['reply_body'])?$model['reply_body']:'';?></p>
                    <p>If you have any another query contact <a class="contact-link-client" href="<?php echo Url::to(['/contact-us']);?>">our support team</a>
                        or email us at  <a class="contact-link-client" href="mailto:<?php echo Yii::$app->params['supportEmail'];?>">
                      <?php echo Yii::$app->params['supportEmail'];?></a>.
                    </p>
                    <p>
                        <strong>Regards</strong>,<br/>
                        Go Do Experience
                    </p>
                </span>
            </div>
            <!-- // contact  msg client -->
        </div>
        <!-- // admin message info section -->
    </div>
    <!-- // admin message info section -->


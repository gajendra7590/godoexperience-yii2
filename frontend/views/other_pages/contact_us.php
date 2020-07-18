<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
use yii\widgets\ActiveForm;

$this->title = 'Contact US';

?>

<main class="inner-Page">
    <section class="inner-Page-content">
        <div class="cst-breadcrumbs">
        <h1>contact us</h1>
            <ul>
                <li><a href="<?= Url::to(['/']);?>">home</a></li>
                <li><span>/</span></li>
                <li><a href="javascript:void(0)">Contact us</a></li>
            </ul>
        </div>
        <div class="container">
            <!-- Contact Page-->
            <div class="contact-page">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="contact-title">
                            <h3>get in touch</h3>
                            <p></p>
                        </div>
                        <!--Contct getin touch-->
                        <div class="contct-getin-touch">
                            <!-- Contct getin touch Item-->
                            <div class="contct-get-item">
                                <div class="contct-get-item-icn">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="contct-get-item-info">
                                    <a data-toggle="tooltip" title="Make a call us" href="tel:<?= isset($company_info['company_phone'])?($company_info['company_phone']):''; ?>">
                                       <?= isset($company_info['company_phone'])?($company_info['company_phone']):''; ?>
                                    </a>
                                </div>
                            </div>
                            <!-- // Contct getin touch Item-->
                            <!-- Contct getin touch Item-->
                            <div class="contct-get-item">
                                <div class="contct-get-item-icn">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </div>
                                <div class="contct-get-item-info">
                                    <a data-toggle="tooltip" title="Email Us" href="mailto:<?= isset($company_info['company_email'])?($company_info['company_email']):''; ?>">
                                        <?= isset($company_info['company_email'])?($company_info['company_email']):''; ?>
                                    </a>
                                </div>
                            </div>
                            <!-- // Contct getin touch Item-->
                            <!-- Contct getin touch Item-->
                            <div class="contct-get-item">
                                <div class="contct-get-item-icn">
                                    <i class="fa fa-map-o" aria-hidden="true"></i>
                                </div>
                                <div class="contct-get-item-info">
                                    <?= isset($company_info['company_full_address'])?($company_info['company_full_address']):''; ?>
                                </div>
                            </div>
                            <!-- // Contct getin touch Item-->
                            <div class="contct-getin-social">
                                <ul>
                                    <li>
                                        <a href="<?= isset($company_info['company_facebook'])?($company_info['company_facebook']):'javascript:void(0)'; ?>">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= isset($company_info['company_instagram'])?($company_info['company_instagram']):'javascript:void(0)'; ?>">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= isset($company_info['company_twiiter'])?($company_info['company_twiiter']):'javascript:void(0)'; ?>">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= isset($company_info['company_pinterest'])?($company_info['company_pinterest']):'javascript:void(0)'; ?>">
                                            <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- // Contct getin touch-->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <!--<div class="contact-title">
                            <h3>send us a message</h3>
                        </div>-->
                        <div class="contact-msg">
                            <div class="experience-categories-form">
                                <?php $form = ActiveForm::begin([
                                    'id'=>'experiences_form',
                                    'action' => Url::to(['/contact-us'])
                                ]); ?>

                                    <?= $form->field($model, 'contact_name',[
                                        "template" => "<label class=\"label_Mod\">Your Name<sub>*</sub></label>\n{input}\n{hint}\n{error}"
                                    ])->textInput(
                                        ['class'=>'form-control input_Mod','placeholder'=>'Enter your name..']
                                    ) ?>

                                    <?= $form->field($model, 'contact_email',[
                                        "template" => "<label class=\"label_Mod\">Email<sub>*</sub></label>\n{input}\n{hint}\n{error}"
                                    ])->textInput(
                                        ['class'=>'form-control input_Mod','placeholder'=>'Enter your name..']
                                    ) ?>

                                    <?= $form->field($model, 'contact_phone',[
                                        "template" => "<label class=\"label_Mod\">Phone<sub>*</sub></label>\n{input}\n{hint}\n{error}"
                                    ])->textInput(
                                        ['class'=>'form-control input_Mod','placeholder'=>'Enter your name..']
                                    ) ?>
                                    <?= $form->field($model, 'contact_message',[
                                        "template" => "<label class=\"label_Mod\">Message<sub>*</sub></label>\n{input}\n{hint}\n{error}"
                                    ])->textarea(
                                        ['cols' => '32','rows' => '6','class'=>'form-control input_Mod','placeholder'=>'Write your note.']
                                    ) ?>

                                    <div class="contact-msg-btn">
                                        <button type="submit" class="btn_Primary">Submit</button>
                                    </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Contact Page-->
        </div>
    </section>
</main>

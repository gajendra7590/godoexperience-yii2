<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;
$this->title = 'Booking - My Order';

?>
<section class="thank_visit">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="thank_visit-content">
                    <?php $form = ActiveForm::begin([
                            'id'=>'orderGuestsForm',
                            'action' => Url::to(['/order/guest-save','id'=>$order['id']]),
                            'options' => ['enctype' => 'multipart/form-data','data-base_url'=>Url::to(['/'])]
                        ]); ?>
                        <div class="thank_visit-title">
                            <h1>Thank You For Booking </h1>
                            <p>
                                This is a very simple thank you page that Constant Contact displays after you download their guide Grow Your List by Adding Email to Your Social
                                Media Strategy.What I like here is the simplicity and minimalism. Anything that could be a distraction has been removed from the page to make the
                                message clearer.The page does a good job when it comes to the core purpose that every thank you page should have – letting the subscriber know how
                                they can access the resource they have opted for.In this case, the guide has been sent to the email of the subscriber.
                            </p>
                            <?php if(isset($order['guests']) && count($order['guests'])){ ?>
                               <div class="book_jst">
                                    <h4>Book just for you and your group</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of
                                        a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                        as opposed to using 'Content here, content here',
                                        making it look like readable English</p>
<!--                                    <div class="custom_checkboxGreen">-->
<!--                                        <div class="checkbox_block">-->
<!--                                            <span class="checkbox_lable"> Book this entire experience for a private group </span>-->
<!--                                            <input type="checkbox" name="is_booked_for_private_group">-->
<!--                                            <span class="checkmark"></span>-->
<!--                                        </div>-->
<!--                                    </div>-->
                               </div>
                               <div class="whos_Coming">
                                <h3>who's coming?</h3>
                                <div class="Gest-details-thank">
                                    <div class="Gest-details-item">
                                        <h5>Guest details</h5>
                                        <p>The info entered will be used to add people to this reservation.</p>
                                        <p>Keep your guests in the loop. Add their email and we'll send them the itinerary.</p>
                                    </div>

                                    <div class="Gest-details-frm">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label class="label_modifier">Your phone number <span class="text-danger">*</span></label>
                                                <input type="text" name="phone_number" value="<?= $order['phone_number'];?>" class="form-control input_modifier phone_number_input" placeholder="Please enter phone">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="order_id" value="<?= $order['id'];?>">
                                    <?php if(isset($order['guests']) && count($order['guests'])){
                                        foreach ($order['guests'] as $k => $guest){ ?>

                                                <div class="Gest-details-item">
                                                    <h5>Guest <?= $k+1;?></h5>
                                                    <div class="Gest-details-frm">
                                                        <div class="row">
                                                            <input name="guest[<?= $k;?>][id]" type="hidden" value="<?= $guest['id'];?>">
                                                            <div class="form-group col-sm-6">
                                                                <label class="label_modifier">First name <span class="text-danger">*</span></label>
                                                                <input name="guest[<?= $k;?>][first_name]" type="text" value="<?= $guest['first_name'];?>" class="form-control input_modifier first_name_input" placeholder="Please first name..">
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label class="label_modifier">Last name <span class="text-danger">*</span></label>
                                                                <input name="guest[<?= $k;?>][last_name]" type="text" value="<?= $guest['last_name'];?>" class="form-control input_modifier last_name_input" placeholder="Please last name..">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label class="label_modifier">Email <span class="text-danger">*</span></label>
                                                                <input name="guest[<?= $k;?>][email]" type="text" value="<?= $guest['email'];?>" class="form-control input_modifier email_input" placeholder="Please enter email..">
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label class="label_modifier">Gender <span class="text-danger">*</span></label>
                                                                <select name="guest[<?= $k;?>][gender]" class="form-control input_modifier select_Mod gender_input">
                                                                    <option value="male" <?= ($guest['gender'] == 'male')?'selected="selected"':'';?>>Male</option>
                                                                    <option value="female" <?= ($guest['gender'] == 'female')?'selected="selected"':'';?>>Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php } } ?>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                        <?php if(isset($order['guests']) && count($order['guests'])){ ?>
                            <div class="btn-guest-thank">
                                <button type="submit" id="guestDetailFormBtn" class="btn_Primary">Save Guest Detail</button>
                            </div>
                        <?php } ?>
                     <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="Gest-pay">
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <div class="Gest-pay-product">
                            <div class="Gest-pay-title">
                                <h5><?= isset($order['experience']['title'])?($order['experience']['title']):'';?></h5>
                                <p><?= isset($order['experience']['duration'])?($order['experience']['duration'].' '.$order['experience']['duration_type']):'';?> experience</p>
                                <p>Hosted by <?= isset($order['experience']['user']['hosted_by'])?($order['experience']['user']['hosted_by']):'NA';?></p>
                            </div>
                            <div class="Gest-pay-img">
                                <img src="<?= Utils::IMG_URL($order['experience']['experiences_image_url']);?>" alt="product" />
                            </div>
                        </div>
                    </div>
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <div class="Gest-pay-cale">
                            <p><?= date('F, m Y',strtotime($order['experience_start_date']));?> ( booking date )</p>
<!--                            <p>10:00 AM – 2:30 PM</p>-->
                        </div>
                    </div>
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <div class="Gest-pay-desc">
                            <p><?= isset($order['experience']['description'])?(strip_tags(substr($order['experience']['description'],0,300)).'...'):'';?>.</p>
                        </div>
                    </div>
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <?php if( isset($order['total_guest_adults']) && ($order['total_guest_adults'] > 0)){?>
                            <div class="Gest-pay-amount">
                                <div class="Gest-gest-amount"><p><?= Utils::cc().number_format($order['experience_price'],2,'.',",").' x '.$order['total_guest_adults'];?> guests(adults)</p></div>
                                <div class="gest-amunt-sub"><p><?= Utils::cc().number_format( ($order['adults_tp']),2,".",",");  ?> </p></div>
                            </div>
                        <?php } ?>
                        <?php if( isset($order['total_guest_children']) && ($order['total_guest_children'] > 0)){?>
                            <div class="Gest-pay-amount">
                                <div class="Gest-gest-amount"><p><?= Utils::cc().number_format($order['experience_price'],2,'.',",").' x '.$order['total_guest_children'];?> guests(childrens)</p></div>
                                <div class="gest-amunt-sub"><p><?= Utils::cc().number_format( ($order['children_tp']),2,".",",");  ?> </p></div>
                            </div>
                        <?php } ?>
                        <?php if( isset($order['total_guest_infants']) && ($order['total_guest_infants'] > 0)){?>
                            <div class="Gest-pay-amount">
                                <div class="Gest-gest-amount"><p><?= Utils::cc().number_format($order['experience_price'],2,'.',",").' x '.$order['total_guest_infants'];?> guests(infants under 2 years)</p></div>
                                <div class="gest-amunt-sub"><p><?= Utils::cc().number_format( ($order['infants_tp']),2,".",",");  ?> </p></div>
                            </div>
                        <?php } ?>
                        <?php if( isset($order['experience_adons_price']) && ($order['experience_adons_price'] > 0)){?>
                            <div class="Gest-pay-amount">
                                <div class="Gest-gest-amount Gest-gest-amount-extra"><p>Extras Adons</p></div>
                                <?php foreach (($order['experience_adons_detail']) as $ad){ ?>
                                <div class="Gest-pay-amount">
                                  <div class="Gest-gest-amount"><p><?= '( '.Utils::cc().$ad['price'].' x '.$order['guest_t'].' ) '.$ad['name'];?></p></div>
                                  <div class="gest-amunt-sub"><p><?= Utils::cc().number_format( ($ad['price'] * $order['guest_t']),2,".",",");  ?> </p></div>
                               <div/>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <div class="Gest-total-pay">
                            <div class="Gest-total-title">
                                <p>Total <span>(USD)</span></p>
                            </div>
                            <div class="Gest-total-amount">
                                <p><?= Utils::cc().number_format($order['net_pay'],2,'.',','); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <div class="cancel-policy">
                            <a href="#" class="cst-link">Cancellation policy</a>
                            <p>Get a full refund if you cancel within 24 hours of purchase.</p>
                        </div>
                    </div>
                    <!-- Guest Pay Item-->
                    <div class="Gest-pay-item">
                        <div class="guest-require">
                            <h5>Review guest requirements</h5>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

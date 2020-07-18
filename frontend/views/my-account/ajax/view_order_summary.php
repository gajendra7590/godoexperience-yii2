<?php
//echo '<pre>';print_r($orderDetail);
use common\helpers\Utils;
?>
<main class="order-Summary">
    <h1>order summary</h1>
    <!-- Order Details-->
    <section class="order_Details">
        <div class="container">
            <div class="order_ele">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="order_ele-wrap">
                            <h2 class="order-ele-heading">Order <span>#<?= isset($orderDetail['id'])?$orderDetail['id']:0;?></span></h2>
                            <div class="order-pay-btn">
                                <a href="<?= $orderDetail['payment']['payment_receipt_url'];?>" title="Download Payment Reciept" class="btn btn_Primary" target="_blank">
                                    <i class="fa fa-download" aria-hidden="true"></i>Payment Reciept
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <!--Order Details Contetn-->
                        <div class="order_details-content">
                            <h3 class="order-gest-heading">Guest Are coming</h3>
                            <div class="table-responsive order-Tbl-cst">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Id</th>
                                        <th>Gender</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($orderDetail['guests']) && count($orderDetail['guests'])){
                                        foreach ($orderDetail['guests'] as $k =>  $gst){ ?>
                                            <tr>
                                                <td><?= $k+1;?></td>
                                                <td><?= ($gst['first_name'])?$gst['first_name']:'NA';?></td>
                                                <td><?= ($gst['last_name'])?$gst['last_name']:'NA';?></td>
                                                <td><?= ($gst['email'])?$gst['email']:'NA';?></td>
                                                <td><?= ($gst['gender'])?$gst['gender']:'NA';?></td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="order_exp-details">
                            <h3 class="order-gest-heading">experience</h3>
                            <div class="order_exp-item">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="order-exp">
                                            <img src="<?= isset($orderDetail['experience']['experiences_image_url'])?(Utils::IMG_URL($orderDetail['experience']['experiences_image_url'])):'';?>" class="media-object">
                                        </div>
                                    </div>
                                    <div class="media-body order-exp-body">
                                        <h4 class="media-heading"><?= isset($orderDetail['experience']['title'])?($orderDetail['experience']['title']):'';?></h4>
                                        <p><?= isset($orderDetail['experience']['sub_title'])?($orderDetail['experience']['sub_title']):'';?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order_booking-content">
                            <div class="order_booking-details">
                                <h3 class="order-gest-heading">Event Summary</h3>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="order_booking-item">
                                            <h5><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                Start date
                                            </h5>
                                            <p><?= isset($orderDetail['experience_start_date'])?( date('D d,M Y',strtotime($orderDetail['experience_start_date']))):'NA'; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="order_booking-item">
                                            <h5><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                End date</h5>
                                            <p><?= isset($orderDetail['experience_end_date'])?(date('D d,M Y',strtotime($orderDetail['experience_end_date']))):'NA'; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="order_booking-item">
                                            <h5><i class="fa fa-users" aria-hidden="true"></i>
                                                Total Guest</h5>
                                            <p><?= ($orderDetail['total_guest_adults'] + $orderDetail['total_guest_children'] + $orderDetail['total_guest_infants']); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="order_booking-item">
                                            <h5><i class="fa fa-calculator" aria-hidden="true"></i>
                                                Total Duration</h5>
                                            <p><?= ($orderDetail['schedule_detail']['duration'] .' '. ucfirst($orderDetail['schedule_detail']['duration_type'])); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //Order Details Contetn-->
                        <div class="order-pay-summry">
                            <div class="order_details-content">
                                <h3 class="order-gest-heading">Payment Summary</h3>
                                <div class="table-responsive order-Tbl-cst">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Guests</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><span><?= Utils::cc().$orderDetail['experience_price'].' x '.$orderDetail['total_guest_adults'].' Guest( Adults )'?></span></td>
                                            <td><?= Utils::cc().$orderDetail['adults_tp'];?></td>
                                        </tr>
                                        <?php if($orderDetail['total_guest_children'] > 0){?>
                                        <tr>
                                            <td><span><?= Utils::cc().$orderDetail['experience_price'].' x '.$orderDetail['total_guest_children'].' Guest( Children )'?></span></td>
                                            <td><?= Utils::cc().$orderDetail['children_tp'];?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php if($orderDetail['total_guest_infants'] > 0){?>
                                        <tr>
                                            <td><span><?= Utils::cc().$orderDetail['experience_price'].' x '.$orderDetail['total_guest_infants'].' Guest( Under 2 year )'?></span></td>
                                            <td><?= Utils::cc().$orderDetail['infants_tp'];?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><strong>Sub Total</strong></td>
                                            <td><?= Utils::cc().($orderDetail['adults_tp']+$orderDetail['children_tp']+$orderDetail['infants_tp']); ?></td>
                                        </tr>
                                        <?php if( isset($orderDetail['experience_adons_detail']) && count($orderDetail['experience_adons_detail']) > 0){ ?>
                                            <tr>
                                                <td><strong>Extra Adons</strong></td>
                                                <td></td>
                                            </tr>
                                            <?php  $total_adon = 0;
                                            foreach ($orderDetail['experience_adons_detail'] as $k => $ad){
                                                $total_adon+= ( intval($ad['price']) * $orderDetail['guest_t']);
                                                ?>
                                                <tr>
                                                    <td><span class="extra-adons-td"><?= Utils::cc().'  '.$ad['price'].' x '.$orderDetail['guest_t'].' ( '.$ad['name'].' )'?></span></td>
                                                    <td><?= Utils::cc().( $ad['price'] * $orderDetail['guest_t']);?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><strong>Sub Total</strong></td>
                                                <td><?= Utils::cc().( $total_adon ); ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <td><strong>Total( USD )</strong></td>
                                            <td><strong><?= Utils::cc().$orderDetail['net_pay'];?></strong></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="order-payment">
                            <h3 class="order-gest-heading">Payment Card Info</h3>
                        </div>
                        <div class="order-pay-content">
                            <div class="order-pay-item">
                                <h5>Id</h5>
                                <p>#<?= isset($orderDetail['payment']['payment_success_id'])?$orderDetail['payment']['payment_success_id']:'';?></p>
                            </div>
                            <div class="order-pay-item">
                                <h5>Payment Receipt Email</h5>
                                <p><?= isset($orderDetail['payment']['payment_receipt_email'])?$orderDetail['payment']['payment_receipt_email']:'';?></p>
                            </div>
                            <div class="order-pay-item">
                                <h5>Card Brand</h5>
                                <p><?= isset($orderDetail['payment']['payment_brand'])?$orderDetail['payment']['payment_brand']:'';?></p>
                            </div>
                            <div class="order-pay-item">
                                <h5>Card Exp Month</h5>
                                <p><?= isset($orderDetail['payment']['payment_exp_month'])?$orderDetail['payment']['payment_exp_month']:'';?></p>
                            </div>
                            <div class="order-pay-item">
                                <h5>Card Exp Year</h5>
                                <p><?= isset($orderDetail['payment']['payment_exp_year'])?$orderDetail['payment']['payment_exp_year']:'';?></p>
                            </div>
                            <div class="order-pay-item">
                                <h5>Card Last 4</h5>
                                <p><?= isset($orderDetail['payment']['payment_last4'])?$orderDetail['payment']['payment_last4']:'';?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
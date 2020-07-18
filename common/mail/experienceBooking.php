<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
$baseUrl = Yii::$app->urlManager->createAbsoluteUrl(['/']);
?>

<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-top: 21px; margin-bottom: 20px;">
<tr>
<td>
    <div class="mb_View" style="background-color: #f4f4f4 !important; max-width:600px; margin: 0 auto;">
        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#000">
                        <tr>
                            <td class="logo_block" bgcolor="" style="padding-top:25px; padding-bottom:25px; text-align: center;">
                                <a href="<?php echo $baseUrl;?>" target="_blank" target="_blank">
                                    <img src="<?= \Yii::$app->params['logo_icon'];?>" width="210px" class="logo_img" alt="Logo">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
                        <tr>
                            <td style="padding-left:20px; padding-right:20px; padding-top:30px; padding-bottom:5px; border-radius: 5px 5px 0 0;" bgcolor="#FFFFFF">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody>
                                                <tr>
                                                    <td class="head-title" style="font-family: 'Montserrat', sans-serif !important; font-size:20px; padding-bottom:20px; color:#484848; line-height:30px; font-weight:600; text-align:center;">
                                                        Thank you for your order
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top:1px; padding-bottom:7px; font-family: 'Montserrat', sans-serif !important; color:#484848; font-size:15px; line-height:24px; font-weight: 600">
                                                        Hi <?= $orderDetail['user']['first_name'].' '.$orderDetail['user']['last_name'];?>!
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Montserrat', sans-serif !important; font-size:15px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 500;" class="para1">
                                                        Just to let you know -- we've received your order #<?= $orderDetail['id'];?>, and it is now beign processed:
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="padding-left:20px; padding-right:20px;">
                        <tbody>
                        <tr>
                            <td style="font-family: 'Montserrat', sans-serif !important; font-size:18px; padding-top:10px;  color:#FF5A5F; line-height:24px; padding-bottom:15px;font-weight: 600" class="para1">
                                [Order #<?= $orderDetail['id'];?>] (<?= date('M ,d Y',strtotime($orderDetail['created_at']));?>)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="order-list" width="90%" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                    <tr>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600; width: 270px" class="para1">Product</th>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600;width: 270px" class="para1">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center; padding-bottom: 8px;">
                                            <span>Experience Price</span><small>( &#215; <?= $orderDetail['guest_t']; ?> )</small>
                                        </td>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                            <?= Utils::cc().( $orderDetail['experience_price'] * $orderDetail['guest_t'] );?>
                                        </td>
                                    </tr>
                                    <?php foreach ($orderDetail['experience_adons_detail'] as $adon){ ?>
                                        <tr>
                                            <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                                <span>Addon</span><small>( <?php echo $adon['name'];?> &#215; <?= $orderDetail['guest_t']; ?> )</small>
                                            </td>
                                            <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                                <?= Utils::cc().( $adon['price'] * $orderDetail['guest_t'] ) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600; width: 270px" class="para1">
                                            Subtotal:
                                        </th>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                            <?= Utils::cc().( $orderDetail['net_pay'] ) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600; width: 270px" class="para1">
                                            Payment Method:
                                        </th>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                            <?= ucfirst($orderDetail['payment']['payment_brand']); ?> Card (Stripe)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600; width: 270px" class="para1">
                                            Total:
                                        </th>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                            <?= Utils::cc().( $orderDetail['net_pay'] ) ?>
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="padding-left:20px; padding-right:20px;">
                        <tbody>
                        <tr>
                            <td style="font-family: 'Montserrat', sans-serif !important; font-size:18px; padding-top:15px;  color:#FF5A5F; line-height:24px; padding-bottom:15px;font-weight: 600" class="para1">
                                Guest Details
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="order-list" width="90%" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                    <tr>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600;" class="para1">
                                            No of Guest
                                        </th>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600" class="para1">
                                            Booking Start Date
                                        </th>
                                        <th style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:5px;font-weight: 600;" class="para1">
                                            Booking End Date
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center; padding-bottom: 8px;">
                                            <?= $orderDetail['guest_t']; ?>
                                        </td>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                            <?= $orderDetail['experience_start_date']; ?>
                                        </td>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center;padding-bottom: 8px;">
                                            <?= $orderDetail['experience_end_date']; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="padding-left:20px; padding-right:20px;" align="left">
                        <tbody>
                        <tr>
                            <td style="font-family: 'Montserrat', sans-serif !important; font-size:18px; padding-top:15px;  color:#FF5A5F; line-height:24px; padding-bottom:15px;font-weight: 600" class="para1">
                                Billing Information
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="billing-info" width="90%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                    <tr>

                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:13px;color:#484848;line-height:20px;vertical-align:middle; padding-bottom: 5px;font-weight: 600;">
                                            <?= $orderDetail['user']['first_name']; ?>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:13px;color:#484848;line-height:20px;vertical-align:middle; padding-bottom: 5px;font-weight: 600;font-style: italic;">
                                            <?= $orderDetail['user']['last_name']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:13px;color:#484848;line-height:20px;vertical-align:middle; padding-bottom: 5px; font-weight: 600;font-style: italic;">
                                            <?= $orderDetail['phone_number']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle; padding-bottom: 5px;font-weight: 600;font-style: italic;">
                                            <a href="javascript:void(0)" style="color:#FF5A5F">
                                                <?= $orderDetail['user']['email']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat', sans-serif !important; font-size:16px; padding-top:15px;  color:#000; line-height:24px; padding-bottom:15px;font-weight: 600; text-align: center;" class="para1">
                                <a href="<?= $baseUrl.'my-account';?>" style="color:#000;">
                                    Go to My Account
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td style="padding-top:10px; padding-bottom:10px;">
                                <div class="cstm-seprator" style="margin: 5px 0; border-bottom: 1px solid #E7E7E7;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px; padding-bottom:5px; color:#484848; font-size:20px; text-align:center; font-family: 'Montserrat', sans-serif !important;">
                                <img border="0" style="width:190px;" src="<?= \Yii::$app->params['need_help_icon'];?>" alt="Need some help">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px; padding-bottom:25px; font-family:'Montserrat', sans-serif !important; text-align:center; color:#484848; font-size:14px; line-height:24px;">
                                our team is here for you and ready to answer any questions you may have.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr>
                                            <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center">
                                                <a href="<?= \Yii::$app->params['contact_us'];?>" style="padding-right:5px;padding-left:5px;color:#484848;text-decoration:none">Contact US</a>
                                                &nbsp;<span style="color:#484848">|</span>&nbsp;
                                                <a href="<?= \Yii::$app->params['about_us'];?>" style="padding-right:5px;padding-left:5px;color:#484848;text-decoration:none">About Us</a>
                                                &nbsp;<span style="color:#484848">|</span>&nbsp;
                                                <a href="<?= \Yii::$app->params['faq'];?>" style="padding-right:5px;padding-left:5px;color:#484848;text-decoration:none">Faq</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;padding-top:25px; padding-bottom: 25px;">
                                                &nbsp;<a href="<?= \Yii::$app->params['social_link']['facebook'];?>" style="display:inline-block" target="_blank">
                                                    <img style="width:26" src="<?= \Yii::$app->params['facebook_icon'];?>" class="CToWUd" alt="Facebook"></a>
                                                &nbsp;<a href="<?= \Yii::$app->params['social_link']['linkedin'];?>" style="display:inline-block" target="_blank">
                                                    <img style="width:26" src="<?= \Yii::$app->params['linkedin_icon'];?>" class="CToWUd" alt="linkedin">
                                                </a>
                                                &nbsp;<a href="<?= \Yii::$app->params['social_link']['twitter'];?>" style="display:inline-block" target="_blank">
                                                    <img style="width:26" src="<?= \Yii::$app->params['twitter_icon'];?>" class="CToWUd" alt="Twitter">
                                                </a>
                                                &nbsp;<a href="<?= \Yii::$app->params['social_link']['google'];?>" style="display:inline-block" target="_blank">
                                                    <img style="width:26" src="<?= \Yii::$app->params['google_icon'];?>" class="CToWUd" alt="Google">
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#111111" style="padding-left:11px; padding-right:10px; padding-top:15px; padding-bottom:15px; border-radius: 0 0 5px 5px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td style="text-align:center; font-size:13px; font-family: 'Montserrat', sans-serif !important; color:#fff; line-height:23px; font-weight: 500;"> © 2020 Go Do Experience. all rights reserved.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

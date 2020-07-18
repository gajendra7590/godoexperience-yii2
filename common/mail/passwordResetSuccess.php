<?php
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
$baseUrl = Yii::$app->urlManager->createAbsoluteUrl(['/']);  
?> 

<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-top: 21px; margin-bottom: 20px;">
    <tr>
        <td>
            <div class="mb_View" style="background-color: #000 !important; max-width:600px; margin: 0 auto;">
                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="logo_block" bgcolor="" style="padding-top:25px; padding-bottom:25px; text-align: center;">
                                        <a href="<?php echo $baseUrl;?>" target="_blank" target="_blank">
                                            <img src="<?= Yii::$app->params['logo_icon'];?>" width="210px" class="logo_img" alt="Logo">
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
                                            <tbody><tr>
                                                <td>
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                        <tbody> 
                                                        <tr>
                                                            <td style="padding-top:1px; padding-bottom:7px; font-family: 'Montserrat', sans-serif !important; color:#484848; font-size:15px; line-height:24px; font-weight: 600">
                                                                Hi, <?= Html::encode($user->first_name.' '.$user->last_name) ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:30px;" class="para1">
                                                               Congrasulations!! Your <a href="<?php $baseUrl;?>">Go Do Experience</a> account new password setted successfully.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-bottom: 20px;">
                                                                <table style="background-color: #FF5A5F; border: 1px solid #FF5A5F; border-radius: 4px;" cellspacing="0" cellpadding="0" align="center">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="padding-left: 15px; padding-right: 15px; text-align: center; cursor: pointer" valign="middle" height="45" width="164">
                                                                            <a href="<?php echo $baseUrl.'login';?>" target="_blank"  style="display: block; font-family: 'Montserrat', sans-serif !important; border-radius: 4px; font-size: 14px; line-height: 14px; color: #fff; text-decoration: none; font-weight: 500">
                                                                                <span>Login Your Account</span>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-family: 'Montserrat', sans-serif !important; font-size:14px; padding-top:10px;  color:#484848; line-height:24px; padding-bottom:30px;" class="para1">
                                                            If you did not request a change password, please let us know & ignore this email. contact 
                                                            <a href="<?php echo $baseUrl.'contact-us';?>">our support team</a> or email us at <a href="mailto:<?php echo Yii::$app->params['supportEmail'];?>"><?php echo Yii::$app->params['supportEmail'];?></a>  if you have a questions. 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:0; padding-bottom:0; font-family: 'Montserrat', sans-serif !important; color:#484848; font-size:14px; line-height:24px; font-weight: 600;">Regards,</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:0; padding-bottom:0; font-family: 'Montserrat', sans-serif !important; color:#484848; font-size:14px; line-height:24px;">Go Do Experience</td>
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
                                    <td style="padding-top:10px; padding-bottom:10px;">
                                        <div class="cstm-seprator" style="margin: 5px 0; border-bottom: 1px solid #E7E7E7;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:10px; padding-bottom:5px; color:#484848; font-size:20px; text-align:center; font-family: 'Montserrat', sans-serif !important;">
                                        <img border="0" style="width:190px;" src="<?= Yii::$app->params['need_help_icon'];?>" alt="Need some help">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:10px; padding-bottom:25px; font-family:'Montserrat', sans-serif !important; text-align:center; color:#484848; font-size:14px; line-height:24px;">
                                        our team is here for you and ready to answer any questions you may have.
                                    </td>
                                </tr>
                            </table>
                           <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tbody>
                                    <tr>
                                        <td>
                                       		<table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        		<tbody>
                                          			<tr>
                                                        <td style="font-family:'Montserrat',sans-serif!important;font-size:14px;color:#484848;line-height:20px;vertical-align:middle;text-align:center">
                                                            <a href="<?= Yii::$app->params['contact_us'];?>" style="padding-right:5px;padding-left:5px;color:#484848;text-decoration:none">Contact US</a>
                                                            &nbsp;<span style="color:#484848">|</span>&nbsp;
                                                            <a href="<?= Yii::$app->params['about_us'];?>" style="padding-right:5px;padding-left:5px;color:#484848;text-decoration:none">About Us</a>
                                                            &nbsp;<span style="color:#484848">|</span>&nbsp;
                                                            <a href="<?= Yii::$app->params['faq'];?>" style="padding-right:5px;padding-left:5px;color:#484848;text-decoration:none">Faq</a>
                                                        </td>
                                         			</tr>
                                         			<tr>
                                            			<td style="text-align:center;padding-top:25px; padding-bottom: 25px;">
                                                            <a href="<?= Yii::$app->params['social_link']['facebook'];?>" style="display:inline-block" target="_blank">
                                                                <img style="width:26" src="<?= Yii::$app->params['facebook_icon'];?>" class="CToWUd" alt="Facebook"></a>
                                                            &nbsp;<a href="<?= Yii::$app->params['social_link']['linkedin'];?>" style="display:inline-block" target="_blank">
                                                                <img style="width:26" src="<?= Yii::$app->params['linkedin_icon'];?>" class="CToWUd" alt="linkedin">
                                                            </a>
                                                            &nbsp;<a href="<?= Yii::$app->params['social_link']['twitter'];?>" style="display:inline-block" target="_blank">
                                                                <img style="width:26" src="<?= Yii::$app->params['twitter_icon'];?>" class="CToWUd" alt="Twitter">
                                                            </a>
                                                            &nbsp;<a href="<?= Yii::$app->params['social_link']['google'];?>" style="display:inline-block" target="_blank">
                                                                <img style="width:26" src="<?= Yii::$app->params['google_icon'];?>" class="CToWUd" alt="Google">
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
                                    <td style="text-align:center; font-size:13px; font-family: 'Montserrat', sans-serif !important; color:#fff; line-height:23px; font-weight: 500;"> © <?php echo date('Y');?> Go Do Experience. all rights reserved.
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </tr>
    </td>
</table>

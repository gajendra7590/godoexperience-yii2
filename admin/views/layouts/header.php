<?php  
  use admin\widgets\Alert;
  use yii\helpers\Html;
  use yii\bootstrap\Nav;
  use yii\bootstrap\NavBar;
  use yii\widgets\Breadcrumbs; 
  use yii\helpers\Url;
  use common\helpers\Utils;
  use xj\bootbox\BootboxAsset;
  BootboxAsset::register($this);
  BootboxAsset::registerWithOverride($this);
?>
<!-- Header Area Start -->
<header class="app-header">
        <div class="app-header__logo app_header_block">
            <a href="javascript:void(0)">
                <img src="<?= Url::to('@web/asset/images/icons/header_logo.png')?>" class="sidebar_logo_img" alt="Go DO Experience" />
            </a>
        </div>
        <!-- Sidebar toggle button-->
        <div class="sidebar_toggle_btn">
            <a class="app-sidebar__toggle" href="javascript:Void(0)" data-toggle="sidebar" aria-label="Hide Sidebar">
                <span class="toogle_left">
                        <img src="<?= Url::to('@web/asset/images/icons/toggle_left.png');?>" class="toggle_left">
                    </span>
                <span class="toogle_right">
                        <img src="<?= Url::to('@web/asset/images/icons/toggle_right.png')?>" class="toggle_right">
                    </span>
            </a>
        </div>
        <!-- Navbar Right Menu-->
        <h1 class="app_title"><?php echo $this->title; ?></h1>
        <div class="app-nav-right">
            <div class="mobile_toggle_right">
                <a class="slice-btn" href="JavaScript:Void(0)">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
                <a class="top_heaer_right" href="JavaScript:Void(0);">
                    <img src="<?= Url::to('@web/asset/images/icons/dropdown_dot.png'); ?>" alt="icon">
                </a>
            </div>
            <!-- Top Header Right Area Start -->
            <ul class="topheader_right_content">
                <li>
                    <a href="#" class="notifaction">
                        <img src="<?= Url::to('@web/asset/images/icons/notification.png')?>" alt="notifaction"> <span class="notication_circle">
                                2
                            </span>
                    </a>
                </li> 
            </ul>
            <!-- Top Header Right Area Closed -->
            <!-- Notification Area Start -->
            <div class="notification_content">
                <div class="layer_drop"></div>
                <div class="notification_wrapper">
                    <div class="notification_box">
                        <div class="cross_icon">
                            <img src="<?= Url::to('@web/asset/images/icons/close.png');?>" alt="close">
                        </div>
                        <div class="title_notification">
                            <h2>Notification</h2>
                        </div>
                        <div class="notification_list">
                            <a href="#" class="notification_item">
                                <div class="notification_item_icon">
                                    <img src="<?= Url::to('@web/asset/images/icons/order_icn.png')?>" alt="icon">
                                </div>
                                <div class="notification_item_details">
                                    <div class="notification_item-title">New order has been received</div>
                                    <div class="notification_item-time">2 hrs ago</div>
                                </div>
                            </a>
                            <a href="#" class="notification_item">
                                <div class="notification_item_icon">
                                    <img src="<?= Url::to('@web/asset/images/icons/order_icn.png')?>" alt="icon">
                                </div>
                                <div class="notification_item_details">
                                    <div class="notification_item-title">New customer is registered</div>
                                    <div class="notification_item-time">3 hrs ago</div>
                                </div>
                            </a>
                            <a href="#" class="notification_item">
                                <div class="notification_item_icon">
                                    <img src="<?= Url::to('@web/asset/images/icons/order_icn.png')?>" alt="icon">
                                </div>
                                <div class="notification_item_details">
                                    <div class="notification_item-title">Application has been approved</div>
                                    <div class="notification_item-time">3 hrs ago</div>
                                </div>
                            </a>
                            <a href="#" class="notification_item">
                                <div class="notification_item_icon">
                                    <img src="<?= Url::to('@web/asset/images/icons/order_icn.png')?>" alt="icon">
                                </div>
                                <div class="notification_item_details">
                                    <div class="notification_item-title">New file has been uploaded</div>
                                    <div class="notification_item-time">5 hrs ago</div>
                                </div>
                            </a>
                            <a href="#" class="notification_item">
                                <div class="notification_item_icon">
                                    <img src="<?= Url::to('@web/asset/images/icons/order_icn.png')?>" alt="icon">
                                </div>
                                <div class="notification_item_details">
                                    <div class="notification_item-title">New user feedback received</div>
                                    <div class="notification_item-time">8 hrs ago</div>
                                </div>
                            </a>
                            <a href="#" class="notification_item">
                                <div class="notification_item_icon">
                                    <img src="<?= Url::to('@web/asset/images/icons/order_icn.png')?>" alt="icon">
                                </div>
                                <div class="notification_item_details">
                                    <div class="notification_item-title">System reboot has been successfully completed
                                    </div>
                                    <div class="notification_item-time">12 hrs ago</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Notification Area Closed -->
        </div>
        <div class="clearfix"></div>
    </header>
    <!-- Header Area Closed -->
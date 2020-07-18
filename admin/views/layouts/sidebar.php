<?php

use admin\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use common\helpers\Utils;

$base_url = Yii::$app->getUrlManager()->getBaseUrl();

//For Add Active Class
$current_url = Yii::$app->getRequest()->getPathInfo();

?>
<div class="clearfix"></div>
<!-- Sidebar Area Start-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<div class="layer-drop"></div>
<section class="left_sidebar_wrapper">
    <div class="cross-icon"><span class="fa fa-close"></span></div>
    <div class="left_Sidebar_Sec">
        <div class="left_sidebar_Content">
            <div class="left_Logo">
                <a href="<?= Url::to(['/dashboard']); ?>">
                    <img src="<?= Url::to('@web/asset/images/icons/logo.png'); ?>" alt="logo">
                </a>
            </div>
            <div class="top_user">
                <ul class="list-unstyled">
                    <li>
                        <a href="<?= Url::to(['/manage-profile']); ?>" title="Manage Your Profile">
                            <img src="<?= Url::to('@web/asset/images/icons/user.png'); ?>" alt="icon"
                                 class="user_icn_left">
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/change-password']); ?>" title="Change Your Password">
                            <img src="<?= Url::to('@web/asset/images/icons/changes-psw-blue-icn.svg'); ?>" alt="icon"
                                 class="user_icn_left">
                        </a>
                    </li>
                    <li>
                        <?php echo Html::tag('a', '<img src="' . Url::to("@web/asset/images/icons/setting.png") . '" alt="icon">', [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Are you sure to logged out ?'
                                ],
                                'title' => 'Logged Out Your Account',
                                'data-pjax' => 0,
                                'data-method' => 'post',
                                'href' => Url::to(['/logout'])
                            ]
                        );
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <aside class="app-sidebar">
            <div class="app-sidebar_Heading">
                <h4>
                    <?php echo (isset(Yii::$app->user->identity->first_name)) ? (ucfirst(Yii::$app->user->identity->first_name) . ' ' . ucfirst(Yii::$app->user->identity->last_name)) : ''; ?>
                </h4>
                <p>
                    <?php echo (isset(Yii::$app->user->identity->role_id)) ? Utils::getUser(Yii::$app->user->identity->role_id) : 'Admin'; ?>
                </p>
            </div>
            <ul class="app-menu">
                <li>
                    <a class="app-menu__item <?php echo (in_array($current_url, ['', 'dashboard'])) ? 'active' : '' ?>"
                       href="<?= $base_url . '/dashboard'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/icn_dashboard_blue.png'); ?>" alt="icon">
                            </span>
                        <span class="icons_white">
                                <img src="<?= Url::to('@web/asset/images/icons/icn_dashboard_white.png'); ?>"
                                     alt="icon">
                            </span>
                        <span class="app-menu__label">Dashboard</span>
                    </a>
                </li>
                <?php if (isset(Yii::$app->user->identity->role_id) && (Yii::$app->user->identity->role_id == '1')) { ?>
                    <li>
                        <a class="app-menu__item <?php echo (in_array($current_url, ['company', 'company/index'])) ? 'active' : '' ?>"
                           href="<?= $base_url . '/company'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/company-blue-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="icons_white">
                                <img src="<?= Url::to('@web/asset/images/icons/company-white-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="app-menu__label">Company Detail</span>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a class="app-menu__item <?php echo (in_array($current_url, ['experiences', 'experiences/manage-availability', 'experiences/index', 'experiences/create', 'experiences/update'])) ? 'active' : '' ?>"
                       href="<?= $base_url . '/experiences'; ?>">
                         <span class="icons_blue">
                            <img src="<?= Url::to('@web/asset/images/icons/experience-blue-icn.svg'); ?>" alt="icon">
                        </span>
                        <span class="icons_white">
                            <img src="<?= Url::to('@web/asset/images/icons/experience-white-icn.svg'); ?>" alt="icon">
                        </span>
                        <span class="app-menu__label">Experiences</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item <?php echo (in_array($current_url, ['orders', 'orders/index', 'orders/create', 'orders/update'])) ? 'active' : '' ?>"
                       href="<?= $base_url . '/orders'; ?>">
                        <span class="icons_blue">
                            <img src="<?= Url::to('@web/asset/images/icons/booking-blue-icn.svg'); ?>" alt="icon">
                        </span>
                        <span class="icons_white">
                            <img src="<?= Url::to('@web/asset/images/icons/booking-white-icn.svg'); ?>" alt="icon">
                        </span>
                        <span class="app-menu__label">Bookings List</span>
                    </a>
                </li>
                <?php if (isset(Yii::$app->user->identity->role_id) && (Yii::$app->user->identity->role_id == '1')) { ?>
                    <li>
                        <a class="app-menu__item <?php echo (in_array($current_url, ['categories', 'categories/index', 'categories/create', 'categories/update'])) ? 'active' : '' ?>"
                           href="<?= $base_url . '/categories'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/category-blue-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="icons_white">
                                <img src="<?= Url::to('@web/asset/images/icons/category-white-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="app-menu__label">Categories</span>
                        </a>
                    </li>
                    <?php /*
                       <li>
                           <a class="app-menu__item <?php echo (in_array($current_url, ['amenities', 'amenities/index', 'amenities/create', 'amenities/update'])) ? 'active' : '' ?>" href="<?= $base_url . '/amenities'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/icn_cases_blue.png'); ?>" alt="icon">
                            </span>
                               <span class="icons_white">
                                <img src="<?= Url::to('@web/asset/images/icons/icn_cases_white.png'); ?>" alt="icon">
                            </span>
                               <span class="app-menu__label">Amenities</span>
                           </a>
                       </li>*/
                       ?>
                    <li>
                        <a class="app-menu__item <?php echo (in_array($current_url, ['vendors', 'vendors/index', 'vendors/create', 'vendors/update', 'vendors/detail'])) ? 'active' : '' ?>"
                           href="<?= $base_url . '/vendors'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/vendors-blue-icn.svg') ?>" alt="icon">
                            </span>
                            <span class="icons_white">
                            <img src="<?= Url::to('@web/asset/images/icons/vendors-white-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="app-menu__label">Vendors</span>
                        </a>
                    </li>
                    <li>
                        <a class="app-menu__item <?php echo (in_array($current_url, ['clients', 'clients/index', 'clients/create', 'clients/update'])) ? 'active' : '' ?>"
                           href="<?= $base_url . '/clients'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/clients-blue-icn.svg') ?>" alt="icon">
                            </span>
                            <span class="icons_white">
                            <img src="<?= Url::to('@web/asset/images/icons/clients-white-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="app-menu__label">Clients</span>
                        </a>
                    </li>
                    <li>
                        <a class="app-menu__item <?php echo (in_array($current_url, ['testimonial', 'testimonial/index', 'testimonial/create', 'testimonial/update'])) ? 'active' : '' ?>"
                           href="<?= $base_url . '/testimonial'; ?>">
                            <span class="icons_blue">
                                <img src="<?= Url::to('@web/asset/images/icons/testimonial-blue-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="icons_white">
                                <img src="<?= Url::to('@web/asset/images/icons/testimonial-white-icn.svg'); ?>" alt="icon">
                            </span>
                            <span class="app-menu__label">Testimonial</span>
                        </a>
                    </li>
                    <li>
                        <a class="app-menu__item <?php echo (in_array($current_url, ['contact-enquiries', 'contact-enquiries/index'])) ? 'active' : '' ?>"
                           href="<?= $base_url . '/contact-enquiries'; ?>">
                        <span class="icons_blue">
                            <img src="<?= Url::to('@web/asset/images/icons/contact-blue-icn.svg'); ?>" alt="icon">
                        </span>
                            <span class="icons_white">
                            <img src="<?= Url::to('@web/asset/images/icons/contact-white-icn.svg'); ?>" alt="icon">
                        </span>
                            <span class="app-menu__label">Contact Enquiries</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </aside>
    </div>
</section>
<!-- Sidebar Area Closed-->
    
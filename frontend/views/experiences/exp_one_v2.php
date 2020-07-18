<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad; 
$base_url = Url::to(['/']);
$this->title = 'Experiences - Experience Detail'; 
?>
<!-- exp gallery Start -->
<section class="exp_gallery_wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="exp_breadcrumb">
                <ul>
                    <li><a href="<?= Url::to(['/']);?>">Home <span>/</span></a>
                    </li>
                    <li><a href="<?= Url::to(['/experiences?category='.$experience_detail->category->slug]);?>"><?= $experience_detail->category->name;?> <span>/</span></a>
                    </li>
                    <li><a href="javascript:void:(0)"><?= $experience_detail->title;?></a> </li>
                </ul>
            </div>
        </div>

        <!-- Rendering Slider View Here -->
        <?= $this->render('exp_one_v2_slider', [
            'experience_detail' => $experience_detail,
            'experience_saved' => $experience_saved,
            'experience_adons' => $experience_adons,
            'experince_media' => $experince_media
        ]) ?>

        <div class="exp_detail-fea">
            <div class="col-sm-4">
                <div class="exp_detail-info">
                    <span class="exp_detail-sub">featured</span> : <?= ( isset($experience_detail['featured']) && ($experience_detail['featured'] == '1')) ?'yes':'no';?>
                    <h3><?= isset($experience_detail['category']['name']) ?$experience_detail['category']['name']:'--';?></h3>
                    <h5><?= isset($experience_detail['title']) ?$experience_detail['title']:'--';?></h5>
                    <div class="exp_detail-cate">
                        <a href="javascript:void(0);"><?= $experience_detail['city'].' '.$experience_detail['country'];?></a>
                    </div>
                    <div class="exp_detail-rateing">
                    <i class="fa fa-star" aria-hidden="true"></i><span>4.97</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="exp_detail-ele">
                    <div class="exp_detail-des">
                        <?= substr(strip_tags($experience_detail['description']),0,170);?>...
                    </div>
                    <div class="exp_ele-list">
                        <div class="col-xs-6 col-sm-3">
                            <div class="exp_ele-mod">
                                <div class="exp_ele-icn">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                                <div class="exp_ele-duration">
                                 Duration
                                </div>
                                <div class="exp_ele-time">
                                <?= $experience_detail['duration'].' '.$experience_detail['duration_type'];?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="exp_ele-mod">
                            <div class="exp_ele-icn">
                            <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="exp_ele-duration">
                                Group size
                                </div>
                                <div class="exp_ele-time">
                                Up to <?= $experience_detail['group_size'];?> people
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="exp_ele-mod">
                            <div class="exp_ele-icn">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <div class="exp_ele-duration">
                                Activity level
                                </div>
                                <div class="exp_ele-time">
                                   <?= ucfirst($experience_detail['activity_level']);?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="exp_ele-mod">
                            <div class="exp_ele-icn">
                            <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                </div>
                                <div class="exp_ele-duration">
                                 Hosted in
                                </div>
                                <div class="exp_ele-time">
                                    <?= $experience_detail['city'].' '.$experience_detail['country'];?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- exp gallery Closed -->
<!-- exp wyou Start -->
<section class="exp_wyou_wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="exp_wyou_title">
                <h3>What you'll do</h3>
            </div>
        </div>
        <div class="col-md-8">
            <div class="exp_wyou_des">
                <?= isset($experience_detail['description'])?$experience_detail['description']:'';?>
            </div>
        </div>
    </div>
</div>
</section>
<!-- exp wyou Closed -->
<!-- exp category Start -->
<section class="exp_category_wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="exp_category_title">
                <h3>What you'll do</h3>
                <p>Cook with one of the best chefs ever: Our grandma, Nonna Nerina. She and her sisters will
                    <br>show you how to prepare the perfect pasta</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="exp_category_box">
                <div class="exp_category_icon">
                    <div class="exp_icon_overlay"></div>
                    <svg viewBox="0 -46 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m409 40c-21.878906 0-44.335938 7.164062-61.65625 19.238281-15.878906-35.5-51.570312-59.238281-91.34375-59.238281s-75.464844 23.738281-91.34375 59.238281c-17.320312-12.074219-39.777344-19.238281-61.65625-19.238281-38.726562 0-75.046875 22.210938-92.527344 56.578125-2.503906 4.925781-.542968 10.941406 4.378906 13.445313 4.921876 2.503906 10.941407.542968 13.445313-4.378907 14.105469-27.726562 43.425781-45.644531 74.703125-45.644531 22.117188 0 44.804688 8.84375 59.210938 23.082031 2.523437 2.492188 6.183593 3.464844 9.605468 2.550781 3.429688-.914062 6.117188-3.578124 7.0625-6.996093 9.546875-34.527344 41.261719-58.636719 77.121094-58.636719s67.574219 24.109375 77.121094 58.636719c.945312 3.417969 3.632812 6.082031 7.0625 6.996093 3.425781.914063 7.082031-.058593 9.605468-2.550781 14.40625-14.238281 37.09375-23.082031 59.210938-23.082031 44.988281 0 83 36.636719 83 80s-38.011719 80-83 80c-2.941406 0-5.941406-.164062-8.910156-.488281-2.832032-.316407-5.648438.597656-7.765625 2.492187-2.113281 1.898438-3.324219 4.605469-3.324219 7.445313v90.550781h-53v-50c0-5.523438-4.476562-10-10-10s-10 4.476562-10 10v50h-50v-50c0-5.523438-4.476562-10-10-10s-10 4.476562-10 10v50h-50v-50c0-5.523438-4.476562-10-10-10s-10 4.476562-10 10v50h-53v-90.550781c0-2.839844-1.210938-5.546875-3.324219-7.445313-2.117187-1.894531-4.941406-2.804687-7.765625-2.492187-34.527344 3.777343-68.183594-14.820313-83.613281-45.15625-2.5-4.925781-8.523437-6.886719-13.445313-4.378907-4.921874 2.503907-6.882812 8.519532-4.378906 13.445313 17.480469 34.367187 53.800782 56.578125 92.527344 56.578125v170c0 5.523438 4.476562 10 10 10h286c5.523438 0 10-4.476562 10-10v-170c54.226562 0 103-43.800781 103-100 0-56.203125-48.777344-100-103-100zm-286 360v-60h266v60zm0 0" />
                        <path
                            d="m10 150c5.519531 0 10-4.480469 10-10s-4.480469-10-10-10-10 4.480469-10 10 4.480469 10 10 10zm0 0" />
                    </svg>
                </div>
                <div class="exp_category_des">
                    <h4>Passionate cooks</h4>
                    <p>Donec feugiat id augue consequat vulputate at magna mattis dignissim libero fringilla leo
                        aiquam veh. ultrices fringilla est tortor sollicitudin dignissim libero fringilla.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="exp_category_box">
                <div class="exp_category_icon">
                    <div class="exp_icon_overlay"></div>
                    <svg id="Layer_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z" />
                        <path
                            d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z" />
                    </svg>
                </div>
                <div class="exp_category_des">
                    <h4>Intimate settings</h4>
                    <p>Donec feugiat id augue consequat vulputate at magna mattis dignissim libero fringilla leo
                        aiquam veh. ultrices fringilla est tortor sollicitudin dignissim libero fringilla.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="exp_category_box">
                <div class="exp_category_icon">
                    <div class="exp_icon_overlay"></div>
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M437.019,74.98C388.667,26.629,324.38,0,256,0C187.619,0,123.331,26.629,74.98,74.98C26.628,123.332,0,187.62,0,256
    s26.628,132.667,74.98,181.019C123.332,485.371,187.619,512,256,512c68.38,0,132.667-26.629,181.019-74.981
    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.019,74.98z M256,482C131.383,482,30,380.617,30,256S131.383,30,256,30
    s226,101.383,226,226S380.617,482,256,482z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M378.305,173.859c-5.857-5.856-15.355-5.856-21.212,0.001L224.634,306.319l-69.727-69.727
    c-5.857-5.857-15.355-5.857-21.213,0c-5.858,5.857-5.858,15.355,0,21.213l80.333,80.333c2.929,2.929,6.768,4.393,10.606,4.393
    c3.838,0,7.678-1.465,10.606-4.393l143.066-143.066C384.163,189.215,384.163,179.717,378.305,173.859z" />
                            </g>
                        </g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                    </svg>
                </div>
                <div class="exp_category_des">
                    <h4>Vetted by GoDo Experience</h4>
                    <p>Donec feugiat id augue consequat vulputate at magna mattis dignissim libero fringilla leo
                        aiquam veh. ultrices fringilla est tortor sollicitudin dignissim libero fringilla.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- exp category Closed -->
<!-- exp testimonial Start -->
<section class="exp_testimonial_wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="exp_testimonial_info">
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active">
                            <img class="img-responsive " src="<?= Url::to('@web/asset/images/background/banner1.jpg');?>"
                                alt="test">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="1">
                            <img class="img-responsive" src="<?= Url::to('@web/asset/images/background/banner1.jpg');?>"
                                alt="test">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="2">
                            <img class="img-responsive" src="<?= Url::to('@web/asset/images/background/banner1.jpg');?>"
                                alt="test">
                        </li>
                    </ol>
                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner text-center">
                        <div class="btc_center_line"></div>
                        <!-- Quote 1 -->
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-2 col-xs-offset-2">
                                    <div class="exp_quote_one"></div>
                                    <div class="exp_quote_two"></div>
                                    <p>“Donec feugiat id augue consequat vulputate Suspendisse at magna mattis
                                        dignissim libero fringilla leo aiquam veh. ultrices fringilla est tortor
                                        sollicitudin. This is Photoshop's version of Lorem Ipsum. Proin graida
                                        nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                        auctor.”</p>
                                    <div class="exp_quote_line"></div>
                                    <h1>Chiara & Nonna</h1>
                                    <a href="#">Contact Host</a>
                                </div>
                            </div>
                        </div>
                        <!-- Quote 2 -->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-2 col-xs-offset-2">
                                    <div class="exp_quote_one"></div>
                                    <div class="exp_quote_two"></div>
                                    <p>“Donec feugiat id augue consequat vulputate Suspendisse at magna mattis
                                        dignissim libero fringilla leo aiquam veh. ultrices fringilla est tortor
                                        sollicitudin. This is Photoshop's version of Lorem Ipsum. Proin graida
                                        nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                        auctor.”</p>
                                    <div class="exp_quote_line"></div>
                                    <h1>Chiara & Nonna</h1>
                                    <a href="#">Contact Host</a>
                                </div>
                            </div>
                        </div>
                        <!-- Quote 3 -->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-2 col-xs-offset-2">
                                    <div class="exp_quote_one"></div>
                                    <div class="exp_quote_two"></div>
                                    <p>“Donec feugiat id augue consequat vulputate Suspendisse at magna mattis
                                        dignissim libero fringilla leo aiquam veh. ultrices fringilla est tortor
                                        sollicitudin. This is Photoshop's version of Lorem Ipsum. Proin graida
                                        nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                        auctor.”</p>
                                    <div class="exp_quote_line"></div>
                                    <h1>Chiara & Nonna</h1>
                                    <a href="#">Contact Host</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- exp testimonial Closed -->

<!-- Btm Show Date Area Start -->
<section class="btm_Show-date">
<div class="container">
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="btm_Show-profile">
            <div class="btm_Show-icon">
                <img src="<?= Url::to(['/asset/images/icons/user-showdata.png']);?>" alt="user" />
            </div>
            <div class="btm_Show-title">
                <span class="btm_Show-title-deshktop">Feeling Samurai Soul</span>
                <span class="btm_Show-ele-mobile">From <?= Utils::cc().$experience_detail['price'];?>/person</span>
            </div>
            <div class="btn-Show-rating">
                <a href="#">4.99 <i class="fa fa-star" aria-hidden="true"></i> <span>(05)</span></a>
            </div>
        </div>  
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="btm_Show-ele">
            <span class="btm_Show-ele-deshktop">From <?= Utils::cc().$experience_detail['price'];?>/person</span>
            <?php if(Yii::$app->user->getIsGuest()){?>
                <a class="btn_Primary" href="<?= Url::to(['/login','ref'=>(Yii::$app->request->url)]);?>">
                    Show dates
                </a>
            <?php }else{?>
            <button class="btn_Primary" id="showBookDates" data-base_url="<?= $base_url;?>" data-id="<?= $experience_detail['id'];?>">
                Show dates
            </button>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</section>
<!-- Show Date Area Popup -->
<section class="modal fade exp_shw-date" id="showDatePopup" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <img src="<?= Url::to(['/asset/images/icons/close-show-date.png']);?>" alt="close icn" />
        </button>
    </div>
    <!-- Modal Body Start -->
    <div class="modal-body">
        <!-- Exp Show Ele Start -->
        <div class="exp_shw-ele">
            <!-- Container Area Start -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <!--events calendar shw Start-->
                        <div class="corona_Events" id="avalaibleDates"> </div>
                        <!--events calendar shw End-->
                        <!--Pay Section shw Start-->
                        <div id="cartPaySection"></div>
                        <!--Pay Section shw End-->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <!-- Exp Show Available Closed -->
                        <div class="exp_shw-avilble">
                            <div class="exp_shw-slct">
                                <h1>Next available</h1>
                                <p>Select dates for availability.</p>
                                <!--guests shw Start-->
                                <div class="guests-shw" id="guestSection"></div>
                                <!--guests shw Closed-->
                            </div>
                            <!--events shw Start-->
                            <div class="exp_package-slct" id="avalaibleEvents"></div>
                            <!--events shw End-->
                        </div>
                        <!-- Exp Show Available Closed -->
                    </div>
                </div>
            </div>
            <!-- Container Area Closed -->
        </div>
        <!-- Exp Show Ele Closed -->
    </div>
    <!-- Modal Body Cloase -->
</div>
<!-- Modal content Closed-->
</div>
</section>

<!-- Share Social Media-->
<section class="modal fade share_Popup" id="shareIcon" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <img src="<?= Url::to(['/asset/images/icons/close-show-date.png']);?>" alt="close icn" />
            </button>
            <h4 class="modal-title">Share</h4>
        </div>
        <div class="modal-body">
            <?= \ymaker\social\share\widgets\SocialShare::widget([
                'configurator'  => 'socialShare',
                'url'           => (Yii::$app->request->hostInfo).(Yii::$app->request->url),
                'title'         => $experience_detail->title,
                'description'   => substr(strip_tags($experience_detail['description']),0,150).'...',
                'imageUrl'      => Utils::IMG_URL($experience_detail->experiences_image_url),
            ]); ?>
        </div>
    </div>
</div>
</section>
<!-- Share Social Media Closed-->








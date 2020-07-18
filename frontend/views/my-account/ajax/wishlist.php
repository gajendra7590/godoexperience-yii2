<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad;

//echo '<pre>';print_r($pageData);
?>
<!--My Account Order Wishlist-->
<section class="myac-wishlist">
    <div class="my-ac-title">
        <h3>Your Saved Experiences</h3>
    </div>
    <!-- Row Area -->
    <div class="row">
        <!-- Wishlist Item Start-->
        <?php if( isset($pageData) && (!empty($pageData))){ ?>
        <?php foreach ($pageData as $exp){
        ?>
        <div class="col-mobile col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <div class="rted__Exp--item">
                <a class="wishlist_close" data-exp_id="<?= $exp['experiences']['id'];?>" href="javascript:void(0)"><i class="fa fa-times" aria-hidden="true"></i></a>
                <a href="<?= Url::to(['/experience/'.$exp['experiences']['slug']]);?>">
                    <figure class="rted__Exp--img">
                        <?= LazyLoad::widget(['src' => (($exp['experiences']['experiences_image_url']!='')?(Utils::IMG_URL($exp['experiences']['experiences_image_url'])):'no-image'),'options'=>[
                            'class'=>'img-responsive',
                            'alt'=>$exp['experiences']['title']
                        ] ]); ?>                     <!-- Lazy End -->
                    </figure>
                    <span class="category_name_title"><?= $exp['experiences']['category']['name'] ?></span>
                    <p title="This Island is Canada's Best Kept Secret">
                        <?= $exp['experiences']['title'] ?>
                    </p>
                    <span class="price__Item--prduct">From <?= Utils::cc().$exp['experiences']['price'] ?>/ person . <?=$exp['experiences']['duration'].$exp['experiences']['duration_type'];?></span>

                </a>

            </div>
        </div>
            <?php }}else{ ?>
            <div class="col-sm-12">
                <div class="myac-nomsg">
                    <span>No item in wishlist</span>
                </div>
            </div>

        <?php } ?>
        <!-- // Wishlist Item End-->

    </div>
    <!--// Row Area -->
</section>
<!--My Account Order Wishlist-->

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad;

$this->title = 'Experiences - Experiences List';
$catName = Yii::$app->getRequest()->getQueryParam('category');
$mainImg = ( isset($singleExp['filter_by_cat']) && ($singleExp['filter_by_cat'] == true)) ? $singleExp['category_image_url']:$singleExp['experiences_image_url'];

?>
<!-- Features Category Area Start -->
<section class="features__Search sub__Category--banner"
         style="background: #000 url(<?= ($mainImg!='') ? (Utils::IMG_URL($mainImg)) : (Url::to(['/asset/images/background/exp_no_img.png'])); ?>);">
    <div class="features__Search__Content">
        <h1><?= isset($singleExp['title']) ? $singleExp['title'] : ''; ?></h1>
        <?php if( isset($singleExp['filter_by_cat']) && ($singleExp['filter_by_cat'] == true)){ ?>
        <p>
            <?= isset($singleExp['description']) ? substr($singleExp['description'],0,150) : ''; ?>
        </p>
        <?php }else{ ?>
        <p>
            <?= isset($singleExp['sub_title']) ? $singleExp['sub_title'] : ''; ?>
        </p>
        <?php } ?>
    </div>
</section>
<!-- Features Category Area Closed -->

<!-- main Content Area Start -->
<main id="main__Content">
    <!-- Sub Ctgry About Area Start -->
    <section class="sub__Ctgry--abut">
        <div class="container">
            <div class="row cst__Row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                    <div class="sub__Abut--title">
                        <h2><?= isset($singleExp['title']) ? $singleExp['title'] : ''; ?></h2>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                    <div class="sub__Abut--content">
                            <p>
                                <?= isset($singleExp['description']) ? substr($singleExp['description'],0,200).'.....' : ''; ?>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sub Ctgry About Area Closed -->
    <div class="clearfix"></div>
    <!-- Features Exp Area Start -->
    <section class="features__Exp">
        <div class="container">
            <div class="listing__Title">
                <h3>Our Features Experience</h3>
            </div>
            <div class="features__Exp--content">
                <div class="row cst__Row">
                    <?php if (!empty($exp_featured)) {
                        foreach ($exp_featured as $k => $feature) { ?>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 cst__Col">
                                <div class="features__Exp--item">
                                    <a href="<?= Url::to(['/experience/' . $feature->slug]); ?>">
                                        <div class="features__Exp--img">
                                            <!-- Lazy start -->
                                            <?= LazyLoad::widget(['src' => (($feature->experiences_image_url != '') ? (Utils::IMG_URL($feature->experiences_image_url)) : 'no-image'), 'options' => [
                                                'class' => 'img-responsive',
                                                'alt' => $feature->title
                                            ]]); ?>
                                            <!-- Lazy End -->
                                        </div>
                                        <div class="features__Exp--details">
                                            <p class="category_name_title"><?= $feature->category->name; ?></p>
                                            <div class="features__Exp--title" title="<?= $feature->title; ?>">
                                                <?= $feature->title; ?>
                                            </div>
                                            <div class="features__Exp--rating"><i class="fa fa-star"
                                                                                  aria-hidden="true"></i><span>4.87</span>
                                            </div>
                                        </div>
                                    </a>
                                    <span class="price__Item--prduct">From <?= Utils::cc() . $feature->price; ?>/ person . <?= $feature->duration . ' ' . $feature->duration_type; ?></span>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                    <div class="col-sm-12">
                        <div class="no-experiences-found">
                            <div class="no-exp-found-head">
                                <span>No featured experiences found <?php if ($catName != '') {
                                        echo ' for <b>' . (strtoupper($catName)) . '</b> ';
                                    }; ?>,browse all other experiences</span>
                            </div>
                            <div class="browse_all-btn">
                                <a href="<?= Url::to(['/experiences']); ?>" class="browse_all exp__Btn--outline">Browse
                                    All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Features Exp Area Closed -->
    <!-- Top Rated Exp Area Start -->
    <section class="rted__Exp">
        <div class="container">
            <div class="listing__Title">
                <h3>Experiences For Product</h3>
            </div>
            <div class="rted__Exp--content cst__Row">

                <?php if (!empty($exp_prod)) {
                    foreach ($exp_prod as $k => $ac) { ?>

                        <div class="rted__Exp--col cst__Col">
                            <div class="rted__Exp--item">
                                <a href="<?= Url::to(['/experience/' . $ac->slug]); ?>">
                                    <figure class="rted__Exp--img">
                                        <!-- Lazy start -->
                                        <?= LazyLoad::widget(['src' => (($ac->experiences_image_url != '') ? (Utils::IMG_URL($ac->experiences_image_url)) : 'no-image'), 'options' => [
                                            'class' => 'img-responsive',
                                            'alt' => $ac->title
                                        ]]); ?>
                                        <!-- Lazy End -->
                                    </figure>
                                    <span class="category_name_title"><?= $ac->category->name; ?></span>
                                    <p title="<?= $ac->title; ?>">
                                        <?= substr($ac->title, 0, 40) . '...'; ?>
                                    </p>
                                    <span class="price__Item--prduct">From <?= Utils::cc() . $ac->price; ?>/ person . <?= $ac->duration . ' ' . $ac->duration_type; ?></span>

                                </a>

                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class='no-experiences-found'>
                        <div class="no-exp-found-head">
                        <span>
                            No experience found <?php if ($catName != '') {
                                echo ' for <b>' . (strtoupper($catName)) . '</b> ';
                            }; ?>,browse all other experiences</span>
                        </div>
                        <div class="browse_all-btn">
                            <a href="<?= Url::to(['/experiences']); ?>" class="browse_all exp__Btn--outline">Browse All
                                <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Top Rated Exp Area Closed -->
</main>
<!-- main Content Area Closed --
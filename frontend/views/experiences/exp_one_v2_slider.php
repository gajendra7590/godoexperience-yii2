<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad;
$count = count($experince_media);
?>

<?php if($count == 1){ ?>
<div class="col-md-12 gallery_One">
    <?php foreach ($experince_media as $k => $media){?>
        <div class="gallery_one-img gallery_Item">
            <a href="<?= Utils::IMG_URL($media);?>" data-lightbox="gallery">
                <?= LazyLoad::widget(['src' => (($media!='')?(Utils::IMG_URL($media)):'no-image'),'options'=>[
                    'class'=>'img-responsive',
                    'alt'=>'Slider Image'
                ] ]); ?>
                <?php if($k == 0){ ?>
                    <div class="exp_column_four-share">
                        <ul class="single-share-wishlisth">
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#shareIcon">
                                    <i class="fa fa-share-square-o" aria-hidden="true"></i><span>Share</span></a>
                            </li>
                            <li>
                                <?php if(Yii::$app->user->isGuest){?>
                                    <a href="<?= Url::to(['/login','ref'=>(Yii::$app->request->url)]);?>" >
                                        <i class="fa fa-heart-o" aria-hidden="true"></i><span>Save</span>
                                    </a>

                                <?php }else{ ?>
                                    <a href="javascript:void(0)" id="savedExp" class="<?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'saved_item_true':''; ?>"
                                       data-exp_id="<?= isset($experience_detail['id'])?$experience_detail['id']:0;?>">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        <span><?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'<span>Saved</span>':'<span>Save</span>'; ?></span>
                                    </a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </a>
        </div>
    <?php }?>
</div>
<?php } ?>

<?php if($count == 2){ ?>
<div class="col-md-12 gallery_Two">
<div class="row">
    <?php foreach ($experince_media as $k => $media){?>
        <div class="col-xs-6 col-sm-6 col-<?= $k+1;?>">
            <div class="gallery_Two-img gallery_Item">
                <a href="<?= Utils::IMG_URL($media);?>" data-lightbox="gallery">
                    <?= LazyLoad::widget(['src' => (($media!='')?(Utils::IMG_URL($media)):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>'Slider Image'
                    ] ]); ?>
                    <?php if($k == 1){ ?>
                        <div class="exp_column_four-share">
                            <ul class="single-share-wishlisth">
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#shareIcon">
                                        <i class="fa fa-share-square-o" aria-hidden="true"></i> Share</a>
                                </li>
                                <li>
                                    <?php if(Yii::$app->user->isGuest){?>
                                        <a href="<?= Url::to(['/login','ref'=>(Yii::$app->request->url)]);?>" >
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            Save
                                        </a>

                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" id="savedExp" class="<?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'saved_item_true':''; ?>"
                                           data-exp_id="<?= isset($experience_detail['id'])?$experience_detail['id']:0;?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            <?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'<span>Saved</span>':'<span>Save</span>'; ?>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
</div>

<?php } ?>

<?php if($count == 3){ ?>
<div class="col-md-12 gallery_Three">
<div class="row">
    <?php foreach ($experince_media as $k => $media){?>
        <div class="col-xs-4 col-sm-4 col-<?= $k+1;?>">
            <div class="gallery_Three-img gallery_Item">
                <a href="<?= Utils::IMG_URL($media);?>" data-lightbox="gallery">
                    <?= LazyLoad::widget(['src' => (($media!='')?(Utils::IMG_URL($media)):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>'Slider Image'
                    ] ]); ?>
                    <?php if($k == 2){ ?>
                        <div class="exp_column_four-share">
                            <ul class="single-share-wishlisth">
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#shareIcon">
                                        <i class="fa fa-share-square-o" aria-hidden="true"></i> Share</a>
                                </li>
                                <li>
                                    <?php if(Yii::$app->user->isGuest){?>
                                        <a href="<?= Url::to(['/login','ref'=>(Yii::$app->request->url)]);?>" >
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            Save
                                        </a>

                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" id="savedExp" class="<?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'saved_item_true':''; ?>"
                                           data-exp_id="<?= isset($experience_detail['id'])?$experience_detail['id']:0;?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            <?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'<span>Saved</span>':'<span>Save</span>'; ?>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
</div>
<?php } ?>

<?php if($count == 4){ ?>
<div class="col-md-12 gallery_Four">
<div class="row">
    <?php foreach ($experince_media as $k => $media){?>
        <div class="col-xs-3 col-sm-3 col-<?= $k+1;?>">
            <div class="gallery_Four-img gallery_Item">
                <a href="<?= Utils::IMG_URL($media);?>" data-lightbox="gallery">
                    <?= LazyLoad::widget(['src' => (($media!='')?(Utils::IMG_URL($media)):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>'Slider Image'
                    ] ]); ?>
                    <?php if($k == 3){ ?>
                        <div class="exp_column_four-share">
                            <ul class="single-share-wishlisth">
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#shareIcon">
                                        <i class="fa fa-share-square-o" aria-hidden="true"></i> <span>share</span></a>
                                </li>
                                <li>
                                    <?php if(Yii::$app->user->isGuest){?>
                                        <a href="<?= Url::to(['/login','ref'=>(Yii::$app->request->url)]);?>" >
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                           <span> Save</span>
                                        </a>

                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" id="savedExp" class="<?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'saved_item_true':''; ?>"
                                           data-exp_id="<?= isset($experience_detail['id'])?$experience_detail['id']:0;?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            <?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'<span>Saved</span>':'<span>Save</span>'; ?>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
</div>
<?php } ?>

<?php if($count == 5){ ?>
<div class="col-md-12 gallery_Five">
    <div class="exp_gallery_main">
        <div class="exp_column exp_column_one">
            <a href="<?= Utils::IMG_URL($experince_media[0]);?>" data-lightbox="gallery">
                <?= LazyLoad::widget(['src' => (($experince_media[0]!='')?(Utils::IMG_URL($experince_media[0])):'no-image'),'options'=>[
                    'class'=>'img-responsive',
                    'alt'=>'Slider Image'
                ] ]); ?>
            </a>
        </div>
        <div class="exp_column exp_column_two">
            <a href="<?= Utils::IMG_URL($experince_media[1]);?>" data-lightbox="gallery">
                <?= LazyLoad::widget(['src' => (($experince_media[1]!='')?(Utils::IMG_URL($experince_media[1])):'no-image'),'options'=>[
                    'class'=>'img-responsive',
                    'alt'=>'Slider Image'
                ] ]); ?>
            </a>
        </div>
        <div class="exp_column_third">
            <div class="exp_inner_column">
                <a href="<?= Utils::IMG_URL($experince_media[2]);?>" data-lightbox="gallery">
                    <?= LazyLoad::widget(['src' => (($experince_media[2]!='')?(Utils::IMG_URL($experince_media[2])):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>'Slider Image'
                    ] ]); ?>
                </a>
            </div>
            <div class="exp_inner_column">
                <a href="<?= Utils::IMG_URL($experince_media[3]);?>" data-lightbox="gallery">
                    <?= LazyLoad::widget(['src' => (($experince_media[3]!='')?(Utils::IMG_URL($experince_media[3])):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>'Slider Image'
                    ] ]); ?>
                </a>
            </div>
        </div>
        <div class="exp_column exp_column_four">
            <a href="<?= Utils::IMG_URL($experince_media[4]);?>" data-lightbox="gallery">
                <?= LazyLoad::widget(['src' => (($experince_media[4]!='')?(Utils::IMG_URL($experince_media[4])):'no-image'),'options'=>[
                    'class'=>'img-responsive',
                    'alt'=>'Slider Image'
                ] ]); ?>
                <div class="exp_column_four-share">
                    <ul class="single-share-wishlisth">
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#shareIcon">
                                <i class="fa fa-share-square-o" aria-hidden="true"></i> Share</a>
                        </li>
                        <li>
                            <?php if(Yii::$app->user->isGuest){?>
                                <a href="<?= Url::to(['/login','ref'=>(Yii::$app->request->url)]);?>" >
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    Save
                                </a>

                            <?php }else{ ?>
                                <a href="javascript:void(0)" id="savedExp" class="<?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'saved_item_true':''; ?>"
                                   data-exp_id="<?= isset($experience_detail['id'])?$experience_detail['id']:0;?>">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <?= ( isset($experience_saved) && ( $experience_saved!=NULL) )?'<span>Saved</span>':'<span>Save</span>'; ?>
                                </a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </a>
        </div>
    </div>
</div>
<?php } ?>
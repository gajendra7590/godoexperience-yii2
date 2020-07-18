<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;

$user_photo = ( isset($model->profile_photo) && ($model->profile_photo!=''))?(Utils::IMG_URL($model->profile_photo)):(Url::to('@web/asset/images/icons/icn_rating_100.png'));
?>
 
<div class="vendor-list-m col-12 col-xs-6 col-md-6 col-lg-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="img_circle bg-orange">
                <span class="media-object"><?php echo Utils::getUserShortName($model); ?></span>
            </div>
            <h3 class="panel_title">
                <a href="<?= Url::to(['/vendors/detail?id='.$model->id]);?>" title="View Vendor Profile" class="cst-link"><?php echo ($model->first_name!='')?($model->first_name.' '.$model->last_name):$model->username; ?></a>
            </h3>
            <div class="rating_img_block">
                <img src="<?= Url::to('@web/asset/images/icons/icn_rating_100.png');?>" alt="Rating Image" class="mr-5"><span class="text_primary">100%</span>
            </div>
            <div class="inst_info">
                <div class="row">
                    <div class="col-xs-8 col-md-8 grid_view_col_12">
                        <div class="invest_info">
                            <p class="xs_title info_tile text-left">Incomplete Reviews</p>
                            <p class="xs_title info_tile text-left">Active Cases</p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4 grid_view_none">
                        <div class="invest_info">
                            <p class="xs_title1 info_tile text-center"><b>0</b></p>
                            <p class="xs_title1 info_tile text-center"><b>0</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
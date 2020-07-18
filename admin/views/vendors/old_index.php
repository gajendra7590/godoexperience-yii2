<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ManageUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendors List';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="Tble-cst--btn">
            <a href="<?= Url::to('vendors/create');?>" class="add_new_btn">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
            </a>
        </div>
    </div>
    <!-- Exp user Info Area Start-->
    <div class="exp__user--info">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'',
            'options' => [
                'tag' => 'div',
                'class' => 'list-wrapper',
                'id' => 'list-wrapper',
            ],
            'layout' => "{items}<div class='list-view-pagination'>{pager}</div>",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_list_item',['model' => $model]);
            },
            'pager' => [
                'class' => '\yii\widgets\LinkPager',
                'prevPageLabel'    => '<i class="fa fa-angle-left"></i>',
                'nextPageLabel'    => '<i class="fa fa-angle-right"></i>',
                'firstPageLabel'   => false,
                'lastPageLabel'    => false,
                'nextPageCssClass' => 'cst_arrow next',
                'prevPageCssClass' => 'cst_arrow prev',
                'firstPageCssClass'=> 'first',
                'lastPageCssClass' => 'last',
                'maxButtonCount'   => 5,
                'options' =>  [
                    'class' => 'pagination pagination_block',
                ]
            ],
        ]); ?>

    </div>
</div>


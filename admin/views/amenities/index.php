<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AmenitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Amenities List';
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <section class="feture_Tble-cst">
            <div class="row">
                <div class="col-sm-12">
                    <div class="Tble-cst--btn">
                        <a href="<?= Url::to(['/amenities/create']);?>" class="add_new_btn">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                        </a>
                    </div>

                    <?php  echo $this->render('_search', ['model' => $searchModel,'categories'=>$categories]); ?>

                    <div class="table-outer">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' =>['class' => 'table amenities_table'],
                            'layout' => "<div class='table-responsive'>{items}</div><div class='grid-view-pagination'>{pager}</div>",
                            'summary'=>'',
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
                            'columns' => [
                                [
                                    'label' => 'ICON',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return '<i class="fa '.$data->icon.' fa-3x" aria-hidden="true"></i>';
                                    }
                                ],
                                [
                                    'label' => 'Category',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->category->name)?$data->category->name:'';
                                    }
                                ],
                                [
                                    'label' => 'Title',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->title)?$data->title:'';
                                    }
                                ],
                                [
                                    'label' => 'Description',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->description)?'<div class="amen_desc">'.$data->description.'</div>':'';
                                    }
                                ],
                                [
                                    'label' => 'Status',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if($data->status == '1'){
                                            return '<span class="active__Status"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                        ';
                                        }else{
                                            return '<span class="unactive__Status"><i class="fa fa-circle" aria-hidden="true"></i></span>';
                                        }

                                    }
                                ],
                                [
                                    'label' => 'Created At',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return ($data->updated_at!=NULL)?date('M d Y',strtotime($data->updated_at)):'';
                                    }
                                ] ,
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => '',
                                    'contentOptions' => ['style' => 'width: 10%'],
                                    'template' => '{delete} {edit}',
                                    'buttons'=>[
                                        'delete'=>function ($url, $model, $key) {
                                            return Html::tag('a', '<i class="fa fa-trash-o" aria-hidden="true"></i>',
                                                [
                                                    'class' => 'Tble-edit Tble-deleted',
                                                    'data-pjax' => 0,
                                                    'data-method' => 'post',
                                                    'data-confirm' => 'Are you sure you want to archive this item?',
                                                    'href'=> Url::to('amenities/delete?id='.$model->id),
                                                ]
                                            );
                                        },
                                        'edit'=>function ($url, $model, $key) {
                                            return Html::tag('a', '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',
                                                [
                                                    'class' => 'Tble-edit',
                                                    'href'=> Url::to('amenities/update?id='.$model->id),
                                                ]
                                            );
                                        },
                                    ],
                                ]
                            ]
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
        </section>
    </div>
</div>


<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExperiencesOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders/Booking List';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    yii\bootstrap\Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'orderDetailModal',
        'size' => 'modal-lg',
//        'header' => '<h4>Order Summary</h4>',
        'closeButton' => [
            'tag'   => 'button',
            'label' => '<span aria-hidden="true"><img src="asset/images/icons/close-icn-popup.png" alt="close icn" /></span>'
        ],
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <section class="feture_Tble-cst">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-outer">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' =>['class' => 'table'],
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
                                    'label' => '#',
                                    'class' => 'yii\grid\DataColumn',
//                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return $data->id;
                                    }
                                ],
                                [
                                    'label' => 'User',
                                    'class' => 'yii\grid\DataColumn',
                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if($data->user->profile_photo!=NULL){
                                            return '<div class="media feture_Tble-user">
                                                    <div class="media-left">
                                                    <div class="img_circle">
                                                        <span class="media-object">
                                                        '.Html::img(Utils::IMG_URL($data->user->profile_photo),['onerror'=>"this.src = $(this).attr('altSrc')",'altSrc'=>Url::to('@web/asset/images/icons/upload_img.png')]).'                                                                     
                                                        </span>
                                                    </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="media-heading">'.$data->user->first_name.'</span>
                                                    </div>
                                                </div>';
                                        }else{
                                            return '<div class="media feture_Tble-user table-icon-name">
                                                    <div class="media-left">
                                                        <div class="img_circle bg-orange">
                                                            <span class="media-object">'.Utils::getUserShortName($data->user).'</span>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="media-heading">'.$data->user->first_name.'</span>
                                                    </div>
                                                </div>';
                                        }
                                    },
                                ],
                                [
                                    'label' => 'Experiece',
                                    'class' => 'yii\grid\DataColumn',
//                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if($data->experience->experiences_image_url!=NULL){
                                            return '<div class="media feture_Tble-user">
                                                    <div class="media-left">
                                                    <div class="img_circle">
                                                        <span class="media-object">
                                                        '.Html::img(Utils::IMG_URL($data->experience->experiences_image_url),['onerror'=>"this.src = $(this).attr('altSrc')",'altSrc'=>Url::to('@web/asset/images/icons/upload_img.png')]).'                                                                     
                                                        </span>
                                                    </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="media-heading">'.(substr($data->experience->title,0,30)).'...'.'</span>
                                                    </div>
                                                </div>';
                                        }else{
                                            return '<div class="media feture_Tble-user table-icon-name">
                                                    <div class="media-left">
                                                        <div class="img_circle bg-orange">
                                                            <span class="media-object">'.substr($data->experience->title,0,1).'</span>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="media-heading">'.(substr($data->experience->title,0,30)).'...'.'</span>
                                                    </div>
                                                </div>';
                                        }
                                    },
                                ],
                                [
                                    'label' => 'Total Guest',
                                    'class' => 'yii\grid\DataColumn',
//                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return ($data->total_guest_adults+$data->total_guest_children+$data->total_guest_infants);
                                    }
                                ],
                                [
                                    'label' => 'Total Pay',
                                    'class' => 'yii\grid\DataColumn',
//                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return Utils::cc().$data->net_pay;
                                    }
                                ],
                                [
                                    'label' => 'Start Date',
                                    'class' => 'yii\grid\DataColumn',
//                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return date('F, d Y',strtotime($data->experience_start_date));
                                    }
                                ],
                                [
                                    'label' => 'End Date',
                                    'class' => 'yii\grid\DataColumn',
//                                    'contentOptions' => ['style' => 'width: 1%'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return date('F, d Y',strtotime($data->experience_end_date));
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
                                    'template' => '{view}',
                                    'buttons'=>[
                                        'view'=>function ($url, $model, $key) {
                                            return Html::tag('a', ' <i class="fa fa-eye" aria-hidden="true"></i>                                                ',
                                                [
                                                    'class' => 'Tble-edit Table-avil viewOrderSummary',
                                                    'title' => 'Manage Experience schedule',
                                                    'href'=> Url::to(['/orders/view-order-summary','id' => $model->id]),
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
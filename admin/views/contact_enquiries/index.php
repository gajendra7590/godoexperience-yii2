<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\helpers\Utils;


$this->title = 'Contact Enquiries';
?>

<?php
    yii\bootstrap\Modal::begin([
        'headerOptions' => ['id' => 'contactEnquiryModalHeader'],
        'id' => 'contactEnquiryModal',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='contactModalContent'></div>";
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
                            'tableOptions' =>['class' => 'table contact_enquiries_table'],
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
                                    'label' => 'Contact Name',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->contact_name)?$data->contact_name:'';
                                    }
                                ],
                                [
                                    'label' => 'Contact Phone',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->contact_phone)?$data->contact_phone:'';
                                    }
                                ],
                                [
                                    'label' => 'Contact Email',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->contact_email)?$data->contact_email:'';
                                    }
                                ],
                                [
                                    'label' => 'Message',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return isset($data->contact_message)?'<div class="amen_desc" data-toggle="tooltip" data-placement="top" title="'.$data->contact_message.'">'.(substr($data->contact_message,0,49).'...').'</div>':'';
                                    }
                                ],
                                [
                                    'label' => 'Contact Time',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return ($data->contact_time!=NULL)?date('Y-m-d h:i:s',strtotime($data->contact_time)):'';
                                    }
                                ],
                                [
                                    'label' => 'Reply Status',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return (($data->is_reply==1)?'<span class="btn btn-success btn-xs btn-pill">Yes</span>':'<span class="btn btn-danger btn-xs btn-pill">No</span>');
                                    }
                                ],
                                [
                                    'label' => 'Reply Time',
                                    'class' => 'yii\grid\DataColumn',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return ($data->reply_time!=NULL)?date('Y-m-d h:i:s',strtotime($data->reply_time)):'--';
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => '',
                                    'contentOptions' => ['style' => 'width: 10%'],
                                    'template' => '{view} {reply}',
                                    'buttons'=>[
                                        'view'=>function ($url, $model, $key) {
                                            if($model->is_reply == 0){ return false; }else {
                                                return Html::tag('a', '<i class="fa fa-eye" aria-hidden="true"></i> View',
                                                    [
                                                        'class' => 'Tble-edit Tble-deleted contactReplyPreview',
                                                        'title' => 'View replied message',
                                                        'href' => 'javascript:void(0)',
                                                        'data-preview' => Url::to(['/contact-enquiries/reply-preview', 'id' => $model->id])
                                                    ]
                                                );
                                            }
                                        },
                                        'reply'=>function ($url, $model, $key) {
                                            if($model->is_reply == 1){ return false; }else {
                                                return Html::tag('a', '<i class="fa fa-reply" aria-hidden="true"></i> Reply',
                                                    [
                                                        'class' => 'Tble-edit contactReply',
                                                        'title' => 'Reply to : ' . $model->contact_email,
                                                        'href' => 'javascript:void(0)',
                                                        'data-reply' => Url::to(['/contact-enquiries/reply?id=' . $model->id])
                                                    ]
                                                );
                                            }
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


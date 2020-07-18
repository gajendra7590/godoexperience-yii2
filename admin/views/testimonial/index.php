<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExperienceCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 
$this->title = 'Testimonials';
$this->params['breadcrumbs'][] = $this->title;
?> 
 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <section class="feture_Tble-cst">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="Tble-cst--btn">
                                    <a href="<?= Url::to('testimonial/create');?>" class="add_new_btn">
                                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                                    </a>
                               </div>
                            <div class="table-outer">
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
                                        'contentOptions' => ['style' => 'width: 6%'],
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            if($data->client_image!=NULL){
                                                return '<div class="media feture_Tble-user">
                                                            <div class="media-left">
                                                            <div class="img_circle">
                                                                <span class="media-object">
                                                                '.Html::img(Utils::IMG_URL($data->client_image),['onerror'=>"this.src = $(this).attr('altSrc')",'altSrc'=>Url::to('@web/asset/images/icons/upload_img.png')]).'                                                                     
                                                                </span>
                                                            </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="media-heading">'.$data->client_name.'</span>
                                                            </div>
                                                        </div>';
                                            }else{ 
                                                return '<div class="media feture_Tble-user table-icon-name">
                                                            <div class="media-left">
                                                                <div class="img_circle bg-orange">
                                                                    <span class="media-object">'.substr($data->client_name,0,1).'</span>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="media-heading">'.$data->client_name.'</span>
                                                            </div>
                                                        </div>'; 
                                            }                                
                                          },
                                      ],
                                      [
                                        'label' => 'Client Name',
                                        'class' => 'yii\grid\DataColumn',
                                        // 'contentOptions' => ['style' => 'width: 6%'],
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return $data->client_name;
                                         }
                                      ],
                                      [
                                        'label' => 'Client Profession',
                                        'class' => 'yii\grid\DataColumn',
                                        // 'contentOptions' => ['style' => 'width: 6%'],
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return $data->client_position;
                                         }
                                      ],
                                        
                                      [
                                        'label' => 'Created Date',
                                        'class' => 'yii\grid\DataColumn',
                                        // 'contentOptions' => ['style' => 'width: 6%'],
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return ($data->updated_at!=NULL)?date('M d Y',strtotime($data->updated_at)):'';
                                        }
                                      ] ,                                     
                                      [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => '',
                                        // 'contentOptions' => ['style' => 'width: 10%'],
                                        'template' => '{delete} {edit}',
                                        // <a href="#" class="cst-link Table-view"> <i class="fa fa-eye" aria-hidden="true"></i> view</a>
                                        'buttons'=>[
                                            'delete'=>function ($url, $model, $key) {  
                                                return Html::tag('a', '<i class="fa fa-trash-o" aria-hidden="true"></i>',
                                                    [
                                                    'class' => 'Tble-edit Tble-deleted',
                                                    'data-pjax' => 0,
                                                    'title' => 'Delete Testimonial',
                                                    'data-method' => 'post',
                                                    'data-confirm' => 'Are you sure you want to delete this item?',
                                                    'href'=> Url::to('testimonial/delete?id='.$model->id),                                                                     
                                                    ]
                                                ); 
                                            },
                                            'edit'=>function ($url, $model, $key) {
                                                return Html::tag('a', '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',
                                                        [
                                                        'class' => 'Tble-edit',
                                                        'title' => 'Edit Testimonial',
                                                        'href'=> Url::to('testimonial/update?id='.$model->id),  
                                                        ]
                                                    ); 
                                            },
                                         ],
                                      ]
                                ]
                            ]); ?>  
                            </div> 
                    </div>
                </section>
            </div>
        </div> 

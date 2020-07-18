<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExperienceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 
$this->title = 'Experiences List';
$this->params['breadcrumbs'][] = $this->title;
?> 
 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <section class="feture_Tble-cst">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="Tble-cst--btn">
                                    <a href="<?= Url::to(['/experiences/create']);?>" class="add_new_btn">
                                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                                    </a>
                               </div>
                            <?php  echo $this->render('_search', ['model' => $searchModel,'categories'=>$categories]); ?>
                            <div class="table-outer">
                            <?php Pjax::begin(); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,                                 
                                'layout' => "<div class='table-responsive'>{items}</div><div class='grid-view-pagination'>{pager}</div>",
                                'tableOptions' =>['class' => 'table exp-list-table','id'=>'test_table'],
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
                                        'label' => 'Image',
                                        'class' => 'yii\grid\DataColumn',
                                        'contentOptions' => ['style' => 'width: '],
                                        'format' => 'raw',
                                        'value' => function ($data) {                                             
                                            if($data->experiences_image_url!=NULL){
                                                return '<div class="media feture_Tble-user">
                                                            <div class="media-left">
                                                                <div class="img_circle">
                                                                    <span class="media-object">
                                                                    '.Html::img(Utils::IMG_URL($data->experiences_image_url),['onerror'=>"this.src = $(this).attr('altSrc')",'altSrc'=>Url::to('@web/asset/images/icons/upload_img.png')]).'                                                                     
                                                                    </span>
                                                                </div>
                                                            </div> 
                                                        </div>';
                                            }else{ 
                                                return '<div class="media feture_Tble-user table-icon-name">
                                                            <div class="media-left">
                                                                <div class="img_circle bg-orange">
                                                                    <span class="media-object">'.Utils::getExperienceName($data).'</span>
                                                                </div>
                                                            </div> 
                                                        </div>'; 
                                            }                                
                                          },
                                      ],
                                      [
                                        'label' => 'Experience Name',
                                        'class' => 'yii\grid\DataColumn',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return ($data->title!='')?$data->title:'--';
                                         }
                                      ], 
                                      [
                                        'label' => 'Category',
                                        'class' => 'yii\grid\DataColumn',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return ( isset($data->category->name) && ($data->category->name!='') )?$data->category->name:'--';
                                         }
                                      ],                            
                                      [
                                        'label' => 'Featured',
                                        'class' => 'yii\grid\DataColumn', 
                                        'format' => 'raw',
                                        'visible' => (Yii::$app->user->identity->role_id == 1)?true:false,
                                        'value' => function ($data) {
                                            return ($data->featured=='1')?'<span class="active__Status" title="Featured"><i class="fa fa-check" aria-hidden="true"></i></span>
                                            ':'<span class="unactive__Status" title="Not Featured"><i class="fa fa-times" aria-hidden="true"></i>
                                            </span>';
                                        }
                                      ] ,                                        
                                      [
                                        'label' => 'Created By',
                                        'class' => 'yii\grid\DataColumn',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return ( isset($data->user->first_name) && ($data->user->first_name!='') )?$data->user->first_name:'--';
                                         }
                                      ],      
                                      [
                                        'label' => 'Status',
                                        'class' => 'yii\grid\DataColumn',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            if($data->status == '1'){
                                                return '<span class="active__Status" title="Active"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                ';
                                            }else{
                                                return '<span class="unactive__Status" title="InActive"><i class="fa fa-circle" aria-hidden="true"></i></span>';
                                            }
                                            
                                         }
                                      ],
                                      [
                                        'label' => 'Last Updated',
                                        'class' => 'yii\grid\DataColumn',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return ($data->updated_at!=NULL)?date('M d Y',strtotime($data->updated_at)):'';
                                        }
                                      ] ,                                     
                                      [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => '',
                                        'template' => '{delete} {edit} {avaliable}',
                                        // <a href="#" class="cst-link Table-view"> <i class="fa fa-eye" aria-hidden="true"></i> view</a>
                                        'buttons'=>[
                                            'delete'=>function ($url, $model, $key) {  
                                                return Html::tag('a', '<i class="fa fa-trash-o" aria-hidden="true"></i> ',
                                                    [
                                                    'class' => 'Tble-edit Tble-deleted',
                                                    'data-pjax' => 0,
                                                    'title' => 'Archieved Experience',
                                                    'data-method' => 'post',
                                                    'data-confirm' => 'Are you sure you want to archive this item?',
                                                    'href'=> Url::to(['/experiences/delete','id'=>$model->id]),
                                                    ]
                                                ); 
                                            },
                                            'edit'=>function ($url, $model, $key) {
                                                return Html::tag('a', '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ',
                                                        [
                                                        'class' => 'Tble-edit',
                                                        'title' => 'Edit Experience',
                                                        'href'=> Url::to(['/experiences/update','id'=>$model->id]),
                                                        ]
                                                    ); 
                                            },
                                            'avaliable'=>function ($url, $model, $key) {
                                                return Html::tag('a', ' <i class="fa fa-calendar" aria-hidden="true"></i>                                                 ',
                                                        [
                                                        'class' => 'Tble-edit Table-avil',
                                                        'title' => 'Manage Experience schedule',
                                                        'href'=> Url::to(['/experiences/manage-availability','id'=>$model->id]),
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

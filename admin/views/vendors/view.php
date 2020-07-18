<?php

use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;

/* @var $this yii\web\View */
/* @var $model common\models\ManageUser */

$this->title = 'Vendor Profile';
$this->params['breadcrumbs'][] = ['label' => 'Vendors Info', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$img_url = ($model->profile_photo!='')?(Utils::IMG_URL($model->profile_photo)):Url::to('@web/asset/images/icons/upload_img.png');

?>
<section class="exp__view--cst">
<div class="exp__Frm--ele">
    <div class="exp__Frm--title">
        <h3>Vendor Profile</h3>
        <ul class="edit_btn">
            <li>
                <a href="javascript:void(0)" class="add_new_btn">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    followers <span>(<?php echo $followers;?>)</span>
                </a>
                </li>
                <li>
                <a href="javascript:void(0)" class="add_new_btn btn-secondary">
                    <i class="fa fa-users" aria-hidden="true"></i> 
                    following <span>(<?php echo $following;?>)</span>
                </a>
                </li>
            <li>
                <a href="<?= Url::to(['/experiences','vendor'=>$model->id]);?>" class="add_new_btn">
                    <i class="fa fa-user-circle" aria-hidden="true"></i> 
                    Experience <span>(<?php echo $experiences;?>)</span>
                </a>
                </li>
            <li>
            <a href="<?= Url::to(['/vendors/update?id='.$model->id]);?>" class="add_new_btn">
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit 
            </a>
                </li>
        </ul>
    </div>
    <!-- exp view content start -->
    <div class="exp__view--contetn">
        <div class="row">
            <!-- Exp user Img start -->
            <div class="col-lg-2">
                <div class="exp__Img--user">
                    <img src="<?= $img_url;?>" alt="vendor image" />     
                </div>
            </div>
            <!-- Exp user Img closed -->
            <div class="col-lg-10">
                <!-- exp view list start -->
                <div class="exp__view--list">
                        <div class="clearfix"></div>
                    <!-- row block start -->
                    <div class="row">
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>First Name</h4>
                                    <p><?= ($model->first_name)?$model->first_name:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Middle Name</h4>
                                    <p><?= ($model->middle_name)?$model->middle_name:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                        <h4>Last Name</h4>
                                        <p><?= ($model->last_name)?$model->last_name:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Username</h4>
                                    <p><?= ($model->username)?$model->username:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Email</h4>
                                    <p><?= ($model->email)?$model->email:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Password</h4>
                                    <p>-</p>
                                </div>
                            </div> 
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Phone Office</h4>
                                    <p><?= ($model->phone_office)?$model->phone_office:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Phone Home</h4>
                                    <p><?= ($model->phone_home)?$model->phone_home:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Country</h4>
                                    <p><?= ($model->country)?$model->country:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>State</h4>
                                    <p><?= ($model->state)?$model->state:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>City</h4>
                                    <p><?= ($model->city)?$model->city:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Zip</h4>
                                    <p><?= ($model->zip)?$model->zip:'--'; ?></p> 
                                </div>
                            </div> 
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Gender</h4>
                                    <p><?= ($model->gender)?$model->gender:'--'; ?></p>
                                </div>
                            </div>
                            <div class="col-mbile col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="exp__view--item">
                                    <h4>Status</h4>
                                    <?php if($model->status == '1') { ?>
                                      <p><span class="active__Status"><i class="fa fa-circle" aria-hidden="true"></i> Active</span></p>
                                    <?php }else {?>
                                      <p><span class="unactive__Status"><i class="fa fa-circle" aria-hidden="true"></i> In Active</span></p>
                                    <?php } ?>  
                                </div>
                            </div>
                </div>
                <!-- exp view list start -->
            </div>
        </div> 
    </div>
    <!-- exp view content closed -->
</div>
</div>  
</section>

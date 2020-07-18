<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Change Your Password';
$this->params['breadcrumbs'][] = ['label' => 'Change Your Password', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="change_Psw">
    <!-- Edit add_new_client section -->
    <div class="exp__Frm--ele">
        <div class="exp__Frm--title">
            <!-- <h3>Change Your Password</h3> -->
        </div> 
        <div class="experience-categories-form"> 
            <?php $form = ActiveForm::begin(); ?>      
               <!-- row block -->
                <div class="row"> 
                    <div class="col-sm-12 col-lg-12">
                    <?= $form->field($model, 'oldPassword')->passwordInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Current Password']) ?> 
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-12 col-lg-12">
                        <?= $form->field($model, 'newPassword')->passwordInput(['class'=>'form-control input_modifier','placeholder'=>'Enter New Password']) ?>
                    </div>
                </div>
                <div class="row">     
                    <div class="col-sm-12 col-lg-12">
                        <?= $form->field($model, 'cNewPassword')->passwordInput(['class'=>'form-control input_modifier','placeholder'=>'Enter Confirm New Password']) ?>
                    </div>      
                </div>  
            <!--End row block -->           
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="exp__Frm--btn-left text-center">
                            <?= Html::submitButton('Change Password', ['class' => 'btn btn_primary cst_btn mr-10']) ?>
                            <a href="<?= Url::to(['/dashboard']); ?>" class="btn btn-secondary cst_btn">Cancel</a>
                        </div>
                    </div>
                </div>
            <!--End row block --> 
            <?php ActiveForm::end(); ?>
        </div> 
    </div>
    <!-- Edit add_new_client section -->
</section>
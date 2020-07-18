<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils; 
$this->title = 'Manage Availability';
$this->params['breadcrumbs'][] = $this->title;
?> 

<!-- Corona Event List Start -->
<section class="corona-frm--cst">
<div class="exp__Frm--ele">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6">
        <!-- Corona Ele Start -->
        <div class="corona_ele">
            <!-- Corona Frm Start -->
            <div class="corona-frm">
                <div class="row">
                    <form>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                            <input type="hidden" name="experience_id" value="<?php echo $model->id;?>" id="experience_id">
                            <input type="hidden" name="date_save_url" value="<?php echo Url::to(['/experiences/save-revoke-date?id='.$model->id]);?>" id="date_save_url">
                            <div class="corona-month">
                                <label class="label_modifier">Year <sub>*</sub></label>
                                <select class="form-control input_modifier select_mod" id="select_year">
                                    <optgroup label="---- Select Year ----"> 
                                        <?php foreach(Utils::getYears() as $year){ ?>
                                            <option value="<?php echo $year;?>" <?php if($year == date('Y')) echo"selected='selected'"; ?>><?php echo $year;?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                            <div class="corona-day">
                                <label class="label_modifier">Month <sub>*</sub></label>
                                <select class="form-control input_modifier select_mod" id="select_month">
                                    <optgroup label="---- Select Month ----">
                                        <?php foreach(Utils::getYearsMonth() as $k => $month){ ?>
                                            <option value="<?php echo $k;?>" <?php if($k == date('m')) echo"selected='selected'"; ?>><?php echo $month;?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Corona Frm Closed -->
            <!-- Dynamic append calendar here -->
            <div id="calendar_container"></div>
            
        </div>
        <!-- Corona Ele Closed -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6"></div>
</div>
</div>
</section>
<!-- Corona Event List Closed --> 
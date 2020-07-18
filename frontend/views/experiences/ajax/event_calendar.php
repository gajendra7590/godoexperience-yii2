<?php 
use yii\helpers\Url;
use common\helpers\Utils;

$days_list = Utils::getDaysList();
$month_first_day = Utils::getFirstDayMonth($month,$year);

$prev_month = ($month == 1)?12:($month-1);
$prev_year = ($month == 1)?($year-1):($year);

$next_month = ($month == 12)?1:($month+1);
$next_year = ($month == 12)?($year+1):($year);

$pre_month_total_days = cal_days_in_month(CAL_GREGORIAN,$prev_month,$prev_year);
$prev_month_start = ($pre_month_total_days - $month_first_day);

$this->title = 'Experiences - Events Book';
?>
<div class="corona_ele-list">
    <div class="corona_ele-title">
        <h4><?= date('F - Y',strtotime($year.'-'.$month.'-01'));?></h4>
        <div class="corona_ele-arrow">
            <span class="corona_ele-lft eventsSwitch"
                  data-action="back"
                  data-month="<?=str_pad($prev_month, 2, 0, STR_PAD_LEFT);?>"
                  data-year="<?= str_pad($prev_year, 2, 0, STR_PAD_LEFT);?>
             ">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </span>
            <span class="corona_ele-rght eventsSwitch"
                  data-action="next"
                  data-month="<?= str_pad($next_month, 2, 0, STR_PAD_LEFT);?>"
                  data-year="<?= str_pad($next_year, 2, 0, STR_PAD_LEFT);?>
             ">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </span>
        </div>
    </div>
    <!-- Corona Ele Day Area Start -->
    <div class="corona_ele-day">
        <?php foreach($days_list as $day){ ?>
        <div class="corona_ele-item">
            <div class="corona_nme-day">
                <?= $day;?>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Corona Ele Day Area Closed -->
    <?php 
          for($i=1;$i < $month_first_day;$i++){ ?>
        <div class="corona_ele-item eventsSwitch"
             data-action="back"
             data-date="<?= str_pad((($prev_month_start+$i)+1), 2, 0, STR_PAD_LEFT);?>"
             data-month="<?=str_pad($prev_month, 2, 0, STR_PAD_LEFT);?>"
             data-year="<?= str_pad($prev_year, 2, 0, STR_PAD_LEFT);?>">
             <div class="corona_ele-mod"><?= ($prev_month_start+$i)+1; ?></div>
        </div>
    <?php } ?>


    <!-- Corona Ele Day Area Closed -->
    <?php if(isset($days_in_month)){
      for($i=1;$i <= $days_in_month;$i++){
      $c = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
    ?>
        <div class="corona_ele-item">
            <div class="corona_ele-mod
                 <?php echo ( (in_array($i,$dates)) )?'corona_Active':'corona_Disabled';?>
                 <?php echo ( (in_array($i,$dates)) && ($c < date('Y-m-d')) )?'corona_Disabled':'';?>"
                 data-date="<?= str_pad($i, 2, 0, STR_PAD_LEFT);?>"
                 data-month="<?=str_pad($month, 2, 0, STR_PAD_LEFT);?>"
                 data-year="<?= str_pad($year, 2, 0, STR_PAD_LEFT);?>"
            ><span><?php echo $i;?></span></div>
        </div>
    <?php }} ?>

</div>
<?php 
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use common\helpers\Utils;  
    
    $year = ( isset($params['year']) && $params['year'] > 0 )?$params['year']:date('Y');
    $month = ( isset($params['month']) && $params['month'] > 0 )?(Utils::getMonthName($params['month'])):date('M');
    $current_month = ( isset($params['month']) && $params['month'] > 0 )?($params['month']):date('m');
    //echo $month;
    //echo Utils::getMonthName( ($params['month'] - 1) );
    $last_month_name = ( isset($params['month']) && $params['month'] > 0 )?(Utils::getMonthName( $params['month'] - 1 )):date('M',strtotime('-1 month')); 
   // echo date('M',strtotime('-1 month'));

   //echo $last_month_name;
    
    //For show empty days
    $month_first_day = Utils::getFirstDayMonth((($params['month'] > 0 )?$params['month']:date('m')),(($params['year'] > 0 )?$params['year']:date('Y'))); 
    $num_days_last_month = Utils::numOfDaysInMonth( (($params['month'] > 0 )?$params['month']:date('m')),(($params['year'] > 0 )?$params['year']:date('Y'))  );
    $last_month_prev_dates = ( $num_days_last_month - ($month_first_day-1) );  
    $days_list = Utils::getDaysList(); 

?>       


<!-- Corona list Area Start -->
<div class="corona_ele-list">
<div class="corona_ele-title">
    <h4>Choose Events Date : <?php echo $month .' - '.$year;?></h4>
    </div>

    <?php if($days_list){  ?> 
            <?php for($i = 1;$i <= count($days_list);$i++){ ?>
                <div class="corona_ele-item">
                    <div class="corona_nme-day" title=""><?php echo $days_list[$i];?></div>
                </div>  
            <?php }?>   
    <?php } ?>

    <?php if($month_first_day > 1){  for($i = 1;$i < $month_first_day;$i++){ ?>
        <div class="corona_ele-item">
            <div class="corona_ele-mod corona_Disable" title="<?php echo ($last_month_prev_dates + $i).' '.$last_month_name.' '.$year;?>">
                <span>
                    <?php echo $last_month_prev_dates + $i;?>
                </span>
            </div>
        </div>  
    <?php } } ?>

    <?php if( isset($days)){  
          for($i = 1;$i <= $days;$i++){ 

                $date_now = date("Y/m/d");
                $date = date("Y/m/d",strtotime("$year/$current_month/$i")); 
                $class = 'date_change_event';
                if ($date_now > $date) {
                   $class = 'corona_Disable';
                }  
              ?>  
            <div class="corona_ele-item">
                <div
                class="corona_ele-mod <?php echo $class;?> <?php echo (in_array($i,$available_dates))?'corona_Active':'';?>"
                data-active="<?php echo (in_array($i,$available_dates))?1:0;?>"
                data-value="<?php echo $i;?>"
                title="<?php echo $i.' '.$month.' '.$year;?>"
                ><span><?php echo $i;?></span></div>
            </div> 
     <?php }
      } ?>
</div>
<!-- Corona list Area Closed --> 
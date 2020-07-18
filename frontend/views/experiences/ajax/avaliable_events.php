<?php
use yii\helpers\Url;
use common\helpers\Utils;

$this->title = 'Experiences - Events Book';
?>

<?php if( isset($dates) && !empty($dates)){
foreach($dates as $k => $date){ ?>
    <div class="exp_package-item">
        <div class="exp_shwMod-title">
            <?= date('D, M d Y',strtotime($date['year'].'-'.$date['month'].'-'.$date['date']));?>
        </div>
        <div class="exp_package-ele">
            <div class="exp_package-mod">
                <div class="exp_package-prson"><?= Utils::cc().$exp_detail['price'];?> per person</div>
                <div class="exp_package-join">
                    <span class="exp_package-item1">You Can Join <?= ($exp_detail['group_size'] > 1 ? ($exp_detail['group_size'] - 1):0);?> other guests</span>
                    <span class="exp_package-item2">Hosted in <?= $exp_detail['country'];?></span>
                </div>
            </div>
            <div class="exp_package-chse">
                <button class="btn-secondary chooseEventDate" data-event_id="<?= $date['id'];?>" data-date="<?= $date['date'];?>" data-month="<?= $date['month'];?>" data-year="<?= $date['year'];?>" data-id="<?= $date['id'];?>" class="choose_event_date">Choose</button>
            </div>
        </div>
    </div>
<?php }} else { ?>
    <section class="no-exp-event">
        <div class="no-event-select myac-nomsg ">
            No booking date avaliable yet
        </div>
    </section>
<?php } ?>

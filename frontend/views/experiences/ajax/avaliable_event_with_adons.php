<?php
use yii\helpers\Url;
use common\helpers\Utils;
$pay_symbol = Utils::cc();

//echo '<pre>';print_r($event);die;
$this->title = 'Experiences - Events Booking';
?>

<div class="exp_package-item">
    <input type="hidden" value="<?= $event['id'];?>" id="selectedEvent">
    <div class="exp_shwMod-title">
        <?= date('D, M d Y',strtotime($event['year'].'-'.$event['month'].'-'.$event['date']));?>
    </div>
    <div class="exp_package-ele">
        <div class="exp_package-mod">
            <div class="exp_package-prson"><?= Utils::cc().$event['experiences']['price'];?> per person</div>
            <div class="exp_package-join">
                <span class="exp_package-item1">You Can Join <?= ($event['experiences']['group_size'] > 1 ? ($event['experiences']['group_size'] - 1):0);?> other guests</span>
                <span class="exp_package-item2">Hosted in <?= $event['experiences']['country'];?></span>
            </div>
        </div>
    </div>
    <div class="exp_adons_lists">
      <?php if(isset($event['experiences']['adons']) && (!empty($event['experiences']['adons']))){
          foreach ($event['experiences']['adons'] as $item){ ?>
                <div class="bking__item--select">
                    <div class="bking__item--title">
                        <?= (isset($item['name'])?$item['name']:'No Title');?>
                    </div>
                    <div class="bking__item--body">
                        <div class="bking__item--desc">
                            <?= (isset($item['description'])?$item['description']:'');?>
                        </div>
                        <div class="bking__item-doller">
                            <?= (isset($item['price'])?$pay_symbol.$item['price']:$pay_symbol.'0.00');?>/Person
                        </div>
                        <div class="bking__item-select" id="booking__Filp1">
                            <input type="hidden" data-id="<?=$item['id'];?>" class="cart_item_input_<?=$item['id'];?>" name="cartItem[]" value="0">
                            <a href="javascript:void(0)" id="list_adon_<?=$item['id'];?>" data-event_id="<?=$event['id'];?>" data-id="<?=$item['id'];?>" class="exp__Btn--primary adon_add_to_cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
        <?php }}?>
    </div>
</div>
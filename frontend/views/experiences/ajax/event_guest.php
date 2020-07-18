<?php
 use yii\helpers\Url;
 use common\helpers\Utils;
?>
<button class="guests-shw-toggle" type="button" id="total_guest">Guests</button>
<input type="hidden" value="<?=str_pad($month, 2, 0, STR_PAD_LEFT);?>" name="" id="current_month">
<input type="hidden" value="<?=$year;?>" name="" id="current_year">
<!--guests shw menu Start-->
<ul class="guests-shw-menu">
    <li>
        <div class="guests_menu-item">
            <div class="guests_menu-label">
                Adults
            </div>
            <div class="guests_menu-qty">
                <button type="button" class="qty-minus guestCalc" data-id="guestAdultsInput" data-action="minus" data-type="0">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input type="text" value="1" class="qty-num" id="guestAdultsInput">
                <button type="button" class="qty-plus guestCalc" data-id="guestAdultsInput" data-action="plus" data-type="0">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </li>
    <li>
        <div class="guests_menu-item">
            <div class="guests_menu-label">
                Children
            </div>
            <div class="guests_menu-qty">
                <button type="button" class="qty-minus guestCalc" data-id="guestChildrensInput" data-action="minus" data-type="1">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input type="text" value="0" class="qty-num" id="guestChildrensInput">
                <button type="button" class="qty-plus guestCalc" data-id="guestChildrensInput" data-action="plus" data-type="1">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </li>
    <li>
        <div class="guests_menu-item">
            <div class="guests_menu-label">
                Infants
            </div>
            <div class="guests_menu-qty">
                <button type="button" class="qty-minus guestCalc" data-id="guestInfantsInput" data-action="minus" data-type="2">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input type="text" value="0" class="qty-num" id="guestInfantsInput">
                <button type="button" class="qty-plus guestCalc" data-id="guestInfantsInput" data-action="plus" data-type="2">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </li>
    <div class="guests-shw-btn">
        <button class="guests_shw-clear" type="button">Clear</button>
        <button class="guests_shw-save" type="button">Save</button>
    </div>
</ul>
<!--guests shw menu Closed-->
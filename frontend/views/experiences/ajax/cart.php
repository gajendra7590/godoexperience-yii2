<?php
use yii\helpers\Url;
use common\helpers\Utils;
use ruskid\stripe\StripeCheckout;
//echo '<pre>';print_r($params);
//echo '<pre>';print_r($event['experiences']['adons']);
$pay_symbol = Utils::cc();
$price = (isset($event['experiences']['price'])?$event['experiences']['price']:0);
$adon_total = 0;
$total_guest = $params['total'];
if(isset($event['experiences']['adons'])){
    foreach ($event['experiences']['adons'] as $ad){
        if(in_array($ad['id'],$adons)) {
            $adon_total+=intval($ad['price']);
        }

    }
}

$total = (intval($price)+$adon_total);
$net_pay = (($total_guest * $total)*100);

$description = ($total_guest.' Guest '.$pay_symbol.' ('.$total_guest.'×'.($total).') = '.$pay_symbol.($total_guest * $total) );



?>
<div class="bking__Your--cart exp_cart_box">
    <h2>Your Cart</h2>
    <!-- Booking your cart item Area Start -->
    <div class="your__Cart--item">
        <h3>BOOKING FOR ( <?= date('F d,Y',strtotime($event['year'].'-'.$event['month'].'-'.$event['date']));?> )</h3>
        <ul>
            <li>
                <span class="cart_item_title">Price</span>
                <span class="cart_item_quantity"><?=$pay_symbol;?>(<?= $params['total'].'×'.($price );?>)</span>
                <span class="cart_item_value"> <?= $pay_symbol.($params['total'] * $price)?></span>
            </li>
                <?php if(isset($event['experiences']['adons']) && (!empty($event['experiences']['adons']))){
                    foreach ($event['experiences']['adons'] as $adon){
                    if(in_array($adon['id'],$adons)){
                 ?>
                <li>
                    <span class="cart_item_title"><?= $adon['name'];?></span>
                    <span class="cart_item_quantity"><?=$pay_symbol;?>(<?= $total_guest .'×'. $adon['price'] ?>)</span>
                    <span class="cart_item_value"><?= $pay_symbol.($adon['price'] * $total_guest);?></span>
                    <a href="javascript:void(0)" data-event_id="<?=$event['id'];?>" data-id="<?=$adon['id'];?>" class="remove-link adon_remove_to_cart_icon">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </li>
               <?php }}} ?>
            <li>
                <span class="cart_item_title">Net Pay </span>
                <span class="cart_item_quantity"></span>
                <span class="cart_item_value"><?=$pay_symbol;?><?=($total*$total_guest);?></span>
            </li>
        </ul>
        <!-- Payment Button Start-->
        <div id="payment_form_container_div">
            <?=
                StripeCheckout::widget([
                    'formOptions' => [
                    ],
                    'action' => Url::to(['/payment/payment-success?id='.$id]),
                    'amount' => $net_pay,
                    'stripeJs'=>'https://checkout.stripe.com/checkout.js?v='.rand(),
                    'currency' => 'USD',
                    'description' => $description,
                    'name' => ($event['experiences']['title'])?$event['experiences']['title']:'',
                    'label' => 'Book Now',
                    'userEmail' => isset(Yii::$app->user->identity->email)?Yii::$app->user->identity->email:'',
                    'collectBillingAddress' => false,
                    'class' => 'stripe-form-cls',
                    'image' => 'https://media.istockphoto.com/vectors/coming-soon-sign-isolated-on-white-background-retro-text-red-blue-vector-id926730928?b=1&k=6&m=926730928&s=612x612&h=FYcQuCIqDRUxHWyaAsopjE9_Xfc3g0mBUyr1ZYWBIzU=',
                ]);
            ?>
        </div>
        <!-- Payment Button End-->
    </div>
    <!-- Booking your cart item Area Closed -->
</div>
<?php die(); ?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad;

//echo '<pre>';print_r($pageData);die;
?>

<?php
//    Modal::begin([
//        'headerOptions' => ['id' => 'modalHeader'],
//        'id' => 'orderDetailModal',
//        'size' => 'modal-lg',
//        'closeButton' => [
//            'tag'   => 'button',
//            'label' => '<span aria-hidden="true"><img src="asset/images/icons/close-icn-popup.png" alt="close icn" /></span>'
//        ],
//        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
//    ]);
//    echo "<div id='modalContent'></div>";
//    Modal::end();
//?>
<div class="modal fade" id="orderDetailModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">
                        <img src="asset/images/icons/close-icn-popup.png" alt="close icn" />
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div id='modalContent'></div>
            </div>
        </div>

    </div>
</div>
<!--My Account Order list-->
<section class="myac-order-list">
    <div class="my-ac-title">
        <h3>Your Booking Experiences List</h3>
    </div>
    <div class="myac-order-content myaccount-table">
        <div class="table-responsive">
                <?php if( isset($pageData) && (!empty($pageData))){ ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th class="myac-exp-th">Experience</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Pay(USD)</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                   <?php foreach ($pageData as $order){
                        $status = 'completed';
                        $done = 1;
                        if( date('Y-m-d',strtotime($order['experience_end_date'])) >= date('Y-m-d')){
                            $status = 'active';
                            $done = 0;
                        }
                   ?>
                    <tr>
                        <td><?= $order['id'];?></td>
                        <td><?= $order['user']['first_name'].' '.$order['user']['last_name'];?></td>
                        <td title="<?= $order['experience']['title'];?>">
                          <div class="order-user">
                                <div id="exp_img">
                                    <img src="<?= Utils::IMG_URL($order['experience']['experiences_image_url']);?>" height="50" width="50">
                                </div>
                                <div id="exp_title">
                                    <?= $order['experience']['title'];?>
                                </div>
                          </div>
                        </td>
                        </td>
                        <td><?= date('M,d Y',strtotime($order['experience_start_date']));?></td>
                        <td><?= date('M,d Y',strtotime($order['experience_end_date']));?></td>
                        <td><?= Utils::cc().$order['net_pay'];?></td>
                        <td>
                            <span class="order-status-<?= $status;?>"><?= $status;?></span>
                        </td>
                        <td>
                            <a href="javascript:void(0);" data-toggle="tooltip" title="View Order Summary" data-order_id="<?= $order['id'];?>" class="btn_Primary btn__bg viewOrderDetail">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>

                            <?php if( ($order['totalGuest'] > 1) && ($done == 0) ){ ?>

                            <a href="javascript:void(0);" data-toggle="tooltip" title="Manage Guest Info : Who is comming" data-order_id="<?= $order['id'];?>" class="btn_Primary btn__bg manageGuestDetail">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </a>
                            <?php } ?>


                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
                <?php } else{ ?>
                    <div class="myac-nomsg">
                        <span>No item booked yet.</span>
                    </div>
                <?php } ?>

        </div>
    </div>
</section>
<!--My Account Order list-->
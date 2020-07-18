<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Dashboard';

$this->registerJsFile(
    '@web/js/dashboard.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<input type="hidden" id="BASE_URL" value="<?= Url::to(['/']);?>">
<input type="hidden" id="USER_ROLE" value="<?= Yii::$app->user->identity->role_id;?>">
<section id="card-counter-dash dash-filter">
    <span class="filter-note"> <b> Note : </b> Default data will be shown of current month</span>
    <div class="experiences-search dashboard-filter">
        <form action="" id="dashboar_widget_filter_form">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                    <input type="text" id="dashboard_from_date" readonly class="form-control input_modifier datepicker"
                           name="start_date" placeholder="Choose start date.." aria-required="true" aria-invalid="true">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                    <input type="text" id="dashboard_to_date" readonly class="form-control input_modifier datepicker"
                           name="end_date" placeholder="Choose end date.." aria-required="true" aria-invalid="true">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                <div class="form-group">
                    <button type="submit" class="btn btn_primary cst_btn mr-10">Search</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?php if( isset(Yii::$app->user->identity->role_id) && (Yii::$app->user->identity->role_id == '1') ){ ?>
<section id="card-counter-dash">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <a href="<?= Url::to(['/experiences']);?>" title="View Experiences List">
                <div class="card-counter primary">
                    <i class="fa fa-calendar"></i>
                    <span class="count-numbers total_count total_exp_count">
                        <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                    </span>
                    <span class="count-name">Experiences</span>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= Url::to(['/orders']);?>" title="View Orders List">
                <div class="card-counter danger">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="count-numbers total_count total_orders_count">
                        <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                    </span>
                    <span class="count-name">Orders</span>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= Url::to(['/clients']);?>" title="View Clients List">
                <div class="card-counter success">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers total_count total_users_count">
                        <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                    </span>
                    <span class="count-name">Clients</span>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= Url::to(['/vendors']);?>" title="View Vendors List">
                <div class="card-counter info">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers total_counts total_vendors_count">
                        <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                    </span>
                    <span class="count-name">Vendors</span>
                </div>
            </a>
        </div>
    </div>
</section>
<?php } else { ?>
<section id="card-counter-dash">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <a href="<?= Url::to(['/clients']);?>" title="View Clients List">
                <div class="card-counter success">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers total_count total_users_count">
                            <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                        </span>
                    <span class="count-name">Clients</span>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-6">
            <a href="<?= Url::to(['/vendors']);?>" title="View Vendors List">
                <div class="card-counter info">
                    <i class="fa fa-user"></i>
                    <span class="count-numbers total_counts total_vendors_count">
                            <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                        </span>
                    <span class="count-name">Vendors</span>
                </div>
            </a>
        </div>
    </div>
</section>
<?php } ?>
<!-- Chart Shown Below-->
<section id="dashboard_columns" class="dashboard_block">
    <div class="row">
        <?php if( isset(Yii::$app->user->identity->role_id) && (Yii::$app->user->identity->role_id == '2') ){ ?>
            <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard-item">
                    <h5>top 5  vendors by selling</h5>
                    <div id="topExperiencesByOrderContainer"></div>
                </div>
            </section>
        <?php } else { ?>
            <section class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                <div class="dashboard-item">
                    <h5>top 5  vendors by selling</h5>
                    <div id="topVendorContainer"></div>
                </div>
            </section>
            <section class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                <div class="dashboard-item">
                    <h5>top 5 experiences by order</h5>
                    <div id="topExperiencesByOrderContainer"></div>
                </div>
            </section>
        <?php } ?>
    </div>
</section>
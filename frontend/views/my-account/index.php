<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad;
$this->registerJsFile('@web/js/my_account.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'My Account';
?>
<main  class="my-ac-page">
    <!-- My ac Content-->
    <section class="my-ac-content">
        <div class="cst-breadcrumbs">
            <h1>my account</h1>
        </div>
        <input type="hidden" value="<?= Url::to(['/my-account']);?>" id="base_url">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <!-- My Ac list-->
                    <div class="my-ac-list">
                        <ul>
                            <li class="ac-list_Active mouseDisable"><a href="javascript:void(0);" data-page="profile" class="accountPage"><span>Profile</span></a></li>
                            <li><a href="javascript:void(0);" class="accountPage" data-page="change_password"><span>Change password</span></a></li>
                            <li><a href="javascript:void(0);" class="accountPage" data-page="orders"><span>order list</span></a></li>
                            <li><a href="javascript:void(0);" class="accountPage" data-page="wishlist"><span>wishlist</span></a></li>
                        </ul>
                    </div>
                    <!-- // My Ac list-->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <!-- My Ac Ele-->
                    <div id="containerMain">
                        <div class="overlayer-myac"></div>
                        <div class="loader-myac">
                            <span class="loader-inner-myac"></span>
                        </div>
                        <div class="myac-content-details" id="pageContainer">
                        </div>
                    </div>
                    <!-- // My Ac Ele-->
                </div>
            </div>
        </div>
    </section>
    <!-- // My ac Content-->
</main>


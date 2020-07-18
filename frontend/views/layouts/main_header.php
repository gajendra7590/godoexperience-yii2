<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;
?> 

<!-- Header Area Start -->
<header class="Header <?= (isset($this->params['header_bg'])?$this->params['header_bg']:'');?>">
    <nav class="navbar widget__Nav">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#goDOExprinc"> <span
                class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand widget__header--logo" href="<?= Url::to(['/']);?>" title="Go Do Experience"><img
                    src="<?= Url::to('@web/asset/images/icons/godo_logo.png');?>" alt="Go/Do Experience" class="img-responsive" /></a>
                    <?php if(!Yii::$app->user->isGuest){ ?>
                        <ul>
                            <li class="dropdown mobile_dropdown-user">
                                <a class="app-nav__item" href="javascript:void(0)" data-toggle="dropdown" aria-label="Show Profile">
                                    <i class="fa fa-user-circle-o fa-lg"></i>
                                </a>
                                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item menu-header" href="<?= Url::to(['/my-account']);?>">
                                            <div class="media">
                                                <div class="media-left user__icon--img">
                                                    <img src="<?= Url::to('@web/asset/images/icons/user.png');?>" class="media-object" alt="user" />
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media_title"><?= Utils::getUserName(Yii::$app->user->identity); ?></h5>
                                                    <span class="view_profile">View Profile</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list_title"><a href="javascript:void(0)">Personal Account</a></li>
                                    <li>
                                        <a class="dropdown-item" href="<?= Url::to(['/my-account']);?>">
                                            <i class="fa fa-user-circle-o"></i> My Account
                                        </a>
                                    </li>
                                    <li>
                                        <?= Html::beginForm(['/logout'], 'post'). Html::submitButton(
                                            '<i class="fa fa-sign-out fa-lg"></i> Logout',
                                            ['class' => 'dropdown-item']
                                        ). Html::endForm() ?> 
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    <?php }?>                         
                    </div>
                        <div class="collapse navbar-collapse" id="goDOExprinc">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">host a home</a></li>
                                <li><a href="#">host an experience</a></li>
                                <li><a href="<?= Url::to(['/contact-us']);?>">Help</a></li>
                                <?php if(!Yii::$app->user->isGuest){ ?>
                                <li class="dropdown deshktop_dropdown-user">
                                    <a class="app-nav__item" href="javascript:void(0)" data-toggle="dropdown" aria-label="Show Profile">
                                        <i class="fa fa-user-circle-o fa-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                                        <li>
                                            <a class="dropdown-item menu-header" href="<?= Url::to(['/my-account']);?>">
                                                <div class="media">
                                                    <div class="media-left user__icon--img">
                                                        <img src="<?= Url::to('@web/asset/images/icons/user.png');?>" class="media-object" alt="user" />
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media_title"><?= Utils::getUserName(Yii::$app->user->identity); ?></h5>
                                                        <span class="view_profile">View Profile</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list_title"><a href="javascript:void(0)">Personal Account</a></li>
                                        <li>
                                            <a class="dropdown-item" href="<?= Url::to(['/my-account']);?>">
                                                <i class="fa fa-user-circle-o"></i> My Account
                                            </a>
                                        </li>
                                        <li>
                                            <?= Html::beginForm(['/logout'], 'post'). Html::submitButton(
                                                '<i class="fa fa-sign-out fa-lg"></i> Logout',
                                                ['class' => 'dropdown-item']
                                            ). Html::endForm() ?> 
                                        </li>
                                    </ul>
                                </li>
                                <?php }?>
                                <?php if(Yii::$app->user->isGuest){ ?>
                                    <li><a href="<?= Url::to(['/register']);?>">sign up</a></li>
                                    <li><a href="<?= Url::to(['/login']);?>">log in</a></li>
                                <?php }?>
                           </ul>
                     </div>
        </div>
    </nav>
</header>
<!-- Header Area Closed --> 
<?php
use yii\helpers\Url;
?>
    <nav class="page-sidebar" data-pages="sidebar"> 
        <div class="sidebar-overlay-slide from-top" id="appMenu">
            <div class="row">
                <div class="col-xs-6 no-padding">
                    <a href="#" class="p-l-40"><img src="<?=Yii::$app->request->baseUrl;?>/assets/img/demo/social_app.svg" alt="socail"></a>
                </div>
                
                <div class="col-xs-6 no-padding">
                    <a href="#" class="p-l-10"><img src="<?=Yii::$app->request->baseUrl;?>/assets/img/demo/email_app.svg" alt="socail"></a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-40"><img src="<?=Yii::$app->request->baseUrl;?>/assets/img/demo/calendar_app.svg" alt="socail"></a>
                </div>
                <div class="col-xs-6 m-t-20 no-padding">
                    <a href="#" class="p-l-10"><img src="<?=Yii::$app->request->baseUrl;?>/assets/img/demo/add_more.svg" alt="socail"></a>
                </div>
            </div>
        </div>
 
        <div class="sidebar-header">
            <img src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" alt="logo" class="brand" data-src="<?=Yii::$app->request->baseUrl?>/assets/images/logo-white.png" data-src-retina="<?=Yii::$app->request->baseUrl?>/assets/images/logo-white.png" width="90" height="32">
            <div class="sidebar-header-controls">
                <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i></button>
                <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i></button>
            </div>
        </div>
         
        <div class="sidebar-menu">
            <ul class="menu-items">
                <li class="m-t-30 ">
                    <a href="<?=Url::to(['site/index'])?>" class="detailed">
                        <span class="title"><?=Yii::t('app','dashboard')?></span>
                    </a>
                    <span class="icon-thumbnail bg-success"><i class="pg-home"></i></span>
                </li>
                <li class="">
                    <a href="javascript:;"><span class="title"><?=Yii::t('app','catalog')?></span>
                    <span class="arrow"></span></a>
                    <span class="icon-thumbnail"><i class="pg-layouts"></i></span>
                        <ul class="sub-menu">
                            <li class=""><a href="<?=Url::to(['category/index'])?>"><?=Yii::t('app','category')?></a><span class="icon-thumbnail">C</span></li>
                            <li class=""><a href="<?=Url::to(['product/index'])?>"><?=Yii::t('app','product')?></a><span class="icon-thumbnail">P</span></li>
                            <li class=""><a href="<?=Url::to(['banner/index'])?>"><?=Yii::t('app','banner')?></a><span class="icon-thumbnail">B</span></li>
                            <li class=""><a href="<?=Url::to(['brand/index'])?>"><?=Yii::t('app','brand')?></a><span class="icon-thumbnail">BR</span></li>
                            <li class=""><a href="<?=Url::to(['page/index'])?>"><?=Yii::t('app','pages')?></a><span class="icon-thumbnail">BR</span></li>
                            <li class=""><a href="<?=Url::to(['newsletter/index'])?>"><?=Yii::t('app','newsletter')?></a><span class="icon-thumbnail">N</span></li>
                        </ul>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <span class="title"><?=Yii::t('app','transactions')?></span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i class="fa fa-exchange"></i></span>
                    <ul class="sub-menu">
                        <li class=""><a href="<?=Url::to(['order/index'])?>"><?=Yii::t('app','order')?></a><span class="icon-thumbnail">O</span></li>
                        <li class=""><a href="<?=Url::to(['discussion/index'])?>"><?=Yii::t('app','product discussion')?></a><span class="icon-thumbnail">D</span></li>
                    </ul>
                </li>
                
                <li class="">
                    <a href="javascript:;">
                        <span class="title"><?=Yii::t('app','shipping')?></span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i class="fa fa-map-marker"></i></span>
                    <ul class="sub-menu">
                        <li class=""><a href="<?=Url::to(['area/index'])?>"><?=Yii::t('app','shipping area')?></a><span class="icon-thumbnail">A</span></li>
                        <li class=""><a href="<?=Url::to(['courier/index'])?>"><?=Yii::t('app','shipping courier')?></a><span class="icon-thumbnail">C</span></li>
                    </ul>
                </li>
            
                <li class="">
                    <a href="javascript:;">
                        <span class="title"><?=Yii::t('app','administration')?></span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail "><i class="fa fa-wrench"></i></span>
                    <ul class="sub-menu">
                        <li class=""> <a href="<?=Url::to(['user/customer'])?>"><?=Yii::t('app','customer')?></a><span class="icon-thumbnail"><i class="fa fa-user"></i></span></li>
                        <li class=""> <a href="<?=Url::to(['user/sales'])?>"><?=Yii::t('app','sales')?></a><span class="icon-thumbnail"><i class="fa fa-user-md"></i></span></li>
                        <li class=""> <a href="<?=Url::to(['payment/index'])?>"><?=Yii::t('app','payment method')?></a><span class="icon-thumbnail"><i class="fa fa-money"></i></span></li>
                    </ul>
                </li>
                
                <li class="">
                    <a href="javascript:;">
                        <span class="title"><?=Yii::t('app','control panel')?></span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail "><i class="fa fa-gear"></i></span>
                    <ul class="sub-menu">
                        <li class=""> <a href="<?=Url::to(['user/myprofile'])?>"><?=Yii::t('app','my profile')?></a><span class="icon-thumbnail"><i class="fa fa-user"></i></span></li>
                        <li class=""> <a href="<?=Url::to(['setting/index'])?>"><?=Yii::t('app','store setting')?></a><span class="icon-thumbnail"><i class="fa fa-wrench"></i></span></li>
                        <li class=""> <a href="<?=Url::to(['user/chpassword'])?>"><?=Yii::t('app','change password')?></a><span class="icon-thumbnail"><i class="fa fa-key"></i></span></li>
                    </ul>
                </li>
                
            </ul>
            <div class="clearfix"></div>
        </div> 
    </nav>
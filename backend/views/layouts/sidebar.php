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
            <img src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" alt="logo" class="brand" data-src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" data-src-retina="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" width="78" height="22">
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
                        <span class="details">12 <?=Yii::t('app','update')?></span>
                    </a>
                    <span class="icon-thumbnail bg-success"><i class="pg-home"></i></span>
                </li>
                <li class="">
                    <a href="javascript:;"><span class="title"><?=Yii::t('app','catalog')?></span>
                    <span class="arrow"></span></a>
                    <span class="icon-thumbnail"><i class="pg-layouts"></i></span>
                        <ul class="sub-menu">
                            <li class=""><a href="<?=Url::to(['product/index'])?>"><?=Yii::t('app','product')?></a><span class="icon-thumbnail">P</span></li>
                            <li class=""><a href="<?=Url::to(['banner/index'])?>"><?=Yii::t('app','banner')?></a><span class="icon-thumbnail">B</span></li>
                        </ul>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <span class="title"><?=Yii::t('app','transactions')?></span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i class="pg-form"></i></span>
                    <ul class="sub-menu">
                        <li class=""><a href="<?=Url::to(['order/index'])?>"><?=Yii::t('app','order')?></a><span class="icon-thumbnail">O</span></li>
                    </ul>
                </li>
            
                <li class="">
                    <a href="javascript:;">
                        <span class="title"><?=Yii::t('app','users')?></span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail "><i class="pg-map"></i></span>
                    <ul class="sub-menu">
                        <li class="">
                        <a href="google_map.html"><?=Yii::t('app','users')?></a>
                        <span class="icon-thumbnail">gm</span>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div> 
    </nav>
<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
    //<![CDATA[
    try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"affef9642128321cda4510c8b55d2cb3",petok:"43e3bb05ca42d74bec7a99d49e5478d82168f626-1424056826-1800",zone:"revox.io",rocket:"0",apps:{}}];CloudFlare.push({"apps":{"ape":"1a6c5b3ce48629263de768feff244d2c"}});!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
    //]]>
</script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/x-icon" href="<?=Yii::$app->request->baseUrl?>/assets/images/favicon.ico"/>
    <?php $this->head() ?>
</head>
<body class="fixed-header">
<?php $this->beginBody()?>
    <?=$this->render('sidebar')?>
    <div class="page-container">
        <!-- Header DIV -->
        <div class="header">
            <div class="pull-left full-height visible-sm visible-xs"> 
                <div class="sm-action-bar">
                    <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar"><span class="icon-set menu-hambuger"></span></a>
                </div>
 
            </div>
 
            <div class="pull-right full-height visible-sm visible-xs"> 
                <div class="sm-action-bar">
                    <a href="#" class="btn-link" data-toggle="quickview" data-toggle-element="#quickview"><span class="icon-set menu-hambuger-plus"></span></a>
                </div> 
            </div>
 
            <div class=" pull-left sm-table">
                <div class="header-inner">
                    <div class="brand inline">
                        <img src="<?=Yii::$app->request->baseUrl;?>/assets/images/logo.png" alt="logo" data-src="<?=Yii::$app->request->baseUrl;?>/assets/images/logo.png" data-src-retina="<?=Yii::$app->request->baseUrl;?>/assets/images/logo.png" width="90" height="32">
                    </div>
                </div>
            </div>
            <div class="pull-left sm-table">
                <div class="header-inner">
                    <div class="loading" style="display:none; "><?=Yii::t('app','please wait')?></div>
                </div>
            </div>
            
            <div class="pull-right">
                <div class="visible-lg visible-md m-t-10">
                    <ul class="nav navbar-right">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="user-info"><?=Yii::$app->user->identity->first_name?></span>
                            <b class="caret"></b>
                          </a>
                            
                            <ul class="dropdown-menu">
                              <li><a href="<?=Url::to(['user/myprofile'])?>"><i class="fa fa-user-md"></i> <?=Yii::t('app','my profile')?></a></li>
                              <li><a href="<?=Url::to(['setting/index'])?>"><i class="fa fa-gear"></i> <?=Yii::t('app','store setting')?></a></li>
                              <li><a href="<?=Url::to(['user/chpassword'])?>"><i class="fa fa-key"></i> <?=Yii::t('app','change password')?></a></li>
                              <li><a href="<?=Url::to(['site/logout'])?>"><i class="fa fa-power-off"></i> <?=Yii::t('app','logout')?></a></li>
                            </ul>
                            
                        </li>
                      </ul>
                </div>
            </div>
        </div>
 
        <div class="page-content-wrapper"> 
            <div class="content"> 
                <div class="jumbotron" data-pages="parallax">
                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <div class="inner">
                        <?=Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                        </div>
                    </div>
                </div>
               
                <?=$content;?>                   
                <div class="container-fluid container-fixed-lg footer">
                    <div class="copyright sm-text-center">
                        <p class="small no-margin pull-left sm-pull-reset">
                            <span class="hint-text"><?=Yii::t('app','copyright')?> <?=date('d/m/Y')?> </span>
                            <span class="font-montserrat"><?=Yii::$app->setting->Variable('Store Name')->content?></span>.
                            <span class="hint-text">All rights reserved. </span>
                            <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
                        </p>
                        <p class="small no-margin pull-right sm-pull-reset">
                            <a href="#">Hand-crafted</a> <span class="hint-text">&amp; Made with Love �</span>
                        </p>
                    <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Message Notification -->
 <?php if(Yii::$app->session->getFlash('msg')){ ?>
 <div data-position="top" class="pgn-wrapper">
    <div class="pgn pgn-bar">
        <div class="alert alert-info">
            <span style="color:red"><i class="fa fa-warning"></i>  <?=Yii::$app->session->getFlash('msg')?></span>
        </div>
    </div>
 </div>
 <?php } ?>
<!-- Message Notification -->
 
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

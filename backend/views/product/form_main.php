<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-transparent ">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','product')?></div>
                    <div class="btn-group pull-right m-b-10">
                        <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=Html::a('<i class="fa fa-times"></i> '.Yii::t('app','exit'),['product/index'])?></li>
                            </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-tabs-fillup">
                        <li <?=Yii::$app->controller->getRoute()=='product/update_information'?'class="active"':''?>><a href="<?=Url::to(['product/update_information','id'=>isset(Yii::$app->request->QueryParams['id'])])?>"><span><?=Yii::t('app','information')?></span></a></li>
                        <li <?=Yii::$app->controller->getRoute()=='product/update_options'?'class="active"':''?>><a href="<?=Url::to(['product/update_options','id'=>isset(Yii::$app->request->QueryParams['id'])])?>"><span><?=Yii::t('app','options')?></span></a></li>
                        <li <?=Yii::$app->controller->getRoute()=='product/update_image'?'class="active"':''?>><a href="<?=Url::to(['product/update_image','id'=>isset(Yii::$app->request->QueryParams['id'])])?>"><span><?=Yii::t('app','image')?></span></a></li>
                        <li><a href="<?=Url::to(['product/add_category'])?>"><span><?=Yii::t('app','category')?></span></a></li>
                    </ul>
 
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-fillup1">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    <?=$this->render($form,[
                                        'model' => $model
                                    ])?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
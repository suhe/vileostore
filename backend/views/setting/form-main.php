<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-transparent ">
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm hidden-print">
                        <li <?=Yii::$app->controller->getRoute()=='setting/basic'?'class="active"':''?>><a href="<?=Url::to(['setting/basic'])?>"><span><?=Yii::t('app','basic information')?></span></a></li>
                        <li <?=Yii::$app->controller->getRoute()=='setting/contact'?'class="active"':''?>><a href="<?=Url::to(['setting/contact'])?>"><span><?=Yii::t('app','contact information')?></span></a></li>
                        <li <?=Yii::$app->controller->getRoute()=='setting/meta'?'class="active"':''?>><a href="<?=Url::to(['setting/meta'])?>"><span><?=Yii::t('app','meta information')?></span></a></li>
                    </ul>
 
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-fillup1">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    <?=$this->render($form,[
                                        'model' => $model,
                                        'items' => isset($items)?$items:'',
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
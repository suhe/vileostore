<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-transparent ">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','basic information')?></div>
                    <div class="btn-group pull-right m-b-10">
                        <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=Html::a('<i class="fa fa-times"></i> '.Yii::t('app','exit'),['user/customer'])?></li>
                            </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm hidden-print">
                        <li <?=Yii::$app->controller->getRoute()=='setting/basic'?'class="active"':''?>><a href="<?=Url::to(['setting/basic'])?>"><span><?=Yii::t('app','information')?></span></a></li>
                        <li <?=Yii::$app->controller->getRoute()=='user/chpassword'?'class="active"':''?>><a href="<?=Url::to(['user/chpassword'])?>"><span><?=Yii::t('app','change password')?></span></a></li>
                    </ul>
 
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-fillup1">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    <?=$this->render($form,[
                                        'model' => $model,
                                        'dataProvider' => isset($dataProvider)?$dataProvider:'',
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
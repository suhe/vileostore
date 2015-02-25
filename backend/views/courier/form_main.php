<?php
use yii\helpers\Html;
use yii\helpers\Url;
$page_id = isset(Yii::$app->request->QueryParams['id'])?Yii::$app->request->QueryParams['id']:0;
?>

<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-transparent ">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','shipping information')?></div>
                    <div class="btn-group pull-right m-b-10">
                        <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=Html::a('<i class="fa fa-times"></i> '.Yii::t('app','exit'),['courier/index'])?></li>
                            </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm hidden-print">
                        <li <?=Yii::$app->controller->getRoute()=='courier/update_information'?'class="active"':''?>><a href="<?=Url::to(['courier/update_information','id'=>$page_id])?>"><span><?=Yii::t('app','information')?></span></a></li>
                        <li <?=Yii::$app->controller->getRoute()=='courier/shipping'?'class="active"':''?>><a href="<?=Url::to(['courier/shipping','id'=>$page_id])?>"><span><?=Yii::t('app','shipping')?></span></a></li>
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
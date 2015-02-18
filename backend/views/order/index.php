<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','order'),'url' => ['order/index']],
];
$this->title = Yii::t('app','order transaction');
use yii\helpers\Html;
?>
<div class="container-fluid container-fixed-lg bg-white"> 
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title"><?=Yii::t('app','order')?></div>
            <div class="btn-group pull-right m-b-10">
                <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add new'),['product/update_information'])?></li>
                    </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="panel-body">
            <div class="table-responsive">
                <?=\yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $model,
                    'tableOptions' => ['class'=>'table table-hover','id'=>'basicTable'],
                    'layout' => '{summary}{errors}{items}<div class="pagination pull-right">{pager}</div> <div class="clearfix"></div>',
                    'columns'=>[
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['style'=>'width:5%'],
                        ],    
                        'invoice_no' => [
                            'attribute' => 'invoice_no',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => true,
                        ],
                        'created_date' => [
                            'attribute' => 'created_date',
                            'headerOptions' => ['style'=>'width:10%'],
                            'value' => function($data) {return Yii::$app->formatter->asDate($data->created_date,'php:d/m/Y');},
                            'contentOptions' => ['class'=>'text-center'],
                            'filter' => \yii\helpers\Html::activeInput('text',$model,'created_date',['id'=>'date','class'=>'form-control'])
                        ],
                        'status' => [
                            'attribute' => 'status',
                            'headerOptions' => ['style'=>'width:10%'],
                            'value' => function($data) {return \common\models\Order::stringStatus($data->status);},
                            'contentOptions' => ['class'=>'text-center'],
                            'filter' => \yii\helpers\Html::activeDropDownList($model,'status',\common\models\Order::dropdownStatus(),['class' => 'form-control']),
                        ],
                        'name' => [
                            'attribute' => 'customer_name',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' => true,
                        ],
                        
                        'sub_total' => [
                            'attribute' => 'sub_total',
                            'headerOptions' => ['style'=>'width:10%'],
                            'format'=>['decimal',0],
                            'filter' => true,
                        ],
                        'shipping_cost' => [
                            'attribute' => 'shipping_cost',
                            'headerOptions' => ['style'=>'width:10%'],
                            'format'=>['decimal',0],
                            'filter' => true,
                        ],
                        'grand_total' => [
                            'attribute' => 'grand_total',
                            'headerOptions' => ['style'=>'width:10%'],
                            'format'=>['decimal',0],
                            'filter' => true,
                        ],
                        ['class'=>'yii\grid\ActionColumn',
                            'headerOptions' => ['style'=>'width:12%'],
                            'controller'=>'product',
                            'template'=>'{view}',
                                'buttons' => [
                                    'view' => function ($url,$data) {
                                                return '
                                                <div class="btn-group pull-right m-b-10">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-eye"></i> '.Yii::t('app','view').'</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>'.Html::a('<i class="fa fa-eye"></i> '.Yii::t('app','view'),['order/summary','id' => $data->id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove'),['order/remove','id' => $data->id]).'</li>
                                                        </ul>
                                                </div>
                                            ';},
                                ],
                        ],
                    ],
                    //'showFooter' => true ,
                ]);?>
            </div>
        </div>
    </div> 
</div>
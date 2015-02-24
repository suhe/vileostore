<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','administration'),'url' => ['#']],
    ['label' => Yii::t('app','payment'),'url' => ['payment/index']],
];
$this->title = Yii::t('app','payment');
use yii\helpers\Html;
?>
<div class="container-fluid container-fixed-lg bg-white"> 
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title"><?=Yii::t('app','payment')?></div>
            <div class="btn-group pull-right m-b-10">
                <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add new'),['payment/add'])?></li>
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
                        'account' => [
                            'attribute' => 'account',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => true,
                        ],
                        'owner' => [
                            'attribute' => 'owner',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' => true,
                        ],
                        'name' => [
                            'attribute' => 'name',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => true,
                        ],
                        'branch' => [
                            'attribute' => 'branch',
                            'headerOptions' => ['style'=>'width:15%'],
                            'filter' => true,
                        ],
                        'status' => [
                            'attribute' => 'status',
                            'headerOptions' => ['style'=>'width:10%'],
                            'value' => function($data) {return \common\models\Category::stringStatus($data->status);},
                            'contentOptions' => ['class'=>'text-center'],
                            'filter' => \yii\helpers\Html::activeDropDownList($model,'status',\common\models\Category::dropdownStatus(),['class' => 'form-control']),
                        ],
                        'order' => [
                            'attribute' => 'order',
                            'headerOptions' => ['style'=>'width:8%'],
                            'contentOptions' => ['class'=>'text-center'],
                            'filter' => true,
                        ],
                        ['class'=>'yii\grid\ActionColumn',
                            'headerOptions' => ['style'=>'width:10%'],
                            'controller'=>'category',
                            'template'=>'{view}',
                                'buttons' => [
                                    'view' => function ($url,$data) {
                                                return '
                                                <div class="btn-group pull-right m-b-10">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> '.Yii::t('app','edit').'</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>'.Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','edit'),['payment/edit','id' => $data->id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove'),['payment/remove','id' => $data->id]).'</li>
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
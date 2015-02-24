<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','shipping'),'url' => ['area/index']],
    ['label' => Yii::t('app','shipping area'),'url' => ['area/index']],
];
$this->title = Yii::t('app','shipping area');
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
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add area'),['area/add_area'])?></li>
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add city'),['area/add_city'])?></li>
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add province'),['area/add_province'])?></li>
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
                        'area' => [
                            'attribute' => 'area',
                            'headerOptions' => ['style'=>'width:30%'],
                            'filter' => true,
                        ],
                        'province_name' => [
                            'attribute' => 'province_name',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' =>\yii\helpers\Html::activeDropDownList($model,'province_id',\common\models\Province::dropdownList(Yii::t('app','all')),
                                [
                                    'class' => 'form-control',
                                ]),
                        ],
                        'city_name' => [
                            'attribute' => 'city_name',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' =>\yii\helpers\Html::activeDropDownList($model,'city_id',\common\models\City::dropdownList(Yii::t('app','all'),
                                ['province_id' => isset(Yii::$app->request->QueryParams['Town']['province_id'])?Yii::$app->request->QueryParams['Town']['province_id']:0]),
                                ['class' => 'form-control']),
                        ],
                        ['class'=>'yii\grid\ActionColumn',
                            'headerOptions' => ['style'=>'width:10%'],
                            'controller'=>'area',
                            'template'=>'{view}',
                                'buttons' => [
                                    'view' => function ($url,$data) {
                                                return '
                                                <div class="btn-group pull-right m-b-10">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> '.Yii::t('app','edit').'</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>'.Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','edit area'),['area/edit_area','id' => $data->id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove area'),['area/remove_area','id' => $data->id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','edit city'),['area/edit_city','id' => $data->city_id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove city'),['area/remove_city','id' => $data->city_id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','edit province'),['area/edit_province','id' => $data->province_id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove province'),['area/remove_province','id' => $data->province_id]).'</li>
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
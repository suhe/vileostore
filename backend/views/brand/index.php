<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','brand'),'url' => ['brand/index']],
];
$this->title = Yii::t('app','brand');
use yii\helpers\Html;
?>
<div class="container-fluid container-fixed-lg bg-white"> 
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title"><?=Yii::t('app','product')?></div>
            <div class="btn-group pull-right m-b-10">
                <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add new'),['brand/add'])?></li>
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
                        [
                            'attribute' => 'logo',
                            'format' => 'raw',
                            'value' => function($data) {
                                            return himiklab\thumbnail\EasyThumbnailImage::thumbnailImg('@image_brand/'.$data->id.'/'.$data->logo,114,45,
                                                    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                                    ['alt' => $data->name,'class'=>'img-responsive']);},
                            'headerOptions' => ['style'=>'width:10%'],
                        ],
                        'name' => [
                            'attribute' => 'name',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' => true,
                        ],
                        'slug' => [
                            'attribute' => 'slug',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' => true,
                        ],
                    
                        'status' => [
                            'attribute' => 'status',
                            'headerOptions' => ['style'=>'width:10%'],
                            'value' => function($data) {return \common\models\Brand::stringStatus($data->status);},
                            'contentOptions' => ['class'=>'text-center'],
                            'filter' => \yii\helpers\Html::activeDropDownList($model,'status',\common\models\Brand::dropdownStatus(),['class' => 'form-control']),
                        ],
                        ['class'=>'yii\grid\ActionColumn',
                            'headerOptions' => ['style'=>'width:10%'],
                            'controller'=>'brand',
                            'template'=>'{view}',
                                'buttons' => [
                                    'view' => function ($url,$data) {
                                                return '
                                                <div class="btn-group pull-right m-b-10">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> '.Yii::t('app','edit').'</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>'.Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','edit'),['brand/edit','id' => $data->id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove'),['brand/remove','id' => $data->id]).'</li>
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
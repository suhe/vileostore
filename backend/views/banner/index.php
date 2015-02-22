<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','banner'),'url' => ['banner/index']],
];
$this->title = Yii::t('app','banner');
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
                        <li><?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app','add new'),['banner/add'])?></li>
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
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => function($data) {
                                            return himiklab\thumbnail\EasyThumbnailImage::thumbnailImg('@image_banner/'.$data->id.'/'.$data->image,300,150,
                                                    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                                    ['alt' => $data->name,'class'=>'img-responsive']);},
                            'headerOptions' => ['style'=>'width:20%'],
                        ],
                        'link_url' => [
                            'attribute' => 'link_url',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => true,
                        ],
                        
                        'position' => [
                            'attribute' => 'position',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => \yii\helpers\Html::activeDropDownList($model,'position',\common\models\Banner::dropDownPosition(),['class'=>'form-control']),
                        ],
                        'slide' => [
                            'attribute' => 'slide',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => \yii\helpers\Html::activeDropDownList($model,'slide',\common\models\Banner::dropDownSlide(),['class'=>'form-control']),
                        ],
                        'status' => [
                            'attribute' => 'status',
                            'headerOptions' => ['style'=>'width:8%'],
                            'value' => function($data) {return \common\models\Banner::stringStatus($data->status);},
                            'contentOptions' => ['class'=>'text-center'],
                            'filter' => \yii\helpers\Html::activeDropDownList($model,'status',\common\models\Banner::dropdownStatus(),['class' => 'form-control']),
                        ],
                        ['class'=>'yii\grid\ActionColumn',
                            'headerOptions' => ['style'=>'width:10%'],
                            'controller'=>'product',
                            'template'=>'{view}',
                                'buttons' => [
                                    'view' => function ($url,$data) {
                                                return '
                                                <div class="btn-group pull-right m-b-10">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> '.Yii::t('app','edit').'</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>'.Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','edit'),['banner/edit','id' => $data->id]).'</li>
                                                            <li>'.Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','remove'),['banner/remove','id' => $data->id]).'</li>
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
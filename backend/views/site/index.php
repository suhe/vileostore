<?php
$this->params['breadcrumbs'] = [
    ['label' => '','url' => ['site/index']],
];
$this->title = Yii::t('app','dashboard');
use yii\helpers\Html;
?>

<div class="container-fluid padding-25 sm-padding-10">
    <!-- ========================================================= Row For Summary Sales and graphic ========================================================== -->
    <div class="row">
        <div class="col-md-6">
            <div class="widget-15 panel panel-condensed  no-margin no-border widget-loader-circle">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','summary')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a data-toggle="collapse" class="portlet-collapse" href="#"><i class="pg-arrow_maximize"></i></a></li>
                            <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="panel-body " style="display: block;">
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15  col-sm-height col-top bg-master-lighter">
                                <p class="font-montserrat  no-margin"><?=Yii::t('app','total sales this day')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle bg-master-lighter">
                                <p class="text-right text-primary no-margin"><?=\common\models\Order::TotalOrder(['date_format(created_date,\'%Y-%m-%d\')' => date('Y-m-d')])?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15  col-sm-height col-top ">
                                <p class="font-montserrat no-margin"><?=Yii::t('app','total sales this week')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle ">
                                <p class="text-right text-primary no-margin"><?=\common\models\Order::TotalOrder(['WEEK(created_date)' => date('W')-1,'YEAR(created_date)' => date('Y')])?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15  col-sm-height col-top bg-master-lighter">
                                <p class="font-montserrat no-margin"><?=Yii::t('app','total sales this month')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle bg-master-lighter">
                                <p class="text-right text-primary no-margin"><?=\common\models\Order::TotalOrder(['MONTH(created_date)' => date('m'),'YEAR(created_date)' => date('Y')])?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15  col-sm-height col-top">
                                <p class="font-montserrat no-margin"><?=Yii::t('app','total sales this year')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle ">
                                <p class="text-right text-primary no-margin"><?=\common\models\Order::TotalOrder(['YEAR(created_date)' => date('Y')])?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15  col-sm-height col-top bg-master-lighter">
                                <p class="font-montserrat  no-margin"><?=Yii::t('app','total sales')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle bg-master-lighter">
                                <p class="text-right text-primary no-margin"><?=\common\models\Order::TotalOrder()?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15 col-sm-height col-top ">
                                <p class="font-montserrat  no-margin"><?=Yii::t('app','total product')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle">
                                <p class="text-right text-primary no-margin"><?=\common\models\Product::TotalOrder()?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-15 col-sm-height col-top bg-master-lighter">
                                <p class="font-montserrat  no-margin"><?=Yii::t('app','total customer')?></p>
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle bg-master-lighter">
                                <p class="text-right text-primary no-margin"><?=\common\models\User::TotalUser(['group_id'=>1])?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-sm-height ">
                        <div class="row row-sm-height">
                            <div class="col-sm-9 padding-12 col-sm-height col-top">
                                
                            </div>
                            <div class="col-sm-3 col-sm-height col-middle ">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="widget-15 panel panel-condensed  no-margin no-border widget-loader-circle" style="max-height:300px">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','sales graphic per day')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a data-toggle="collapse" class="portlet-collapse" href="#"><i class="pg-arrow_maximize"></i></a></li>
                            <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="panel-body " style="display: block;">
                    
                    <?=\dosamigos\highcharts\HighCharts::widget([
                            'clientOptions' => [
                                'title' => ['text' => Yii::t('app','total sales per day')],
                                'xAxis' => [
                                   'categories' => \common\models\Order::getDayOfWeek(),
                                ],
                                'yAxis' => [
                                   'title' => ['text' => Yii::t('app','total sales per day')]
                                ],
                                'series' => [
                                   ['data' => \common\models\Order::getDayOfOrder(),],
                                ]
                            ],   
                        ]);
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================================= Row For Summary Sales and graphic ========================================================== -->
    
    
    <!-- ========================================================= Row For Summary Master Product ========================================================== -->
    <div class="row top-30">
        <div class="col-md-6">
            <div class="widget-15 panel panel-condensed  no-margin no-border widget-loader-circle">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','best seller product')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a data-toggle="collapse" class="portlet-collapse" href="#"><i class="pg-arrow_maximize"></i></a></li>
                            <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="panel-body " style="display: block;">
                    <?=\yii\grid\GridView::widget([
                    'dataProvider' => $bestSellerdataProvider,
                    'tableOptions' => ['class'=>'table table-hover','id'=>'basicTable'],
                    'layout' => '{items}<div class="clearfix"></div>',
                    'columns'=>[
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['style'=>'width:5%'],
                        ],    
                        [
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => function($data) {
                                            return himiklab\thumbnail\EasyThumbnailImage::thumbnailImg('@image_product/'.$data->id.'/'.$data->image,55,55,
                                                    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                                    ['alt' => $data->name]);},
                            'headerOptions' => ['style'=>'width:10%'],
                        ],
                        'sku' => [
                            'attribute' => 'sku',
                            'headerOptions' => ['style'=>'width:10%'],
                            'filter' => true,
                        ],
                        'name' => [
                            'attribute' => 'name',
                            'headerOptions' => ['style'=>'width:50%'],
                            'filter' => true,
                        ],
                        'stock' => [
                            'attribute' => 'stock',
                            'headerOptions' => ['style'=>'width:8%'],
                            'format'=>['decimal',0],
                            'filter' => true,
                        ],
                    ],
                    //'showFooter' => true ,
                ]);?>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="widget-15 panel panel-condensed  no-margin no-border widget-loader-circle">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','sales today')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a data-toggle="collapse" class="portlet-collapse" href="#"><i class="pg-arrow_maximize"></i></a></li>
                            <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="panel-body " style="display: block;">
                    <?=\yii\grid\GridView::widget([
                    'dataProvider' => $salesTodaydataProvider,
                    'tableOptions' => ['class'=>'table table-hover','id'=>'basicTable'],
                    'layout' => '{items}',
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
                        ],
                        'name' => [
                            'attribute' => 'customer_name',
                            'headerOptions' => ['style'=>'width:20%'],
                            'filter' => true,
                        ],
                        'grand_total' => [
                            'attribute' => 'grand_total',
                            'headerOptions' => ['style'=>'width:10%'],
                            'format'=>['decimal',0],
                            'filter' => true,
                        ],
                    ],
                    //'showFooter' => true ,
                ]);?>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================================= Row For Summary Sales and graphic ========================================================== -->
    
    
    
</div>    
<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','order'),'url' => ['order/index']],
    ['label' => Yii::t('app','order history'),'url' => ['order/summary_history','id'=>Yii::$app->request->QueryParams['id']]],
];
$this->title = Yii::t('app','order transaction');
use yii\helpers\Html;
?>
<div class="table-responsive">
    <?=\yii\grid\GridView::widget([
        'dataProvider' => $data,
        'filterModel'  => $model,
        'tableOptions' => ['class'=>'table table-hover','id'=>'basicTable'],
        'layout' => '{summary}{errors}{items}<div class="pagination pull-right">{pager}</div> <div class="clearfix"></div>',
        'columns'=>[
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style'=>'width:5%'],
            ],    
            'created_date' => [
                'attribute' => 'created_date',
                'headerOptions' => ['style'=>'width:10%'],
                'value' => function($data) {return Yii::$app->formatter->asDate($data->created_date,'php:d/m/Y H:i:s');},
                'contentOptions' => ['class'=>'text-center'],
                'filter' => false
            ],
            'type' => [
                'attribute' => 'type',
                'headerOptions' => ['style'=>'width:10%'],
                'filter' => false
            ],            
            'description' => [
                'attribute' => 'description',
                'headerOptions' => ['style'=>'width:20%'],
                'filter' => false
            ],
            'user_name' => [
                'attribute' => 'user_name',
                'headerOptions' => ['style'=>'width:10%'],
                'filter' => false
            ],
        ],
            
    ]);?>
</div>

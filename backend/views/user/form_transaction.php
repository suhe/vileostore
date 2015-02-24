<?php

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','administration'),'url' => ['user/customer']],
    ['label' => Yii::t('app','customer'),'url' => ['user/customer']],
    ['label' => Yii::t('app','view transaction'),'url' => ['user/transaction','id'=>isset(Yii::$app->request->QueryParams['id'])]],
];
$this->title = Yii::t('app','user transaction');
use yii\helpers\Html;
?>

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
            'courier_name' => [
                'attribute' => 'courier_name',
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
         ],
                    //'showFooter' => true ,
    ]);?>
</div>
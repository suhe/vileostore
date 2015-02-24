<?php

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','administration'),'url' => ['user/customer']],
    ['label' => Yii::t('app','customer'),'url' => ['user/customer']],
    ['label' => Yii::t('app','view address'),'url' => ['user/address','id'=>isset(Yii::$app->request->QueryParams['id'])]],
];
$this->title = Yii::t('app','user address');
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
                        'address' => [
                            'attribute' => 'address',
                            'headerOptions' => ['style'=>'width:50%'],
                            'filter' => true,
                        ],
                        'province' => [
                            'attribute' => 'province',
                            'headerOptions' => ['style'=>'width:15%'],
                            'filter' =>\yii\helpers\Html::activeDropDownList($model,'province_id',\common\models\Province::dropdownList(Yii::t('app','all')),
                                [
                                    'class' => 'form-control',
                                ]),
                        ],
                        'city' => [
                            'attribute' => 'city',
                            'headerOptions' => ['style'=>'width:15%'],
                            'filter' =>\yii\helpers\Html::activeDropDownList($model,'city_id',\common\models\City::dropdownList(Yii::t('app','all'),
                                ['province_id' => isset(Yii::$app->request->QueryParams['UserAddress']['province_id'])?Yii::$app->request->QueryParams['UserAddress']['province_id']:0]),
                                ['class' => 'form-control']),
                        ],
                        
                    ],
                    //'showFooter' => true ,
                ]);?>
</div>

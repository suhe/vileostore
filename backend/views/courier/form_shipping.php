<?php
$page_id = isset(Yii::$app->request->QueryParams['id'])?Yii::$app->request->QueryParams['id']:0;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','courier'),'url' => ['courier/index']],
    ['label' => Yii::t('app','courier shipping'),'url' => ['courier/shipping','id'=>$page_id]],
];
$this->title = Yii::t('app','courier shipping');

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
?>

<div class="table-responsive">

<div class="pull-right">
    <?php
    $form = ActiveForm::begin([
        'id' => 'form-work',
        'method' => 'GET',
        'options' => [
            'class' => 'form-inline',
            'role' => 'form',
            'autocomplete' =>'off',
        ],
        'fieldConfig' => [
            'template' => '{input}{error}',
            //'labelOptions' => ['class' => 'col-sm-3 control-label'],
        ],
    ]); ?>
    <?=$form->field($model,'province_id')->dropDownList(\common\models\Province::dropdownList(Yii::t('app','select province'))
    ,['class'=>'form-control','onchange'=>'this.form.submit()'])?>
    <?=$form->field($model,'city_id')->dropDownList(\common\models\City::dropdownWithProvinceList(Yii::t('app','select city'),
    ['province_id' => isset(Yii::$app->request->QueryParams['Shipping']['province_id'])?Yii::$app->request->QueryParams['Shipping']['province_id']:0]),
    ['class'=>'form-control','onchange'=>'this.form.submit()'])?>
    <?php ActiveForm::end(); ?>
</div>
<div class="clearfix"></div>
    
<?php
$form = ActiveForm::begin([
    'action' => ['courier/batchUpdate','id'=>$page_id]
]);
echo TabularForm::widget([
    'dataProvider'=>$dataProvider,
    'form'=>$form,
    'attributes'=>[
        'id' => [
            'attribute' => 'area',
            'type' => TabularForm::INPUT_HIDDEN,
            'columnOptions' => ['hidden'=>true]
        ], 
        'area' => [
            'attribute' => 'area',
            'type' => TabularForm::INPUT_STATIC,
            'columnOptions'=>['width'=>'70%']
        ],
        'cost' => [
            'attribute' => 'cost',
            'type' => TabularForm::INPUT_RAW,
            'value' => function ($model, $key, $index, $widget) {return Html::activeTextInput($model,"[$model->id]cost",['value'=>\common\models\Shipping::Cost(Yii::$app->request->QueryParams['id'],$model->id),'class'=>'form-control text-right']);},
            'columnOptions'=>['width'=>'20%']
        ]   
    ],
    'actionColumn' =>[
        'class' => '\kartik\grid\ActionColumn',
        'updateOptions' => ['style' => 'display:none;'],
        'width' => '60px',
    ],
]);
// Add other fields if needed or render your submit button
echo '<div class="text-right">' .Html::submitButton('Submit', ['class'=>'btn btn-primary']) .'<div>';
ActiveForm::end();
?>
</div>
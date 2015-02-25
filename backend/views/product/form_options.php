<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['product/index']],
    ['label' => Yii::t('app','product'),'url' => ['product/index']],
    ['label' => Yii::t('app','product options'),'url' => ['product/update_options','id'=>Yii::$app->request->QueryParams['id']]],
];
$this->title = Yii::t('app','product options');

?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-work',
    'options' => [
        'class' => 'form-horizontal',
        'role' => 'form',
        'autocomplete' =>'off',
    ],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ],
]); ?>
<?=$form->field($model,'status')->inline()->radioList(['1'=>Yii::t('app','active'),'0'=>Yii::t('app','non active')]); ?>
<?=$form->field($model,'best_seller')->inline()->radioList(['1'=>Yii::t('app','yes'),'0'=>Yii::t('app','no')]); ?>
<?=$form->field($model,'online')->inline()->radioList(['1'=>Yii::t('app','yes'),'0'=>Yii::t('app','no')]); ?>
<?=$form->field($model,'cod')->inline()->radioList(['1'=>Yii::t('app','yes'),'0'=>Yii::t('app','no')]); ?>
<?=$form->field($model,'dropshier')->inline()->radioList(['1'=>Yii::t('app','yes'),'0'=>Yii::t('app','no')]); ?>
<?=$form->field($model,'stock')->textInput(['style'=>'width:20%','data-a-dec'=>'.','data-a-sep'=>',','class'=>'autonumeric form-control text-right'])?>
<?=$form->field($model,'price')->textInput(['style'=>'width:20%','data-a-dec'=>'.','data-a-sep'=>',','class'=>'autonumeric form-control text-right'])?>
<?=$form->field($model,'arrival_date')->textInput(['id'=>'date','style'=>'width:12%'])?>
<div class="form-group" style="margin-bottom:10px">
    <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

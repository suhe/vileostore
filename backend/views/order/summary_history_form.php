<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','order'),'url' => ['order/index']],
    ['label' => Yii::t('app','order history'),'url' => ['order/summary_history','id'=>Yii::$app->request->QueryParams['id']]],
];
$this->title = Yii::t('app','order transaction');
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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
<?=$form->field($model, 'type')->dropDownList(\common\models\OrderHistory::dropDownList(),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
<?=$form->field($model, 'description')->textarea()?>
<div class="form-group" style="margin-bottom:10px">
    <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','update'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

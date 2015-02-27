<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','setting'),'url' => ['setting/basic']],
    ['label' => Yii::t('app','basic information'),'url' => ['setting/basic']],
];
$this->title = Yii::t('app','basic information');

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
<?=$form->field($model,'first_name')->textInput()?>
<?=$form->field($model,'middle_name')->textInput()?>
<?=$form->field($model,'last_name')->textInput()?>
<?=$form->field($model,'email')->textInput(['readonly'=>true])?>
<div class="form-group" style="margin-bottom:10px">
<?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

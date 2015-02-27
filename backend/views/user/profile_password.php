<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','administration'),'url' => ['user/customer']],
    ['label' => Yii::t('app','customer'),'url' => ['user/customer']],
    ['label' => Yii::t('app','view information'),'url' => ['user/edit','id'=>isset(Yii::$app->request->QueryParams['id'])]],
];
$this->title = Yii::t('app','user information');

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
<?=$form->field($model,'new_password')->passwordInput()?>
<?=$form->field($model,'confirm_password')->passwordInput()?>
<div class="form-group" style="margin-bottom:10px">
<?=Html::submitButton('<i class="fa fa-key icon-on-right"></i> '.Yii::t('app','update'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','setting'),'url' => ['setting/basic']],
    ['label' => Yii::t('app',Yii::$app->controller->action->id),'url' => [Yii::$app->controller->getRoute()]],
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
<?php
foreach($items as $i=>$item){
    echo $form->field($item,"[$i]content")->textarea(['rows'=>5])->label(Yii::t('app',$item->name));
}
?>
<div class="form-group" style="margin-bottom:10px">
<?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','update'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

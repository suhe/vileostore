<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','shipping'),'url' => ['courier/index']],
    ['label' => Yii::t('app','courier'),'url' => ['courier/index']],
    ['label' => Yii::t('app','courier information'),'url' => ['courier/edit','id'=>isset(Yii::$app->request->QueryParams['id'])]],
];
$this->title = Yii::t('app','courier information');

?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-work',
    'options' => [
        'class' => 'form-horizontal',
        'role' => 'form',
        'autocomplete' =>'off',
        'enctype'=>'multipart/form-data',
    ],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ],
]); ?>
<?=$form->field($model, 'icon')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*',],
    'pluginOptions' => [
    'initialPreview' => [
        isset($model->id)?Html::img(str_replace('backend/web/','',Yii::$app->request->baseUrl.'/assets/images/couriers/'.$model->id.'/'.$model->icon), ['class'=>'file-preview-image img-responsive']):'',
    ],
    'showPreview' => true,
    'showCaption' => true,
    'showRemove' => true,
    'showUpload' => false                        ]
]);?>
<?=$form->field($model,'name')->textInput()?>
<?=$form->field($model,'status')->inline()->radioList(['1'=>Yii::t('app','active'),'0'=>Yii::t('app','non active')]); ?>
<div class="form-group" style="margin-bottom:20px">
    <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>
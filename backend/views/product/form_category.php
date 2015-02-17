<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','product'),'url' => ['product/index']],
    ['label' => Yii::t('app','product images'),'url' => ['product/update_image','id'=>Yii::$app->request->QueryParams['id']]],
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

<div class="checkbox ">
<input type="checkbox" value="1" id="checkbox1">
<label for="checkbox1">Keep Me Signed in</label>
</div>

<div class="checkbox check-success  ">
<input type="checkbox" checked="checked" value="1" id="checkbox2">
<label for="checkbox2">I agree</label>
</div>

<div class="form-group" style="margin-bottom:10px">
    <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

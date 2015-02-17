<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','product'),'url' => ['product/index']],
    ['label' => Yii::t('app','product information'),'url' => ['product/update_information','id'=>isset(Yii::$app->request->QueryParams['id'])]],
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
<?=$form->field($model, 'sku')->textInput(['style'=>'width:20%'])?>
<?=$form->field($model, 'name')->textInput()?>
<?=$form->field($model, 'weight')->textInput(['style'=>'width:20%','placeholder' => Yii::t('app','gram'),'data-a-dec'=>'.','data-a-sep'=>',','class'=>'autonumeric form-control'])?>
<?php //$form->field($model, 'price')->textInput(['style'=>'width:20%','data-a-dec'=>'.','data-a-sep'=>',','class'=>'autonumeric form-control'])?>
<?=$form->field($model, 'category_id')->dropDownList(\common\models\Category::getHierarchyList(false),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
<?=$form->field($model, 'brand_id')->dropDownList(\common\models\Brand::getDropdownList(false),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
<?=$form->field($model, 'short_description')->textarea()?>
<?=$form->field($model, 'long_description')->textarea(['style'=>'height:200px'])?>
<?php // $form->field($model, 'arrival_date')->textInput(['id'=>'date','style'=>'width:12%'])?>
<div class="form-group" style="margin-bottom:10px">
    <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>

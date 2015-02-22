<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['product/index']],
    ['label' => Yii::t('app','product'),'url' => ['product/index']],
    ['label' => Yii::t('app','product category'),'url' => ['product/update_category','id'=>Yii::$app->request->QueryParams['id']]],
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

<ul class="list-inline">
<?php foreach(\common\models\Category::getHierarchyCategory() as $main){ ?>
    <li class="main">
        <div class="checkbox ">
        <?=Html::checkbox('category_id[]',\common\models\ProductCategory::getChecked($main->id),['value'=>$main->id,'id'=>$main->id]);?>
        <label for="<?=$main->id?>"><?=$main->name?></label>
        </div>
        <ul>
        <?php foreach(\common\models\Category::getHierarchyCategory($main->id) as $sub){ ?>
            <li class="sub<?=$main->id?>">
                <div class="checkbox">
                    <?=Html::checkbox('category_id[]',\common\models\ProductCategory::getChecked($sub->id),['value'=>$sub->id,'id'=>$sub->id]);?>
                    <label for="<?=$sub->id?>"><?=$sub->name?></label>
                </div>
            </li>
        <?php } ?>
        </ul>
    </li>
<?php } ?>
</ul>

<div class="form-group" style="margin-bottom:10px">
    <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','update'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
</div>
<?php ActiveForm::end(); ?>
<?php 
$js = <<<JS
    $('.main input:checkbox').on('click' , function(){
	var that = this;
        var value = $(this).val();
	$(this).closest('ul').find('.main ul .sub' + value +' input:checkbox')
        .each(function(){
	    this.checked = that.checked;
	    $(this).closest('li').toggleClass('selected');
	});
						
    });
JS;
$this->registerJs($js);

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','product'),'url' => ['product/index']],
    ['label' => Yii::t('app','product images'),'url' => ['product/update_image','id'=>Yii::$app->request->QueryParams['id']]],
];
$this->title = Yii::t('app','product images');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <?=Yii::t('app','drag and drop imnage')?>
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"></a>
                    <a class="config" data-toggle="modal" href="#grid-config"></a>
                    <a class="reload" href="javascript:;"></a>
                    <a class="remove" href="javascript:;"></a>
                </div>
            </div>
            <div class="panel-body no-scroll no-padding">
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'my-dropzone',
                        'action' => Url::to(['product/add_image','id'=>Yii::$app->request->QueryParams['id']]),
                        'options' => [
                            'class' => 'dropzone',
                            'enctype'=>'multipart/form-data',
                            'autocomplete' =>'off',
                        ],
                    ]); ?>
        
                    <div class="fallback">
                        <input type="file" name="file"/>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <?=Yii::t('app','main image')?>
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"></a>
                    <a class="config" data-toggle="modal" href="#grid-config"></a>
                    <a class="reload" href="javascript:;"></a>
                    <a class="remove" href="javascript:;"></a>
                </div>
            </div>
            <div class="panel-body no-scroll">
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'form-main-image',
                        'options' => [
                            'class' => 'form-horizontal',
                            'autocomplete' =>'off',
                        ],
                    ]);
                ?>
                <div class="col-md-4">
                    <?=$form->field($model,'image')->dropDownList(\common\models\ProductImage::dropDownList())?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    
</div>

<?php

$url = Url::to(['product/image','id'=>Yii::$app->request->QueryParams['id']]);
$img_url = Url::to(['product/default_image','id'=>Yii::$app->request->QueryParams['id']]);
$removeUrl = Url::to(['product/remove_image','id'=>Yii::$app->request->QueryParams['id']]);
$removeCaption= Yii::t('app','remove');
$upload = str_replace('/backend/web','',Yii::$app->request->baseUrl).'/assets/images/products/'.Yii::$app->request->QueryParams['id'];
$js = <<<JS
    Dropzone.options.myDropzone = {
    url: '{$url}',
    paramName: 'file',
    autoDiscover: false,
    maxFilesize: 5, // M
    addRemoveLinks: 'dictRemoveFile',
    dictRemoveFile: '{$removeCaption}',
    init: function() {
        thisDropzone = this;
        $.get('{$url}', function(data) {
            $.each(data, function(key,value){
                var mockFile = { name: value.name, size: value.size };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{$upload}/"+value.name);
            });
        });
        
        this.on("removedfile", function(file) {
            var info = 'name=' + file.name;
            $.ajax({        
                url: "{$removeUrl}",
                type: 'post',
                data: info,
                success: function(data) {
                    if(data.success==true){
                        alert(data.message);
                    }
                    else{
                        alert(data.message);
                    }
                }
            });
        });
    }
    
};

$('#product-image').on('change', function(e) {
    var info = 'id=' + $(this).val();
    $.ajax({
	url: '{$img_url}',
	type: 'post',
	data: info,
	success: function(data) {
            if(data.success==true){
		alert(data.message);
	    }
	    else{
                alert(data.message);
	    }
	}
    });
});
JS;
$this->registerJs($js);
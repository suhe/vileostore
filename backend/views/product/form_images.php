<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','product'),'url' => ['product/index']],
    ['label' => Yii::t('app','product images'),'url' => ['product/update_image','id'=>Yii::$app->request->QueryParams['id']]],
];
$this->title = Yii::t('app','product options');

?>

<div class="row">
    
    <?=Yii::getAlias('@webroot/assets/products');  ?>

<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
Drag n' drop uploader
</div>
<div class="tools">
<a class="collapse" href="javascript:;"></a>
<a class="config" data-toggle="modal" href="#grid-config"></a>
<a class="reload" href="javascript:;"></a>
<a class="remove" href="javascript:;"></a>
</div>
</div>
<div class="panel-body no-scroll no-padding">
<form action="/file-upload" class="dropzone" id="my-dropzone">
<div class="fallback">
<input name="file" type="file" multiple />
</div>
</form>
</div>
</div>



</div>

</div>

<?php
$url = Url::to(['product/image']);
$upload = Yii::$app->request->baseUrl.'/assets/products';
$js = <<<JS
    Dropzone.options.myDropzone = {
    init: function() {
        thisDropzone = this;
        $.get('{$url}', function(data) {
            $.each(data, function(key,value){
                var mockFile = { name: value.name, size: value.size };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{$upload}/"+value.name);
            });
        });
    }
};
JS;
$this->registerJs($js);
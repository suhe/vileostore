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


<?=\dosamigos\fileupload\FileUploadUI::widget([
    'model' => $model,
    'attribute' => 'image',
    'url' => ['product/update_image'],
    'gallery' => true,
    'fieldOptions' => [
            'accept' => 'image/*'
    ],
    'clientOptions' => [
            'maxFileSize' => 2000000
    ],
    'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
            'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
    ],
]);
?>

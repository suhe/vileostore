<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','search'),'url' => ['product/search']],
    ['label' => Yii::t('app/message','404'),'url' => ['site/error']], 
];
$this->title = Yii::t('app/message','msg 404')
?>


<div class="col-md-12 x-text text-center">
    <h1><?=Yii::t('app/message','msg 404')?></h1>
    <p><?=Yii::t('app/message','msg we are sorry you cannot page this page is out of date')?> </p>
    <a href="<?=\yii\helpers\Url::to(['site/index'])?>"><i class="fa fa-home"></i> <?=Yii::t('app','go to store')?></a>
</div>

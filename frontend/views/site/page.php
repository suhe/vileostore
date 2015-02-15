<?php
$this->params['breadcrumbs'] = [
    ['label' => \yii\helpers\Html::encode($page->title),'url' => ['site/page','id'=>$page->id]]   
];
$this->title = $page->title;
?>

<div class="blog-page">
    <div class="col-md-12">
	<div class="blog-post wow fadeInUp animated">
            <h1><?=$page->title?></h1>
            <hr class="separator">
            <?=$page->content?>
        </div>
    </div>
</div>    
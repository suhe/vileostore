<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title> 
    <?php $this->head() ?>
</head>
<body class="cnt-homepage">
<?php $this->beginBody() ?>
<?=$this->render('header')?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
<div class='container'>
<div class="homepage-container">
<div class='row single-product outer-bottom-sm '>
    <div class='col-md-12'>
	<?=$content?>
	<div class="clearfix"></div>
    </div><!-- /.row -->
    <!-- Brand -->
	<?=$this->render('brand-footer')?>
	<!-- Brand -->
    
<?=$this->render('footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>		


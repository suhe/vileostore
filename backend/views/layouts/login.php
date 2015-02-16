<?php
use backend\assets\AppAsset;
use \yii\helpers\Html;
use \yii\widgets\Breadcrumbs;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php $this->head() ?>
</head>
<body class="fixed-header">
<?php $this->beginBody() ?>   
<div class="login-wrapper ">
    <div class="bg-pic">
        <img src="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white">Pages make it easy to enjoy what matters the most in the life</h2>
            <p class="small">
                images Displayed are solely for representation purposes only, All work copyright of respective owner, otherwise © 2013-2014 REVOX.
            </p>
        </div>
    </div>
 
    <div class="login-container bg-white">
        <?=$content?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
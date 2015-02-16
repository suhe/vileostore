<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
    <img src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" alt="logo" data-src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" data-src-retina="assets/image/logo_2x.png" >
    <p class="p-t-35">Sign into your pages account</p> 
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <?=$form->field($model, 'email')->textInput()?>
    <?=$form->field($model, 'password')->passwordInput()?>
    <?=Html::submitButton(Yii::t('app','sign in'),['class' => 'btn btn-primary pull-right'])?>
   
    <?php ActiveForm::end(); ?>
    
</div>

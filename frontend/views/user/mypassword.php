<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','my profile'),'url' => ['user/profile']],
    ['label' => Yii::t('app','change password'),'url' => ['user/chpassword']],
];

$this->title = Yii::t('app','change password');
?>
<div class="contact-page"> 
    <div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title" style="border-bottom: 1px solid #CCC">
	    <h4 style="margin-bottom:5px"><?=Yii::t('app','change password')?></h4>
	</div>	
    <div class="col-md-12 clearfix" style="margin-top:10px">
    <p class="text-danger"><?=Yii::$app->session->getFlash('msg')?></p>	
    <?php
	$total=0;
	$form = \yii\bootstrap\ActiveForm::begin([
	    'id' => 'form-cart',
	    'method' => 'post',
	    'options' => ['class' => 'register-form'],
	    'fieldConfig' => [
		'template' => '<div class="col-md-2">{label}</div><div class="col-md-10">{input}{error}</div>',
	    ],
    ]);?>
    <?=$form->field($formModel,'new_password')->passwordInput()?>
    <?=$form->field($formModel,'confirm_password')->passwordInput()?>
    <div class="col-md-12 clearfix">
	<?=\yii\helpers\Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','update'), ['class' => 'btn btn-primary pull-right','name' => 'post'])?>
    </div><!-- /.col action -->
    <div class="clearfix"></div>
    <?php \yii\bootstrap\ActiveForm::end()?>
    </div>
    
</div>

</div><!-- /.contact-page -->
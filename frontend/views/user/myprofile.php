<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','control panel'),'url' => ['user/profile']],
    ['label' => Yii::t('app','my profile'),'url' => ['user/profile']],
];

$this->title = Yii::t('app','basic information');
?>
<div class="contact-page"> 
    <div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title" style="border-bottom: 1px solid #CCC">
	    <h4 style="margin-bottom:5px"><?=Yii::t('app','basic information')?></h4>
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
    
    <?=$form->field($formModel,'first_name')->textInput()?>
    <?=$form->field($formModel,'middle_name')->textInput()?>
    <?=$form->field($formModel,'last_name')->textInput()?>
    <?=$form->field($formModel,'email')->textInput(['disabled' => true])?>
    <div class="col-md-12 clearfix">
	<?=\yii\helpers\Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','update profile'), ['class' => 'btn btn-primary pull-right','name' => 'post'])?>
        
    </div><!-- /.col action -->
    <div class="clearfix"></div>
    <?php \yii\bootstrap\ActiveForm::end()?>
    </div>
    
</div>
			</div><!-- /.contact-page -->


<?php
$js = <<<JS

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

$('#confirmationform-total_transfer').on('blur', function(e) {
    var total = formatNumber($(this).val());
    $(this).val(total);
});

JS;
$this->registerJs($js);
?>
<?php
$this->title = Yii::t('app','payment confirmation');
?>
<div class="contact-page">
    <div class="col-md-12 col-sm-12">
	<div class="row">
	<?=$this->render('tabPage')?>
	<hr class="separator">
	<div class="clearfix"></div>
	</div>
    </div>
    
    <div class="col-md-9 contact-form">
	<div class="col-md-12 contact-title">
	    <h4><?=Yii::t('app','payment confirmation')?></h4>
	</div>
        
        <div class="col-md-12 contact-description">
            <p>
		No invoice anda adalah <?=\yii\helpers\Html::a(Yii::t('app',$cart->invoice_no),['user/history_details','no'=>$cart->invoice_no])?> 
                Pembayaran dapat langsung di transfer dan konfirmasi pembayaran anda  dapat melalui langsung melalui
                Formulir Konfirmasi  <?=\yii\helpers\Html::a(Yii::t('app','this at'),['cart/confirmation'])?> ,
                atau ditunda , kami akan memberikan waktu 2X24 Jam untuk konfirmasi pembayaran dan  data transaksi akan tersimpan di 
               <?=\yii\helpers\Html::a(Yii::t('app','history transaction'),['user/history'])?>  Anda silahkan ikuti link berikut <?=\yii\helpers\Html::a(Yii::t('app','link history transaction'),['user/history'])?> 
            </p>
        </div>
    
    <?php
	$total=0;
	$form = \yii\bootstrap\ActiveForm::begin([
	    'id' => 'form-cart',
	    'method' => 'post',
	    'options' => ['class' => 'register-form'],
	    'fieldConfig' => [
		'template' => "{label}{input}{error}",
	    ],
    ]);?>
    
        <div class="col-md-4">
            <?=$form->field($formModel,'bank_account')->textInput();?>
        </div>
        
        <div class="col-md-4">
            <?=$form->field($formModel,'bank_name')->textInput();?>
        </div>
        
        <div class="col-md-4">
            <?=$form->field($formModel,'total_transfer')->textInput(['class' => 'form-control text-right']);?>
        </div>
        
        <div class="col-md-12">
            <?=$form->field($formModel,'description')->textarea();?>
        </div>
        
        <div class="col-md-12 outer-bottom-small m-t-20">
		<?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','confirm'), ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
	</div>
    
    <?php \yii\bootstrap\ActiveForm::end()?>
    
        
	
	
</div>
<div class="col-md-3 contact-info">
	<div class="contact-title">
		<h4><?=Yii::t('app','or manual confirmation')?></h4>
	</div>
	<div class="clearfix address">
		<span class="contact-i"><i class="fa fa-file"></i></span>
		<span class="contact-span"><?=\yii\helpers\Html::a(Yii::$app->setting->Variable('BBM Pin')->content)?></span>
	</div>
	<div class="clearfix phone-no">
		<span class="contact-i"><i class="fa fa-mobile"></i></span>
		<span class="contact-span"><?=\yii\helpers\Html::a(Yii::$app->setting->Variable('Hunting Phone')->content)?></span>
	</div>
	<div class="clearfix email">
		<span class="contact-i"><i class="fa fa-envelope"></i></span>
		<span class="contact-span"><?=\yii\helpers\Html::a(Yii::$app->setting->Variable('Email')->content)?></span>
	</div>
</div>			</div><!-- /.contact-page -->


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
<?php
use vileosoft\shoppingcart\Cart;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','shopping cart'),'url' => ['cart/shopping']],
    ['label' => Yii::t('app','shipping address'),'url' => ['cart/address']],
];
$this->title = Yii::t('app','shipping address');
?>
<div class="sign-in-page inner-bottom-sm">
    <div class="row">
	<div class="col-md-12 col-sm-12">
	    <div class="row">
		<?=$this->render('tabPage')?>
		<hr class="separator">
		<div class="clearfix"></div>
	    </div>
	</div>			    

	<!-- Sign-in -->			
	<div class="col-md-12 col-sm-12 sign-in">
	    <div class="social-sign-in outer-top-xs">
		<a href="<?=\yii\helpers\Url::to(['cart/address'])?>" style="<?=Yii::$app->controller->getRoute()=='cart/address'?'background:red':''?>" class="facebook-sign-in"><i class="fa fa-truck"></i> Via Ekspedisi</a>
		<a href="<?=\yii\helpers\Url::to(['cart/dropship'])?>" style="<?=Yii::$app->controller->getRoute()=='cart/dropship'?'background:red':''?>" class="facebook-sign-in"><i class="fa fa-download"></i> Via Dropship</a>
		<a href="<?=\yii\helpers\Url::to(['cart/cod'])?>" style="<?=Yii::$app->controller->getRoute()=='cart/cod'?'background:red':''?>" class="facebook-sign-in"><i class="fa fa-map-marker"></i> Cash On Delivery</a>
	    </div>
	    <hr class="separator">
		
	    <p style="color:red"><?=Yii::$app->session->getFlash('msg')?></p>	
	    
	    <?php
	    $form = \yii\bootstrap\ActiveForm::begin([
		'id' => 'form',
		'method' => 'post',
		'options' => ['class' => 'register-form outer-top-xs'],
		'fieldConfig' => [
		    'template' => '<div class="col-md-2">{label}</div><div class="col-md-10">{input}{error}</div>',
		],
	    ]);?>
	    <div class="loading" style="display: none" ><?=Yii::t('app/message','msg please wait do not refresh')?></div>
	    <?=$form->field($formModel,'latest_address')->dropdownList(\common\models\UserAddress::dropdownList(Yii::t('app','add new'),['user_id' => Yii::$app->user->getId()]),['id' => 'select'])?>
	    <?=$form->field($formModel,'address')->textarea(['rows' => 2,'placeholder' => Yii::t('app/message','msg put your address,rt,rw and kelurahan')])?>
	    <?=$form->field($formModel,'province_id')
	    ->dropdownList(\common\models\Province::dropdownList('-'),[
		'onchange' => '
		    $(".loading").show();
		    var info = "id=" + $(this).val();
		    $.ajax({
			url: "'.\yii\helpers\Url::to(['cart/province']).'",
			type: "post",
			data: info,
			success: function(data) {
			    if(data.success==true){
				$("#useraddress-city_id").removeAttr("disabled");
				$("#useraddress-town_id").val("0");
				$("#useraddress-city_id").html(data.result);
				$(".loading").hide();
			    }
			}
		    });
	    ']);?>
	    
	    <?=$form->field($formModel,'city_id')
	    ->dropdownList(\common\models\City::dropdownList('-'),[
		'disabled' => 'disabled',
		'onchange' => '
		    $(".loading").show();
		    var info = "id=" + $(this).val();
		    $.ajax({
			url: "'.\yii\helpers\Url::to(['cart/town']).'",
			type: "post",
			data: info,
			success: function(data) {
			    if(data.success==true){
				$("#useraddress-town_id").removeAttr("disabled");
				$("#useraddress-town_id").html(data.result);
				$(".loading").hide();
			    }
			}
		    });
	    ']);?>
	    	 
	    <?=$form->field($formModel,'town_id')->dropdownList(\common\models\Town::dropdownList('-'),['disabled' => 'disabled'],[
	    ])?>
	    
	    <?=$form->field($formModel,'receiver')->textInput()?>
	    <?=$form->field($formModel,'receiver_contact')->textInput()?>
	    <div class="col-md-12">
		<div class="pull-right action">
		<?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','finish'), ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
		<div class="clearfix" style="margin-bottom:10px"></div>
		</div><!-- /.action -->
	    </div><!-- /.col -->
	    
	    <?php \yii\bootstrap\ActiveForm::end() ?>
	    		
	</div>
	<!-- Sign-in -->		
    </div><!-- /.row -->
</div><!-- /.sigin-in-->

<?php
$url = \yii\helpers\Url::to(['cart/compile']);
$js = <<<JS
$('#select').on('change', function(e) {
    $(".loading").show();
    var info = 'id=' + $(this).val();
    $.ajax({
	url: '{$url}',
	type: 'post',
	data: info,
	success: function(data) {
            if(data.success==true){
		$('#useraddress-address').val(data.address);
		$('#useraddress-province_id').val(data.province);
		$('#useraddress-city_id').val(data.city);
		$('#useraddress-town_id').val(data.town);
		$('#useraddress-receiver').val(data.receiver);
		$('#useraddress-receiver_contact').val(data.receiver_contact);
		$('#useraddress-city_id').removeAttr('disabled');
		$('#useraddress-town_id').removeAttr('disabled');
		$(".loading").hide();
	    }
	    else {
		$('#useraddress-address').val("");
		$('#useraddress-province_id').val(0);
		$('#useraddress-city_id').val(0);
		$('#useraddress-town_id').val(0);
		$('#useraddress-receiver').val("");
		$('#useraddress-receiver_contact').val("");
		$('#useraddress-city_id').attr('disabled', 'disabled');
		$('#useraddress-town_id').attr('disabled', 'disabled');
		$(".loading").hide();	    
	    }
	}
    });
})
JS;
$this->registerJs($js);

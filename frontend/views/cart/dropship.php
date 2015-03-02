<?php
use vileosoft\shoppingcart\Cart;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','shopping cart'),'url' => ['cart/shopping']],
    ['label' => Yii::t('app','shipping address'),'url' => ['cart/dropship']],
];
$this->title = Yii::t('app','shopping cart');
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
	    <div class="loading" style="display: none" ><?=Yii::t('app/message','please wait do not refresh')?></div>
	    <?=$form->field($formModel,'latest_address')->dropdownList(\common\models\UserDropship::dropdownList(Yii::t('app','add new'),['user_id' => Yii::$app->user->getId()]),['id' => 'select'])?>
	    <?=$form->field($formModel,'sender')->textInput()?>
	    <?=$form->field($formModel,'sender_contact')->textInput()?>
	    <?=$form->field($formModel,'address')->textarea(['rows' => 2])?>
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
				$("#userdropship-city_id").removeAttr("disabled");
				$("#userdropship-town_id").val("0");
				$("#userdropship-city_id").html(data.result);
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
				$("#userdropship-town_id").removeAttr("disabled");
				$("#userdropship-town_id").html(data.result);
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
$url = \yii\helpers\Url::to(['cart/compile_dropship']);
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
		$('#userdropship-address').val(data.address);
		$('#userdropship-province_id').val(data.province);
		$('#userdropship-city_id').val(data.city);
		$('#userdropship-town_id').val(data.town);
		$('#userdropship-receiver').val(data.receiver);
		$('#userdropship-receiver_contact').val(data.receiver_contact);
		$('#userdropship-sender').val(data.sender);
		$('#userdropship-sender_contact').val(data.sender_contact);
		$('#userdropship-city_id').removeAttr('disabled');
		$('#userdropship-town_id').removeAttr('disabled');
		$(".loading").hide();
	    }
	    else {
		$('#userdropship-address').val("");
		$('#userdropship-province_id').val(0);
		$('#userdropship-city_id').val(0);
		$('#userdropship-town_id').val(0);
		$('#userdropship-receiver').val("");
		$('#userdropship-receiver_contact').val("");
		$('#userdropship-sender').val("");
		$('#userdropship-sender_contact').val("");
		$('#userdropship-city_id').attr('disabled', 'disabled');
		$('#userdropship-town_id').attr('disabled', 'disabled');
		$(".loading").hide();	    
	    }
	}
    });
})
JS;
$this->registerJs($js);

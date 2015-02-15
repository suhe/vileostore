<?php
use vileosoft\shoppingcart\Cart;
if($_POST){
    $cart->update($_POST);
    Yii::$app->controller->refresh();
}

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
	    
	    <p>
		<?=Yii::$app->setting->Variable('Store Name')->content;?> ,
		<?=Yii::$app->setting->Variable('Store Address')->content?> ,
		<?=Yii::$app->setting->Variable('Store City')->content?> ,
		<?=Yii::$app->setting->Variable('Store Pos Code')->content?> ,
		<?=Yii::$app->setting->Variable('Store Province')->content?> ,
		<?=Yii::$app->setting->Variable('Store Owner')->content?>,
		<?=Yii::$app->setting->Variable('Hunting Phone')->content?> ,
		Apabila sudah lunas dapat mengcapture / menyebutkan No Invoice yang sudah dibayar/lunas
	    </p>
	    <div class="col-md-12">
		<div class="pull-right action">
		<?=\yii\helpers\Html::a('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','finish'),['cart/payment/3'], ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
		<div class="clearfix" style="margin-bottom:10px"></div>
		</div><!-- /.action -->
	    </div><!-- /.col -->
    		
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

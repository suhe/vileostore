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
		<a href="#" style="background:red" class="facebook-sign-in"><i class="fa fa-truck"></i> Via Ekspedisi</a>
		<a href="#" class="facebook-sign-in"><i class="fa fa-download"></i> Via Dropship</a>
		<a href="#" class="facebook-sign-in"><i class="fa fa-map-marker"></i> Cash On Delivery</a>
	    </div>
	    <hr class="separator">
	    
	    <?php
	    $form = \yii\bootstrap\ActiveForm::begin([
		'id' => 'form',
		'method' => 'post',
		'options' => ['class' => 'register-form outer-top-xs'],
		'fieldConfig' => [
		    'template' => '<div class="col-md-2">{label}</div><div class="col-md-10">{input}{error}</div>',
		],
	    ]);?>
	    <div class="loading" style="display: none" ><?=Yii::t('app','please wait do not refresh .... ')?></div>
	    <?=$form->field($formModel,'latest_address')->dropdownList(\common\models\UserAddress::dropdownList(Yii::t('app','add new'),['user_id' => Yii::$app->user->getId()]),['id' => 'select'])?>
	    
	    <?=$form->field($formModel,'address')->textarea(['rows' => 2,'id'=>'address'])?>
	    <?=$form->field($formModel,'province_id')
	    ->dropdownList(\common\models\Province::dropdownList('-'),[
		'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('cart/province?id=').'" + $(this).val(),function(data){
			$("#useraddress-city_id").removeAttr("disabled");
			$("#useraddress-city_id").html(data);
		    });
	    ']);?>
	    
	    <?=$form->field($formModel,'city_id')
	    ->dropdownList(\common\models\City::dropdownList('-'),[
		'disabled' => 'disabled',
		'onchange' => '
			$(".loading").show();
			$.post("'.Yii::$app->urlManager->createUrl('cart/town?id=').'" + $(this).val(),function(data){
			    $("#useraddress-town_id").removeAttr("disabled");
			    $("#useraddress-town_id").html(data);
			    $(".loading").hide();
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
		    $('#address').val(data.address);
		    $('#useraddress-province_id').val(data.province);
		    $('#useraddress-city_id').val(data.city);
		    $('#useraddress-town_id').val(data.town);
		    $('#useraddress-city_id').removeAttr('disabled');
		    $('#useraddress-town_id').removeAttr('disabled');
		    $(".loading").hide();
		}
		else {
		    $('#address').val("");
		    $('#useraddress-province_id').val(0);
		    $('#useraddress-city_id').val(0);
		    $('#useraddress-town_id').val(0);
		    $('#useraddress-city_id').attr('disabled', 'disabled');
		    $('#useraddress-town_id').attr('disabled', 'disabled');
		    $(".loading").hide();
		    
		}
	    }
    });
})
JS;
$this->registerJs($js);

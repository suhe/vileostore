<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','address'),'url' => ['user/address']],
    ['label' => Yii::t('app','add address'),'url' => ['user/addaddress']],
];

$this->title = $title;
?>
<div class="contact-page"> 
    <div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title" style="border-bottom: 1px solid #CCC">
	    <h4 style="margin-bottom:5px"><?=$title?></h4>
	</div>
	
    <div class="col-md-12 clearfix" style="margin-top:10px">	
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
	    <div class="loading" style="display: none" ><?=Yii::t('app','please wait do not refresh .... ')?></div>
	    <?=$form->field($formModel,'address')->textarea(['rows' => 2])?>
	    <?=$form->field($formModel,'province_id')
	    ->dropdownList(\common\models\Province::dropdownList('-'),[
		'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('cart/province?id=').'" + $(this).val(),function(data){
			$("#useraddress-city_id").removeAttr("disabled");
			$("#useraddress-town_id").val("0");
			$("#useraddress-city_id").html(data);
		    });
	    ']);?>
	    
	    <?=$form->field($formModel,'city_id')
	    ->dropdownList(\common\models\City::dropdownList('-'),[
		'disabled' => $query?false:true,
		'onchange' => '
			$(".loading").show();
			$.post("'.Yii::$app->urlManager->createUrl('cart/town?id=').'" + $(this).val(),function(data){
			    $("#useraddress-town_id").removeAttr("disabled");
			    $("#useraddress-town_id").html(data);
			    $(".loading").hide();
			});
	    ']);?>
	    <?=$form->field($formModel,'town_id')->dropdownList(\common\models\Town::dropdownList('-'),['disabled' => $query?false:true,],[
	    ])?>
	    
	    <?=$form->field($formModel,'receiver')->textInput()?>
	    <?=$form->field($formModel,'receiver_contact')->textInput()?>
	    <div class="col-md-12">
		<div class="pull-right action">
		<?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','update'), ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
		<div class="clearfix" style="margin-bottom:10px"></div>
		</div><!-- /.action -->
	    </div><!-- /.col -->
	    
	    <?php \yii\bootstrap\ActiveForm::end() ?>
    </div>
</div>
</div><!-- /.contact-page -->

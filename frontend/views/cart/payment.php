<?php
use vileosoft\shoppingcart\Cart;
if($_POST){
    $cart->update($_POST);
    Yii::$app->controller->refresh();
}
$this->title = Yii::t('app','shopping cart');
?>
<div class="shopping-cart">
    <div class="col-md-12 col-sm-12">
	<div class="row">
	<?=$this->render('tabPage')?>
	<hr class="separator">
	<div class="clearfix"></div>
	</div>
    </div>
    
    
    
    <div class="col-md-offset-8 col-md-4 col-sm-12 cart-shopping-total">
    <table class="table table-bordered">
	<thead>
	    <tr>
		<th>
		    <div class="cart-sub-total">
			<?=Yii::t('app','sub total')?><span class="inner-left-md"><?=Yii::$app->formatter->asDecimal($cart->total(),2)?></span>
		    </div>		
		</th>
	    </tr>
	</thead><!-- /thead -->
	
        </table><!-- /table -->
    </div><!-- /.cart-shopping-total -->
    
    <?php
	$total=0;
	$form = \yii\bootstrap\ActiveForm::begin([
	    'id' => 'form-cart',
	    'method' => 'post',
	    'options' => ['class' => 'form-horizontal'],
	    'fieldConfig' => [
		'template' => "{input}{error}",
	    ],
    ]);?>
	    
    <div class="col-md-12 col-sm-12 shopping-cart-table clearfix">				
	<div class="table-responsive">    
	   
	    <table class="table table-bordered" style="margin-top:1px">
		<thead>
		    <tr>
			<th class="cart-romove item"><?=Yii::t('app','select')?></th>
			<th class="cart-description item"><?=Yii::t('app','image')?></th>
			<th class="cart-product-name item"><?=Yii::t('app','location')?></th>
			<th class="cart-qty item"><?=Yii::t('app','quantity')?> (.Kg)</th>
			<th class="cart-sub-total item"><?=Yii::t('app','cost')?></th>
			<th class="cart-total last-item"><?=Yii::t('app','sub total')?></th>
		    </tr>
		</thead><!-- /thead -->
		<tbody>
		
		
		 <?php foreach ($courier as $v){ ?>
		    <tr>
			<td class="romove-item">
			    <?=$form->field($formModel,"label_courier_id")->radio(['label' => '','value' => $v->id,'id'=>$v->id])?>
			</td>
			<td class="cart-image">
			    <a class="entry-thumbnail" href="<?=\yii\helpers\Url::to(['#','id'=>$v['id']])?>">
				<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				    '@image_courier/'.$v->id.'/'.$v['icon'],
				    146,
				    154,
				    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				    ['alt' => $v->name]
				);
				?>  
			    </a>
			</td>
			<td class="cart-product-name-info">
			    <h4 class='cart-product-description'><?=\yii\helpers\Html::a($v->town,['#'])?></h4>
			    <div class="row">
				<div class="col-sm-4">
				    <div class="rating rateit-small"></div>
				</div>
				<div class="col-sm-8">
				    <div class="reviews">
					(<?='8'?> <?=Yii::t('app','reviews')?>)
				    </div>
				</div>
			    </div><!-- /.row -->
				
			    <div class="cart-product-info">
				<span class="product-imel"><?=Yii::t('app','sku')?><span>ss</span></span><br>
			    </div>
			</td>
			
			<td class="cart-product-quantity">
			    <div class="quant-input">
				<?=Yii::$app->formatter->asDecimal($weight=1,2)?>
			    </div>
		        </td>
			<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?=Yii::$app->formatter->asDecimal($cost=$v->cost,2)?></span></td>
			<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?=Yii::$app->formatter->asDecimal($subtotal=$weight*$cost,2)?></span></td>
		    </tr>
		    <?php
		    $total+=$subtotal; 
		} ?>
	    
		</tbody><!-- /tbody -->
	    </table><!-- /table -->
	    
	    <hr class="separator">
	    
	    
	    <table class="table table-bordered" style="margin-top:1px">
		<thead>
		    <tr>
			<th class="cart-romove item"><?=Yii::t('app','select')?></th>
			<th class="cart-description item"><?=Yii::t('app','image')?></th>
			<th class="cart-product-name item"><?=Yii::t('app','owner')?></th>
			<th class="cart-sub-total item"><?=Yii::t('app','account')?></th>
		    </tr>
		</thead><!-- /thead -->
		<tbody>
		
		
		 <?php foreach (\common\models\Bank::getAccount() as $v){ ?>
		    <tr>
			<td class="romove-item">
			    <?=$form->field($formModel,"label_bank_id")->radio(['label' => '','value' => $v->id,'uncheckValue'=>null])?>
			</td>
			<td class="cart-image">
			    <a class="entry-thumbnail" href="<?=\yii\helpers\Url::to(['#','id'=>$v['id']])?>">
				<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				    '@image_bank/'.$v->id.'/'.$v['icon'],
				    146,
				    154,
				    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				    ['alt' => $v->name]
				);
				?>  
			    </a>
			</td>
			<td class="cart-product-name-info">
			    <h4 class='cart-product-description'><?=\yii\helpers\Html::a($v->owner,['#'])?></h4>
			    <div class="row">
				<div class="col-sm-8">
				    <div class="reviews">
					<?=$v->branch?>
				    </div>
				</div>
			    </div><!-- /.row -->
				
			    
			</td>
			<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?=$v->account?></span></td>
		    </tr>
		    <?php
		    
		} ?>
		
		</tbody><!-- /tbody -->
	    </table><!-- /table -->
	    
	</div>
</div><!-- /.shopping-cart-table -->


<div class="col-md-offset-8 col-md-4 col-sm-12 cart-shopping-total">
    <table class="table table-bordered">
	<thead>
	    <tr>
		<th>
		    <div class="cart-sub-total">
			<?=Yii::t('app','total')?><span class="inner-left-md"><?=Yii::$app->formatter->asDecimal(8000,2)?></span>
		    </div>		
		</th>
	    </tr>
	</thead><!-- /thead -->
	<tbody>
	    <tr>
		<td>
		    <div class="cart-checkout-btn pull-right">
			<div class="col-md-6">
			    <?=\yii\helpers\Html::a(Yii::t('app','continue shopping'),['site/index'],['class' => 'btn btn-primary'])?>
			</div>
			<div class="col-md-6">
			    <?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','finish'), ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
			</div>
			
		    </div>
		</td>
	    </tr>
	</tbody><!-- /tbody -->
        </table><!-- /table -->
    </div><!-- /.cart-shopping-total -->

<?php \yii\bootstrap\ActiveForm::end()?>



</div><!-- /.shopping-cart -->

<?php 
$js = <<<JS
$(".qty-cart").blur(function() {
    $("#form-cart").submit();
});
JS;
$this->registerJs($js);
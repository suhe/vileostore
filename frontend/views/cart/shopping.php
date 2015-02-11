<?php
use vileosoft\shoppingcart\Cart;
if($_POST){
    $cart->update($_POST);
    Yii::$app->controller->refresh();
}
?>
<div class="shopping-cart">
    <ul class="wizard-steps">
	<li data-target="#step1" class="active">
	    <span class="step">1</span>
	    <span class="title"><a href="cart.html">Shopping Cart</a></span>
	</li>
	
	<li data-target="#step2">
	    <span class="step">2</span>
	    <span class="title"><a href="address.html">Shipping Address</a></span>
	</li>
	
	<li data-target="#step3">
	    <span class="step">3</span>
	    <span class="title">Payment</span>
	</li>
	
	<li data-target="#step4">
	    <span class="step">4</span>
	    <span class="title">Finish</span>
	</li>
    </ul>
				
    <div class="col-md-12 col-sm-12 shopping-cart-table ">				
	<div class="table-responsive">
	    <table class="table table-bordered">
		<thead>
		    <tr>
			<th class="cart-romove item">Remove</th>
			<th class="cart-description item">Image</th>
			<th class="cart-product-name item">Product Name</th>
			<th class="cart-edit item"><?=Yii::t('app','view')?></th>
			<th class="cart-qty item">Quantity</th>
			<th class="cart-sub-total item">Subtotal</th>
			<th class="cart-total last-item">Grandtotal</th>
		    </tr>
		</thead><!-- /thead -->
		<tfoot>
		    <tr>
			<td colspan="7">
			    <div class="shopping-cart-btn">
				<span class="">
				    <a href="#" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
				    <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a>
				</span>
			    </div><!-- /.shopping-cart-btn -->
			</td>
		    </tr>
		</tfoot>
		<tbody>
		 <?php foreach ($cart->contents() as $items){ ?>
		    <tr>
			<td class="romove-item"><a href="<?=\yii\helpers\Url::to(['cart/remove','id'=>$items['rowid']])?>" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
			<td class="cart-image">
			    <a class="entry-thumbnail" href="<?=\yii\helpers\Url::to(['product/read','id'=>$items['id']])?>">
				<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				    '@image_product/'.$items['id'].'/'.$items['options']['image'],
				    146,
				    154,
				    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				    ['alt' => $items['name']]
				);
				?>  
			    </a>
			</td>
			<td class="cart-product-name-info">
			    <h4 class='cart-product-description'><?=\yii\helpers\Html::a($items['name'],['product/read','id'=>$items['id']])?></h4>
			    <div class="row">
				<div class="col-sm-4">
				    <div class="rating rateit-small"></div>
				</div>
				<div class="col-sm-8">
				    <div class="reviews">
					(08 Reviews)
				    </div>
				</div>
			    </div><!-- /.row -->
				
			    <div class="cart-product-info">
				<span class="product-imel">IMEL:<span>084628312</span></span><br>
				<span class="product-color">COLOR:<span>White</span></span>
			    </div>
			</td>
			<td class="cart-product-edit"><?=\yii\helpers\Html::a(Yii::t('app','view'),['product/read','id'=>$items['id']])?></td>
			<td class="cart-product-quantity">
			    <div class="quant-input">
				<!--<div class="arrows">
				    <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
				    <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
				</div>-->
				<input type="text" id="kat" value="1">
			    </div>
		        </td>
			<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?=Yii::$app->formatter->asDecimal($items['price'],2)?></span></td>
			<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?=Yii::$app->formatter->asDecimal($items['price'] * $items['qty'],2)?></span></td>
		    </tr>
		<?php } ?>
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
						Subtotal<span class="inner-left-md">$600.00</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$600.00</span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<button type="submit" class="btn btn-primary">PROCCED TO CHEKOUT</button>
							<span class="">Checkout with multiples address!</span>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->
			</div><!-- /.shopping-cart -->

<?php 
$js = <<<JS
$("#kat").blur(function(){ 
    $(location).attr('href','/vileostore/index.jsp/cart/basket/3');
});
JS;
$this->registerJs($js);
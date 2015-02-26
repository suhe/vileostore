<?php
use vileosoft\shoppingcart\Cart;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','shopping cart'),'url' => ['cart/shopping']],
];

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
    
    <div class="col-md-12 col-sm-12 shopping-cart-table clearfix">				
	<div class="table-responsive">
	    <table class="table table-bordered">
		<thead>
		    <tr>
			<th class="cart-romove item"><?=Yii::t('app','remove')?></th>
			<th class="cart-description item"><?=Yii::t('app','image')?></th>
			<th class="cart-product-name item"><?=Yii::t('app','product name')?></th>
			<th class="cart-edit item"><?=Yii::t('app','weight')?></th>
			<th class="cart-qty item"><?=Yii::t('app','quantity')?></th>
			<th class="cart-sub-total item"><?=Yii::t('app','price')?></th>
			<th class="cart-total last-item"><?=Yii::t('app','sub total')?></th>
		    </tr>
		</thead><!-- /thead -->
		<tbody>
		<?php
		$total=0;
		$form = \yii\bootstrap\ActiveForm::begin([
		    'id' => 'form-cart',
		    'method' => 'post',
		    'options' => ['class' => 'form-horizontal'],
		    'fieldConfig' => [
			'template' => "{input}{error}",
		    ],
		]);			
		 foreach ($cart->contents() as $i=>$items){ ?>
		    <tr>
			<td class="romove-item"><a href="<?=\yii\helpers\Url::to(['cart/remove','id'=>$items['rowid']])?>" title="cancel" class="icon" onclick="return confirm('<?=Yii::t('app/message','msg are you sure want to delete')?>');"><i class="fa fa-trash-o"></i></a></td>
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
			    <h4 class='cart-product-description'><?=\yii\helpers\Html::a($items['name'],['product/read','id'=>$items['id'],'slug' => $items['options']['slug']])?></h4>
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
				<span class="product-imel"><?=Yii::t('app','sku')?><span><?=$items['options']['sku']?></span></span><br>
				<span class="product-color"><?=Yii::t('app','weight')?>:<span><?=$items['weight']?> <?=Yii::$app->params['weight']?></span></span>
			    </div>
			</td>
			<td class="cart-product-edit"><?=Yii::$app->Formatter->asDecimal($items['weight_qty'],0)?> <?=Yii::$app->params['weight']?></td>
			<td class="cart-product-quantity">
			    <div class="quant-input">
				<?php // $form->field($formModel,"rowid[$i]")->textInput(['value' => $items["rowid"],'class' => 'form-control text-right qty-cart'])?>
				<?=$form->field($formModel,"qty[$i]")->textInput(['value' => $items["qty"],'class' => 'form-control text-right qty-cart'])?>
			    </div>
		        </td>
			<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?=Yii::$app->formatter->asDecimal($items['price'],2)?></span></td>
			<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?=Yii::$app->formatter->asDecimal($subtotal = $items['price'] * $items['qty'],2)?></span></td>
		    </tr>
		    <?php
		    $total+=$subtotal; 
		} ?>
		<?php \yii\bootstrap\ActiveForm::end()?>
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
			<?=Yii::t('app','total')?><span class="inner-left-md"><?=Yii::$app->formatter->asDecimal($total,2)?></span>
		    </div>		
		</th>
	    </tr>
	</thead><!-- /thead -->
	<tbody>
	    <tr>
		<td>
		    <div class="cart-checkout-btn pull-right">
			<?=\yii\helpers\Html::a(Yii::t('app','continue shopping'),['site/index'],['class' => 'btn btn-primary'])?>
			<?=\yii\helpers\Html::a(Yii::t('app','checkout'),['cart/address'],['class' => 'btn btn-primary'])?>
		    </div>
		</td>
	    </tr>
	</tbody><!-- /tbody -->
    </table><!-- /table -->
</div><!-- /.cart-shopping-total -->

</div><!-- /.shopping-cart -->

<?php 
$js = <<<JS
$(".qty-cart").blur(function() {
    $("#form-cart").submit();
});
JS;
$this->registerJs($js);
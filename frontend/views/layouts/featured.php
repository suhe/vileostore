<!-- ============================================== FEATURED PRODUCT ============================================== -->
<section class="section featured-product outer-top-small wow fadeInUp">
    <h3 class="section-title"><?=Yii::t('app','limited deal')?></h3>
    <div class="owl-carousel home-owl-carousel  custom-carousel owl-theme outer-top-xs" >
	<?php foreach(\common\models\Product::GetProductByCategory(36,5,1) as $row){?>
	<div class="item item-carousel">
	    <div class="products">		
		<div class="product">		
		    <div class="product-image">
			<div class="image">
			    <a href="<?=\yii\helpers\Url::to(['product/read','id'=>$row->id])?>">
				<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				'@image_product/'.$row->id.'/'.$row->image,
				347,
				270,
				\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				['alt' => $row->name]
			    );?>    
			    </a>
			</div><!-- /.image -->			
			<!-- /.image -->
			<div class="tag hot"><span><?=Yii::t('app','hot')?></span></div>		   
		    </div><!-- /.product-image -->
		    <!-- /.product-info -->
		    <div class="product-info text-left">
			<h3 class="name"><?=\yii\helpers\Html::a($row->name,['product/read','id'=>$row->id])?></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>
			<div class="product-price">	
			    <span class="price"><?=Yii::$app->Formatter->asDecimal($row->price,2)?></span>
			    <span class="price-before-discount"><?=Yii::$app->Formatter->asDecimal($row->price+1000,2)?></span>					
			</div><!-- /.product-price -->
			</div><!-- /.product-info -->
			<div class="action">
			    <?php if($row->stock>0){?> 
			    <?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->id],['class'=>'btn btn-primary'])?>
			    <?php } else { ?>
			    <?=\yii\helpers\Html::a(Yii::t('app','empty'),['product/category','id'=>$row->category_id],['class'=>'btn btn-primary'])?>
			    <?php } ?>
			</div>
		</div><!-- /.product -->
	    </div><!-- /.products -->
	</div><!-- /.item -->
	<?php } ?>
    </div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== FEATURED PRODUCT : END ============================================== -->
<div class="row">									
<?php foreach($query as $row){ ?>					
    <div class="col-sm-6 col-md-4 wow fadeInUp">
	<div class="products">
	    <div class="product">		
		<div class="product-image">
		    <div class="image">
			<a href="<?=\yii\helpers\Url::to(['product/read','id' => $row->product_id])?>">
			    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				'@image_product/'.$row->product_id.'/'.$row->image,
				347,
				270,
				\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				['alt' => $row->name]
			    );?>    
			</a>
		    </div><!-- /.image -->			
		<!--<div class="tag new"><span>new</span></div>-->                        		   
		</div><!-- /.product-image -->
		<!-- product-info -->	
		<div class="product-info text-left">
		    <h3 class="name"><?=\yii\helpers\Html::a($row->name,['product/read','id'=>$row->product_id])?></h3>
		    <div class="rating rateit-small"></div>
		    <div class="description"></div>
			<!-- /.product-price -->
			<div class="product-price">	
			    <span class="price"><?=Yii::$app->formatter->asDecimal($row->price)?></span>
			    <span class="price-before-discount">$ 800</span>					
			</div><!-- /.product-price -->
		</div>
		<!-- /.product-info -->
		
		<div class="cart clearfix animate-effect">		
		    <!-- /.action -->
		    <div class="action" style="margin-bottom:10px ">
			<ul class="list-inline">
			    <li><?=\yii\helpers\Html::a('<i class="fa fa-file"></i> '.$row->online?Yii::t('app','online'):Yii::t('app','not online'),['#'])?></li>
			    <li><?=\yii\helpers\Html::a('<i class="fa fa-map-marker"></i> '.$row->cod?Yii::t('app','cash on delivery'):Yii::t('app','not cod'),['#'])?></li>
			    <li><?=\yii\helpers\Html::a('<i class="fa fa-umbrella"></i> '.$row->dropshier?Yii::t('app','dropshier'):Yii::t('app','not dropshier'),['#'])?></li>
			</ul><!-- /.social-icons -->
		    </div><!-- /.action -->
		    <!-- /.action -->		
		    <div class="action">
			<ul class="list-unstyled">
			    <li class="add-cart-button btn-group">
				<button class="btn btn-primary icon" data-toggle="dropdown" type="button"><i class="fa fa-shopping-cart"></i></button>													</button>
				<?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->product_id],['class'=>'btn btn-primary'])?>
			    </li>
			</ul>
		    </div><!-- /.action -->    
		</div>
		<!-- /.cart -->
	    </div><!-- /.product -->
      
	</div><!-- /.products -->
    </div><!-- /.item -->
<?php }?>		
										</div><!-- /.row -->
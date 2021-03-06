<div class="row">									
<?php foreach($query as $row){ ?>					
    <div class="col-sm-6 col-md-4 wow fadeInUp">
	<div class="products">
	    <div class="product">
		<div class="product-info text-left">
		    <h5 class="name text-sm"><?=\yii\helpers\Html::a(substr($row->name,0,38),['product/read','id' => $row->product_id,'slug'=>$row->product_slug])?></h5>
		</div>
		<div class="product-image">
		    <div class="image image-grid">
			<a href="<?=\yii\helpers\Url::to(['product/read','id' => $row->product_id,'slug'=>$row->product_slug])?>">
			    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				'@image_product/'.$row->product_id.'/'.$row->image,
				200,
				200,
				\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				[
				    'alt' => $row->name,
				    'class' => 'img-responsive',
				]
			    );?>    
			</a>
		    </div><!-- /.image -->			
		<!--<div class="tag new"><span>new</span></div>-->                        		   
		</div><!-- /.product-image -->
		<!-- product-info -->	
		<div class="product-info text-center">
		    <div class="description"></div>
		    <!--<h5 class="name text-sm"><?php // \yii\helpers\Html::a(substr($row->name,0,30),['product/read','id' => $row->product_id,'slug'=>$row->product_slug])?></h5>-->
		    <div class="rating rateit-small"></div>
		    <div class="description"></div>
			<!-- /.product-price -->
			<div class="product-price">	
			    <span class="price"><?=Yii::$app->formatter->asDecimal($row->price)?></span>
			    <span class="price-before-discount"><?=Yii::$app->formatter->asDecimal($row->price+10000)?></span>					
			</div><!-- /.product-price -->
		</div>
		<!-- /.product-info -->
		
		<div class="cart clearfix animate-effect">		
		    <!-- /.action -->
		    <div class="action col-md-12" style="margin-bottom:10px">
			<ul class="list-inline">
			    <?php if($row->stock>0){ ?>
			    <li><i class="fa fa-file"></i> <?=\yii\helpers\Html::a($row->online?Yii::t('app','online'):Yii::t('app','not online'),['#'])?></li>
			    <li><i class="fa fa-map-marker"></i> <?=\yii\helpers\Html::a($row->cod?Yii::t('app','cod'):Yii::t('app','not cod'),['#'])?></li>
			    <li><i class="fa fa-umbrella"></i> <?=\yii\helpers\Html::a($row->dropshier?Yii::t('app','dropshier'):Yii::t('app','not dropshier'),['#'])?></li>
			    <?php } else { ?>
			    <li><i class="fa fa-time"></i> <?=Yii::t('app','in stock').' '.Yii::$app->formatter->asDate($row->arrival_date,'php:d M Y');?> </li>
			    <?php } ?>
			</ul><!-- /.social-icons -->
		    </div><!-- /.action -->
		    <!-- /.action -->
		    
		    <div class="action col-md-12">
			<div class="col-centered">
			    <ul class="list-unstyled">
				<li class="add-cart-button btn-group">
				    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"><i class="fa fa-shopping-cart"></i></button>
				    <?php if($row->stock>0){?>
				    <?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->product_id,'slug'=>$row->product_slug],['class'=>'btn btn-primary'])?>
				    <?php } else { ?>
				    <?=\yii\helpers\Html::a(Yii::t('app','empty'),['product/read','id'=>$row->product_id,'slug'=>$row->product_slug],['class'=>'btn btn-primary'])?>
				    <?php } ?>    
				</li>
				<li class="lnk wishlist">
				    <a title="Wishlist" href="#" class="add-to-cart">
					<?php
					if($row->stock>0){
					    echo Yii::t('app','in stock');
					}
					?>
				        <i class="icon fa fa-heart"></i>
				    </a>
				</li>
				<!--<li class="lnk">
				    <a title="Compare" href="#" class="add-to-cart">
					<i class="fa fa-retweet"></i>
				    </a>
				</li>-->
			    </ul>
			</div>
		    </div><!-- /.action -->    
		</div>
		<!-- /.cart -->
	    </div><!-- /.product -->
	</div><!-- /.products -->
    </div><!-- /.item -->
<?php }?>									
</div><!-- /.row -->
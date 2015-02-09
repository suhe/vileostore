<?php foreach($query as $row){ ?>
<div class="category-product-inner wow fadeInUp">
    <div class="products">				
	<div class="product-list product">
            <div class="row product-list-row">
                <div class="col col-sm-4 col-lg-4">
		    <div class="product-image">
			<div class="image">
			    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				'@image_product/'.$row->product_id.'/'.$row->image,
				347,
				270,
				\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				['alt' => $row->name]
			    );?>    
			</div>
		    </div><!-- /.product-image -->
		</div><!-- /.col -->
		
                <div class="col col-sm-8 col-lg-8">
		    <div class="product-info">
			<h3 class="name"><?=\yii\helpers\Html::a($row->name,['product/read','id'=>$row->product_id])?></h3>
			<div class="rating rateit-small"></div>
			<!-- product-price -->
                        <div class="product-price">	
			    <span class="price"><?=Yii::$app->formatter->asDecimal($row->price)?></span>
                            <span class="price-before-discount"><?=Yii::$app->formatter->asDecimal($row->price+10000)?></span>
			</div><!-- /.product-price -->
			<div class="description m-t-10"><?=$row->short_description?></div>
                	<div class="cart clearfix animate-effect">
			    <div class="action col-md-12 col-sm-12">
				<div class="row">
				    <!-- col -->
				    <div class=" col-md-8 col-sm-8 social-icons">
					<ul class="list-inline">
					    <li><i class="fa fa-file"></i> <?=\yii\helpers\Html::a($row->online?Yii::t('app','online'):Yii::t('app','not online'),['#'])?></li>
					    <li><i class="fa fa-map-marker"></i> <?=\yii\helpers\Html::a($row->cod?Yii::t('app','cash on delivery'):Yii::t('app','not cod'),['#'])?></li>
					    <li><i class="fa fa-umbrella"></i> <?=\yii\helpers\Html::a($row->dropshier?Yii::t('app','dropshier'):Yii::t('app','not dropshier'),['#'])?></li>
					</ul><!-- /.social-icons -->
				    </div>
				    <!-- /.col -->
				    <!-- col -->
				    <div class="col-md-4 col-sm-4">
					<ul class="list-unstyled pull-right">
					    <li class="add-cart-button btn-group">
						<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
						    <i class="fa fa-shopping-cart"></i>													
						</button>
						<?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->product_id],['class'=>'btn btn-primary'])?>
					    </li>
					</ul>
				    </div>
				</div>
			    </div><!-- /.action -->
		        </div><!-- /.cart -->					
		    </div><!-- /.product-info -->	
		</div><!-- /.col -->
	    </div><!-- /.product-list-row -->
	    <!--<div class="tag new"><span>new</span></div>-->
	</div><!-- /.product-list -->
    </div><!-- /.products -->
</div><!-- /.category-product-inner -->
<?php }?>
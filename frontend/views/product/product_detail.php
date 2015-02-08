<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app',$category->name),'url' => ['product/category','id'=>$category->id]],
    ['label' => \yii\helpers\Html::encode($data->name),'url' => ['product/read','id'=>$data->id]]
];?>

<div class="row  wow fadeInUp">
    <div class="col-xs-12 col-sm-6 col-md-4 gallery-holder">
	<div class="product-item-holder size-big single-product-gallery small-gallery">
	    <div id="owl-single-product">
		<?php
		$id=1;
		foreach($images as $image){?>
		<!-- /.single-product-gallery-item -->
		<div class="single-product-gallery-item" id="data<?=$id?>">
		    <a data-lightbox="image-1" data-title="Gallery" href="<?=Yii::$app->params['baseUrl'] ?>assets/images/products/<?=$image->product_id?>/<?=$image->name?>">
			<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				    '@image_product/'.$image->product_id.'/'.$image->name,
				    347,
				    270,
				    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				    ['alt' => $image->name]
			);?>
				
			
		    </a>
		</div><!-- /.single-product-gallery-item -->
		<?php $id++; } ?>
	    </div><!-- /.single-product-slider -->

	    <div class="single-product-gallery-thumbs second-gallery-thumb gallery-thumbs">
		<div id="owl-single-product2-thumbnails">
		    <?php
		    $id=1;
		    foreach($images as $image){?>
		    <div class="item">
			<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="<?=($id-1)?>" href="#data<?=$id?>">
			    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
			    '@image_product/'.$image->product_id.'/'.$image->name,
			    47,
			    65,
			    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
			    ['alt' => $data->name]
			);?>
			</a>
		    </div>
		    <?php $id++; } ?>
		    
		</div><!-- /#owl-single-product-thumbnails -->
        
		<div class="nav-holder left">
		    <a class="prev-btn slider-prev" data-target="#owl-single-product2-thumbnails" href="#prev"></a>
		</div><!-- /.nav-holder -->
		<div class="nav-holder right">
		   <a class="next-btn slider-next" data-target="#owl-single-product2-thumbnails" href="#next"></a>
		</div><!-- /.nav-holder -->
            </div><!-- /.gallery-thumbs -->

	</div><!-- /.single-product-gallery -->
    </div><!-- /.gallery-holder -->	        			
    
    <div class='col-sm-6 col-md-8 product-info-block'>
	<div class="product-info">
	    <h1 class="name"><?=$data->name?> <?=Yii::$app->controller->getRoute()?></h1>
		<div class="rating-reviews m-t-20">
		    <div class="row">
			<div class="col-sm-2">
			    <div class="rating rateit-small"></div>
			</div>
			
			<div class="col-sm-8">
			    <div class="reviews">
				<a href="#" class="lnk">(<?=$data->counter?> <?=Yii::t('app','views')?>)</a>
			    </div>
			</div>
		    </div><!-- /.row -->		
		</div><!-- /.rating-reviews -->

		<div class="stock-container info-container m-t-10">
		    <div class="row">
			<div class="col-sm-2">
			    <div class="stock-box">
				<span class="label"><?=\Yii::t('app','availability')?> :</span>
			    </div>	
			</div>
			<div class="col-sm-10">
			    <div class="stock-box">
				<span class="value"><?=$data->stock>0?Yii::t('app','in stock'):Yii::t('app','empty')?></span>
			    </div>	
			</div>
		    </div><!-- /.row -->	
		</div><!-- /.stock-container -->
		<!-- /.description-container -->
		<div class="description-container m-t-20">
		    <?=$data->short_description?>
		</div><!-- /.description-container -->
                                                                
		<div class="row outer-top-vs">
		    <div class="col-md-12 clearfix animate-effect">
			<!-- /.action -->
			<div class="action pull-right">
			    <?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$data->id],['class'=>'btn btn-primary'])?>
			</div><!-- /.action -->
			<div class="clearfix"></div>
		    </div>
		</div>

		<div class="row product-social-link outer-top-vs">
		    <!-- /.col -->
		    <div class="col-md-3 col-sm-3">
			<span class="label"><?=Yii::t('app','via')?></span>
                    </div><!-- /.col -->
		    <!-- /.col -->
		    <div class=" col-md-9 col-sm-9 social-icons">
			<ul class="list-inline">
			    <li><a href="#"><i class="fa fa-file"></i> <?=$data->online?Yii::t('app','online'):Yii::t('app','not online')?></a></li>
			    <li><a href="#"><i class="fa fa-map-marker"></i> <?=$data->online?Yii::t('app','cash on delivery'):Yii::t('app','not cod')?></a></li>
			    <li><a href="#"><i class="fa fa-umbrella"></i> <?=$data->online?Yii::t('app','dropshier'):Yii::t('app','not dropshier')?></a></li>
			</ul><!-- /.social-icons -->
		    </div>
		</div><!-- /.row -->
		
	    </div><!-- /.product-info -->
	</div><!-- /.col-sm-5 -->
    </div><!-- /.row -->
    
    <div class="product-tabs outer-top-smal  wow fadeInUp">
	<ul id="product-tabs" class="nav nav-tabs nav-tab-cell-detail">
	    <li class="active"><a data-toggle="tab" href="#description"><?=Yii::t('app','description')?></a></li>
	    <li><a data-toggle="tab" href="#tags"><?=Yii::t('app','asked question')?></a></li>
	</ul><!-- /.nav-tabs #product-tabs -->
	
	<div class="tab-content outer-top-xs">
	    <div id="description" class="tab-pane in active">
		<div class="product-tab">
		    <p class="text"><?=$data->long_description?><p>
		</div>	
	    </div><!-- /.tab-pane -->

	    <div id="tags" class="tab-pane">
		<div class="product-tag">

										<h4 class="title">Product Tags</h4>
										<form role="form" class="form-inline form-cnt">
											<div class="form-container">

												<div class="form-group">
													<label for="exampleInputTag">Add Your Tags: </label>
													<input type="email" id="exampleInputTag" class="form-control txt">


												</div>

												<button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
											</div><!-- /.form-container -->
										</form><!-- /.form-cnt -->

										<form role="form" class="form-inline form-cnt">
											<div class="form-group">
												<label>&nbsp;</label>
												<span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
											</div>
										</form><!-- /.form-cnt -->

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->

						</div><!-- /.product-tabs -->
					</div><!-- /.col -->
				</div><!-- /.row -->

					
			

		<!-- ============================================== FEATURED PRODUCT ============================================== -->

			<section class="section featured-product outer-top-small wow fadeInUp">
				<h3 class="section-title">featured products</h3>
				<div class="owl-carousel home-owl-carousel  custom-carousel owl-theme outer-top-xs" >
				    	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="index.php?page=detail"><img  src="<?=Yii::$app->params['baseUrl'] ?>assets/images/blank.gif" data-echo="<?=Yii::$app->params['baseUrl'] ?>assets/images/fashion-products/1.jpg" alt=""></a>
			</div><!-- /.image -->			

			                        <div class="tag hot"><span>hot</span></div>		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="index.php?page=detail">Simple Product Demo</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="index.php?page=detail"><img  src="<?=Yii::$app->params['baseUrl'] ?>assets/images/blank.gif" data-echo="<?=Yii::$app->params['baseUrl'] ?>assets/images/fashion-products/2.jpg" alt=""></a>
			</div><!-- /.image -->			

			<div class="tag new"><span>new</span></div>                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="index.php?page=detail">Simple Product Demo</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="index.php?page=detail"><img  src="<?=Yii::$app->params['baseUrl'] ?>assets/images/blank.gif" data-echo="<?=Yii::$app->params['baseUrl'] ?>assets/images/fashion-products/3.jpg" alt=""></a>
			</div><!-- /.image -->			

			            <div class="tag sale"><span>sale</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="index.php?page=detail">Simple Product Demo</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="index.php?page=detail"><img  src="<?=Yii::$app->params['baseUrl'] ?>assets/images/blank.gif" data-echo="<?=Yii::$app->params['baseUrl'] ?>assets/images/fashion-products/4.jpg" alt=""></a>
			</div><!-- /.image -->			

			                        <div class="tag hot"><span>hot</span></div>		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="index.php?page=detail">Simple Product Demo</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="index.php?page=detail"><img  src="<?=Yii::$app->params['baseUrl'] ?>assets/images/blank.gif" data-echo="<?=Yii::$app->params['baseUrl'] ?>assets/images/fashion-products/4.jpg" alt=""></a>
			</div><!-- /.image -->			

			            <div class="tag sale"><span>sale</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="index.php?page=detail">Simple Product Demo</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="index.php?page=detail"><img  src="<?=Yii::$app->params['baseUrl'] ?>assets/images/blank.gif" data-echo="<?=Yii::$app->params['baseUrl'] ?>assets/images/fashion-products/6.jpg" alt=""></a>
			</div><!-- /.image -->			

			<div class="tag new"><span>new</span></div>                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="index.php?page=detail">Simple Product Demo</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
						</div><!-- /.home-owl-carousel -->
			</section><!-- /.section -->
		<!-- ============================================== FEATURED PRODUCT : END ============================================== -->

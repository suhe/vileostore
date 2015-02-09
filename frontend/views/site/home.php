<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','home page'),'url' => ['site/index']],  
];
$this->title = Yii::t('app','home page')
?> 
<!-- ============================================== CONTENT ============================================== -->

<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
    <!-- ========================================== SECTION – HERO ========================================= -->			
    <div id="hero">
        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
	    <?php foreach(\common\models\Banner::homePageBanner('home') as $row){?>	
	    <div class="item" style="background-image: url(<?=Yii::$app->homeUrl?>/assets/images/banners/<?=$row->id?>/<?=$row->image?>);">
		<div class="container-fluid">
		    <div class="caption bg-color vertical-center text-left">
			<div class="big-text fadeInDown-1">
			    <?=$row->name?>
			</div>
			<div class="excerpt fadeInDown-2 hidden-xs">
			    <span><?=$row->description?></span>
			</div>
			<div class="button-holder fadeInDown-3">
			    <a href="<?=$row->link_url?>" class="btn-lg btn btn-uppercase btn-primary shop-now-button"><?=Yii::t('app','buy now')?></a>
			</div>
		    </div><!-- /.caption -->
		</div><!-- /.container-fluid -->
	    </div><!-- /.item -->
            <?php } ?>
	</div><!-- /.owl-carousel -->
    </div>			
    <!-- ========================================= SECTION – HERO : END ========================================= -->	

<!-- ============================================== INFO BOXES ============================================== -->
<div class="info-boxes wow fadeInUp">
	<div class="info-boxes-inner">
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
						     <i class="icon fa fa-dollar"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading green">money back</h4>
						</div>
					</div>	
					<h6 class="text">30 Day Money Back Guarantee.</h6>
				</div>
			</div><!-- .col -->

			<div class="col-md-4 col-sm-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-truck"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading orange">free shipping</h4>
						</div>
					</div>
					<h6 class="text">free ship-on oder over $600.00</h6>	
				</div>
			</div><!-- .col -->

			<div class="col-md-4 col-sm-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-gift"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading red">Special Sale</h4>
						</div>
					</div>
					<h6 class="text">All items-sale up to 20% off </h6>	
				</div>
			</div><!-- .col -->
		</div><!-- /.row -->
	</div><!-- /.info-boxes-inner -->
	
</div><!-- /.info-boxes -->
<!-- ============================================== INFO BOXES : END ============================================== -->

<!-- ============================================== SCROLL TABS ============================================== -->
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix ">
	<h3 class="new-product-title pull-left"><?=Yii::t('app','new product')?></h3>
	<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
	<?php foreach(\common\models\Category::ListCategory([6,1,3]) as $category){?>
	    <li><a <?=($category->id==6?'style="color:#12cca7"':'')?> data-transition-type="backSlide" href="#<?=$category->id?>" data-toggle="tab"><?=$category->name?></a></li>
	<?php } ?>
	</ul><!-- /.nav-tabs -->
    </div>

    <div class="tab-content outer-top-xs">
	<?php foreach(\common\models\Category::ListCategory([6,1,3]) as $category){?>
	<div class="tab-pane in active" id="<?=$category->id?>">			
	    <div class="product-slider">
		<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">		    	
		    <?php foreach(\common\models\Product::NewProduct(5,$category->id) as $row){?>
		    <!-- /.item -->
		    <div class="item item-carousel">
			<div class="products">
			    <div class="product">		
				<div class="product-image">
				    <div class="image">
					<a href="<?=\yii\helpers\Url::to(['product/read','id'=>$row->id])?>">
					    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
						'@image_product/'.$row->id.'/'.$row->image,
						195,
						243,
						\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
						['alt' => $row->name]
					    );?>  
					</a>
				    </div><!-- /.image -->			
			            <div class="tag hot"><span>hot</span></div>		   
				</div><!-- /.product-image -->
			
				<!-- /.product-info -->
				<div class="product-info text-left">
				    <h3 class="name"><?=\yii\helpers\Html::a($row->name,['product/read','id'=>$row->id])?></h3>
				    <div class="rating rateit-small"></div>
				    <div class="description"></div>
				    <div class="product-price">	
					<span class="price"><?=Yii::$app->formatter->asDecimal($row->price)?></span>
					<span class="price-before-discount"><?=Yii::$app->formatter->asDecimal($row->price+10000)?></span>						
				    </div><!-- /.product-price -->
				</div>
				<!-- /.product-info -->
				<div class="cart clearfix animate-effect">
				    <div class="action">
					<ul class="list-unstyled">
					    <li class="add-cart-button btn-group">
						<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
						    <i class="fa fa-shopping-cart"></i>													
						</button>
						<?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->id],['class'=>'btn btn-primary'])?>							
					    </li>
					</ul>
				    </div><!-- /.action -->
				</div><!-- /.cart -->
			    </div><!-- /.product -->
			</div><!-- /.products -->
		    </div><!-- /.item -->
		<?php } ?>
		</div><!-- /.home-owl-carousel -->
	    </div><!-- /.product-slider -->
	</div><!-- /.tab-pane -->
	<?php } ?>
	
    </div><!-- /.tab-content -->
</div><!-- /.scroll-tabs -->
<!-- ============================================== SCROLL TABS : END ============================================== -->

<!-- ============================================== WIDE PRODUCTS ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-vs">
    <div class="row">
	<div class="col-md-7">
		    <div class="wide-banner cnt-strip">
				<div class="image">
					<img class="img-responsive" data-echo="<?=Yii::$app->homeUrl?>/assets/images/banners/1.jpg" src="<?=Yii::$app->homeUrl?>/assets/images/blank.gif" alt="">
				</div>	
				<div class="strip">
					<div class="strip-inner">
						<h3 class="hidden-xs">samsung</h3>
						<h2>galaxy</h2>
					</div>	
				</div>
			</div><!-- /.wide-banner -->
		</div><!-- /.col -->

		<div class="col-md-5">
			<div class="wide-banner cnt-strip">
				<div class="image">
					<img class="img-responsive" data-echo="<?=Yii::$app->homeUrl?>/assets/images/banners/2.jpg" src="<?=Yii::$app->homeUrl?>/assets/images/blank.gif" alt="">
				</div>	
				<div class="strip">
					<div class="strip-inner">
						<h3 class="hidden-xs">new trend</h3>
						<h2>watch phone</h2>
					</div>	
				</div>
			</div><!-- /.wide-banner -->
		</div><!-- /.col -->

	</div><!-- /.row -->
</div><!-- /.wide-banners -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->

<!-- ============================================== BEST SELLER ============================================== -->

<div class="sidebar-widget wow fadeInUp outer-bottom-vs">
	<h3 class="section-title">Best seller</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
	        	        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s1.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
											<div class="tag tag-micro new">
							<span>new</span>
						</div>
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Asus Zenphone 6</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s1.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Asus Zenphone 6</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s2.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Apple Iphone 5s</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s2.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
											<div class="tag tag-micro sale">
							<span>sale</span>
						</div>
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Apple Iphone 5s</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s3.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s3.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
											<div class="tag tag-micro hot">
							<span>hot</span>
						</div>
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Canon EOS 60D</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s3.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s3.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Canon EOS 60D</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s2.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
											<div class="tag tag-micro hot">
							<span>hot</span>
						</div>
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="assets/images/products/s2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="assets/images/products/s2.jpg" src="assets/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== BEST SELLER : END ============================================== -->	



<!-- ============================================== WIDE PRODUCTS ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-vs">
	<div class="row">

		<div class="col-md-12">
			<div class="wide-banner cnt-strip">
				<div class="image">
					<img class="img-responsive" data-echo="<?=Yii::$app->homeUrl?>/assets/images/banners/3.jpg" src="<?=Yii::$app->homeUrl?>/assets/images/blank.gif" alt="">
				</div>	
				<div class="strip strip-text">
					<div class="strip-inner">
						<h2 class="text-right">one stop place for<br>
						<span class="shopping-needs">all your shopping needs</span></h2>
					</div>	
				</div>
				<div class="new-label">
				    <div class="text">NEW</div>
				</div><!-- /.new-label -->
			</div><!-- /.wide-banner -->
		</div><!-- /.col -->

	</div><!-- /.row -->
</div><!-- /.wide-banners -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->


			<!-- ============================================== BLOG SLIDER ============================================== -->
<section class="section outer-bottom-vs wow fadeInUp">
	<h3 class="section-title">latest form blog</h3>
	<div class="blog-slider-container outer-top-xs">
		<div class="owl-carousel blog-slider custom-carousel">
													
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="index.php?page=blog"><img data-echo="assets/images/blog-post/1.jpg" width="270" height="135" src="assets/images/blank.gif" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Simple Blog demo from fashion web</a></h3>	
							<span class="info">By Jone Doe-22 april 2014 -03 comments</span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="index.php?page=blog"><img data-echo="assets/images/blog-post/2.jpg" width="270" height="135" src="assets/images/blank.gif" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Simple Blog demo from fashion web</a></h3>	
							<span class="info">By Jone Doe-22 april 2014 -03 comments</span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="index.php?page=blog"><img data-echo="assets/images/blog-post/3.jpg" width="270" height="135" src="assets/images/blank.gif" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Simple Blog demo from fashion web</a></h3>	
							<span class="info">By Jone Doe-22 april 2014 -03 comments</span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="index.php?page=blog"><img data-echo="assets/images/blog-post/4.jpg" width="270" height="135" src="assets/images/blank.gif" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Simple Blog demo from fashion web</a></h3>	
							<span class="info">By Jone Doe-22 april 2014 -03 comments</span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="index.php?page=blog"><img data-echo="assets/images/blog-post/5.jpg" width="270" height="135" src="assets/images/blank.gif" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Simple Blog demo from fashion web</a></h3>	
							<span class="info">By Jone Doe-22 april 2014 -03 comments</span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="index.php?page=blog"><img data-echo="assets/images/blog-post/6.jpg" width="270" height="135" src="assets/images/blank.gif" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Simple Blog demo from fashion web</a></h3>	
							<span class="info">By Jone Doe-22 april 2014 -03 comments</span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
						
		</div><!-- /.owl-carousel -->
	</div><!-- /.blog-slider-container -->
</section><!-- /.section -->
<!-- ============================================== BLOG SLIDER : END ============================================== -->

<!-- ============================================== CONTENT : END ============================================== -->

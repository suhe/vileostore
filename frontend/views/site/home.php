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
	    <?php foreach(\common\models\Banner::homePageBanner('home','slideshow') as $row){?>	
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
						    <i class="fa <?=$row->stock>0?'fa-shopping-cart':'fa-thumbs-down'?>"></i>													
						</button>
						<?php if($row->stock>0){?> 
						<?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->id],['class'=>'btn btn-primary'])?>
						<?php } else { ?>
						<?=\yii\helpers\Html::a(Yii::t('app','empty'),['product/category','id'=>$row->category_id],['class'=>'btn btn-primary'])?>
						<?php } ?>
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
	<?php foreach(\common\models\Banner::homePageBanner('home','static') as $row){?>	
	<div class="col-md-6">
	    <div class="wide-banner cnt-strip">
		<div class="image">
		    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
			'@image_banner/'.$row->id.'/'.$row->image,
			    $row->width,
			    $row->height,
			\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
			['alt' => $row->name,'class'=>'img-responsive']
		    );?>  
		</div>	
		
		<div class="strip">
		    <div class="strip-inner">
			<h3 class="hidden-xs"><?=$row->name?></h3>
		    </div>	
		</div>
	    </div><!-- /.wide-banner -->
	</div><!-- /.col -->
	<?php } ?>
    </div><!-- /.row -->
</div><!-- /.wide-banners -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->

<!-- ============================================== BEST SELLER ============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-vs">
    <h3 class="section-title"><?=Yii::t('app','best seller')?></h3>
    <div class="sidebar-widget-body outer-top-xs">
	<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
	    <?php foreach(\common\models\Product::getProductByCondition(['status'=>1,'best_seller'=>1]) as $row){?>
	    <div class="item">
	        <div class="products special-product">
		    <div class="product">
			<div class="product-micro">
			    <div class="row product-micro-row">
				<div class="col col-xs-5">
				    <div class="product-image">
					<div class="image">
					    <a href="assets/images/products/sm1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
						    '@image_product/'.$row->id.'/'.$row->image,
						    100,
						    120,
						    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
						    ['alt' => $row->name]
						);?>
						<div class="zoom-overlay"></div>
					    </a>					
					</div><!-- /.image -->
					<!--<div class="tag tag-micro hot"><span><?php // Yii::t('app','special')?></span></div>-->
				    </div><!-- /.product-image -->
				</div><!-- /.col -->
				<div class="col col-xs-7">
				    <div class="product-info">
					<h3 class="name"><?=\yii\helpers\Html::a($row->name,['product/read','id'=>$row->id])?></h3>
					<div class="rating rateit-small"></div>
					<div class="product-price">	
					    <span class="price"><?=Yii::$app->Formatter->asDecimal($row->price,2)?></span>
					</div><!-- /.product-price -->
					<div class="action">
					    <?php if($row->stock>0){?> 
					    <?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->id],['class' => 'lnk btn btn-primary'])?>
					    <?php } else { ?>
					    <?=\yii\helpers\Html::a(Yii::t('app','empty'),['product/category','id'=>$row->category_id],['class'=>'btn btn-primary'])?>
					    <?php } ?>
					</div>
				    </div>
				</div><!-- /.col -->
			    </div><!-- /.product-micro-row -->
			</div><!-- /.product-micro -->
		    </div>  			
		</div>
	    </div>
	    <?php } ?>
	    <!-- /. Item -->
	</div>
	
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== BEST SELLER : END ============================================== -->	

<!-- ============================================== CONTENT : END ============================================== -->

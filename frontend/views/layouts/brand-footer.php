<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <h3 class="section-title"><?=Yii::t('app','brand')?></h3>
    <div class="logo-slider-inner">	
	<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
	    <?php foreach(\common\models\Brand::ActiveBrand() as $brand) { ?>
            <div class="item m-t-15">
		<a href="#" class="image">
		    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
			'@image_brand/'.$brand->id.'/'.$brand->logo,
			114,
			45,
			\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => $brand->name]
                    );?>
		</a>	
	    </div><!--/.item-->
            <?php } ?>
	</div><!-- /.owl-carousel #logo-slider -->
    </div><!-- /.logo-slider-inner -->
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

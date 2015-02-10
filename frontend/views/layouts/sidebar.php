<!-- ============================================== SIDEBAR ============================================== -->	
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">	
        <ul class="nav">
	    <?php foreach(\common\models\Category::getNestedCategory(1,0) as $nav){ ?>
            <li class="dropdown menu-item">
                <a href="<?=\yii\helpers\Url::to(['category/part/','id'=>$nav->id])?>" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-external-link fa-fw"></i><?=$nav->name?></a>
                <!-- ================================== MEGAMENU VERTICAL ================================== -->
		<?php if(\common\models\Category::getNestedCategory(1,$nav->id)) { ?>
		<ul class="dropdown-menu mega-menu">
		    <li class="yamm-content">
			<div class="row" style="min-height:370px">
			    <div class="col-xs-12 col-sm-12 col-lg-4">
				<ul>
				    <?php foreach(\common\models\Category::getNestedCategory(1,$nav->id) as $sub_nav){?>
				    <li><a href="<?=\yii\helpers\Url::to(['product/category/','id'=>$sub_nav->id])?>"><?=$sub_nav->name?></a></li>
				    <?php } ?>
				</ul>
			    </div>
			    <div class="dropdown-banner-holder">
				<a href="#">
				    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
					'@assets/images/categories/'.$nav->id.'/'.$nav->image,
					    395,
					    397,
					    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
					    ['alt' => 'Banner']
				    );?>	
				</a>
			    </div>
			</div>
			<!-- /.row -->
		    </li><!-- /.yamm-content -->                    
		</ul>
		<?php } ?>
		<!-- /.dropdown-menu -->
		<!-- ================================== MEGAMENU VERTICAL ================================== -->
	    </li><!-- /.menu-item -->
	    <?php } ?>
	</ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->

<!-- ================================== Search Bar By Price ================================== -->
<?php if(Yii::$app->controller->getRoute()=='product/category') {?>
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title"><?=Yii::t('app','search by category')?></h3>
	<div class="sidebar-widget-body ">
	    <?php
	    $form = \yii\bootstrap\ActiveForm::begin([
		'id' => 'formPrice',
		'method' => 'GET',
		'options' => ['class' => 'form-horizontal'],
		'fieldConfig' => [
		    'template' => "<div class='col-md-12'>{input}{error}</div>",
		    //'labelOptions' => ['class' => 'col-sm-2 control-label'],
		],
	    ]);?>
	    <?=$form->field(new \common\models\ProductCategory(),'price_down')->textInput(['value'=> isset(Yii::$app->request->QueryParams['ProductCategory']['price_down'])?Yii::$app->request->QueryParams['ProductCategory']['price_down']:0 ,'class' => 'form-control text-right'])?>
	    <?=$form->field(new \common\models\ProductCategory(),'price_high')->textInput(['value'=>isset(Yii::$app->request->QueryParams['ProductCategory']['price_high'])?Yii::$app->request->QueryParams['ProductCategory']['price_high']:1000000000,'class' => 'form-control text-right'])?>
	    <?=$form->field(new \common\models\ProductCategory(),'brand_id')->dropDownList(\common\models\Brand::getDropDownList(),['options'=>[isset(Yii::$app->request->QueryParams['ProductCategory']['brand_id'])?Yii::$app->request->QueryParams['ProductCategory']['brand_id']:0 => ["\nselected" => true]]])?>	
	    <div class='col-md-12'>
		<div class="form-group pull-right" >
		    <?=\yii\helpers\Html::submitButton('<i class="fa fa-search icon-on-right"></i> '.Yii::t('app','search'), ['class' => 'btn btn-primary btn-md','name' => 'search'])?>
		</div>
		<div class="clearfix"></div>
	    </div>
	    <?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<?php } ?>
<!-- ================================== Search Bar By Price ================================== -->

<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
	<h3 class="section-title"><?=Yii::t('app','newsletter')?></h3>
	<div class="sidebar-widget-body ">
		<p><?=Yii::t('app','sign up newsletter')?></p>
		<div class="msg text-danger" style="margin-bottom:10px"></div>
		<?php
		$form = \yii\bootstrap\ActiveForm::begin([
		    'id' => 'formNewsletter',
		    'method' => 'post',
		    'action' => ['site/newsletter'],
		    'options' => ['class' => 'form-horizontal'],
		    'fieldConfig' => [
			'template' => "<div class='col-md-12'>{input}{error}</div>",
		    ],
		]);?>
		<?=$form->field(new \common\models\Newsletter(),'email')->textInput(['placeholder' => Yii::t('app','email')])?>
		
		<div class='col-md-12'>
		    <div class="loading" style="display:none"></div>
		    
		    <div class="form-group pull-right" >
			<?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','subscribe'), ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
		    </div>
		    <div class="clearfix"></div>
		</div>
		<?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->
	    
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->

<?php 
$js = <<<JS
$('#formNewsletter').on('beforeSubmit', function(e) {
    var form = $(this);
    if (form.find('.has-error').length){
      return false;
    }
    $('.loading').show();
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
            success: function(data) {
                if(data.success==true){
		    $("#newsletter-email").val("");
		    $('.loading').hide();
		    $('.msg').text(data.message);
		}
		else {
		    $('.loading').hide();
		    $('.msg').text(data.message);
		}
            }
    });
    
}).on('submit', function(e){
    e.preventDefault();
});
JS;
$this->registerJs($js);?>

<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ============================================== SPECIAL OFFER ============================================== -->
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title"><?=Yii::t('app','special offers')?></h3>
    <div class="sidebar-widget-body outer-top-xs">
	<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	    <?php foreach(\common\models\Product::GetProductByCategory(39,5,1) as $row){?>
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
					    <?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->id],['class' => 'lnk btn btn-primary'])?>
					</div>
				    </div>
				</div><!-- /.col -->
			    </div><!-- /.product-micro-row -->
			</div><!-- /.product-micro -->
		    </div>  			
		</div>
	    </div>
	     <?php } ?>      
	</div>
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->

<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title"><?=Yii::t('app','product tags')?></h3>
    <div class="sidebar-widget-body outer-top-xs">
	<div class="tag-list">
	    <?php foreach(\common\models\Tag::ListTag() as $tag){?>
		<?=\yii\helpers\Html::a($tag->name,['product/tag/','id' => $tag->id],['class'=>'item'])?>
	    <?php } ?>
	</div><!-- /.tag-list -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== PRODUCT TAGS : END ============================================== -->

<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title"><?=Yii::t('app','hot deals')?></h3>
    <div class="sidebar-widget-body outer-top-xs">
	<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	    <?php foreach(\common\models\Product::GetProductByCategory(40,5,1) as $row){?>
	    <div class="item">
	        <div class="products special-product">
		    <div class="product">
			<div class="product-micro">
			    <div class="row product-micro-row">
				<div class="col col-xs-5">
				    <div class="product-image">
					<div class="image">
					    <a href="assets/images/products/sm4.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
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
					<!--<div class="tag tag-micro hot"><span>hot</span></div>!--->
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
						    <?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$row->id],['class' => 'lnk btn btn-primary'])?>
						</div>
				    </div>
				</div><!-- /.col -->
			    </div><!-- /.product-micro-row -->
			</div><!-- /.product-micro -->
		    </div>    		        	
		</div>	        
	    </div><!-- /.item -->
	    <?php } ?>
	</div>    
    </div><!-- /.sidebar-widget -->
 </div><!-- /.sidebar-widget -->    
<!-- ============================================== SPECIAL DEALS : END ============================================== -->

</div><!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->

<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app',$category->name),'url' => ['product/category','id'=>$category->id]],
    ['label' => \yii\helpers\Html::encode($data->name),'url' => ['product/read','id'=>$data->id]]   
];?>
<?=$this->title = $data->name;?> 

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
		    <div class="col-md-1 col-sm-2">
			<span class="label"><?=Yii::t('app','via')?></span>
                    </div><!-- /.col -->
		    <!-- /.col -->
		    <div class=" col-md-11 col-sm-10 social-icons">
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
		<div class="product-tab">
		    <div class="product-reviews">
			<h4 class="title"><?=Yii::t('app','asked question')?></h4>
			<div class="reviews" id="containerReview">
			    <?php foreach($discusion as $comment){?>
			    <div class="review">
				<div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?=$comment->full_name?></span> <span class="date"><i class="fa fa-calendar"></i><span><?=common\helpers\App::timeAgo($comment->created_date)?></span></span></div>	
				<div class="text"><?=$comment->description?></div>
			    </div>
			    <?php } ?>
			</div><!-- /.reviews -->
		    </div><!-- /.product-reviews -->

		    <div class="product-add-review">
			<h4 class="title"><?=Yii::t('app','ask to sales')?></h4>
			<div class="review-form">
			    
			    <div class="form-container">
				<?php
				$form = \yii\bootstrap\ActiveForm::begin([
				    'id' => 'form',
				    'method' => 'post',
				    'options' => ['class' => 'form-horizontal'],
				    'fieldConfig' => [
					'template' => "{input}{error}",
					//'labelOptions' => ['class' => 'col-sm-2 control-label'],
				    ],
				]);?>
				    <!-- /.row -->
				    <div class="row">
					<div class="loading" style="display:none"><?=Yii::t('app','please wait do not refresh .... ')?></div>
					<div class="col-md-12">      
					    <?=$form->field($formModel,'description')->textarea(['rows' => 2])?>
					    
					</div>
				    </div><!-- /.row -->
				    <div class="action text-right">
					<button type="submit" class="btn btn-primary btn-upper"><?=Yii::t('app','send')?></button>
				    </div><!-- /.action -->
				<?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->
			    </div><!-- /.form-container -->
			</div><!-- /.review-form -->
		    </div><!-- /.product-add-review -->										
		</div>
	    </div><!-- /.tab-pane -->
	</div><!-- /.tab-content -->
    </div><!-- /.product-tabs -->
</div><!-- /.col -->
</div><!-- /.row -->

<?php 
$js = <<<JS
$('#form').on('beforeSubmit', function(e) {
    $(".loading").show();
    var form = $(this);
    if (form.find('.has-error').length){
	$(".loading").hide();
	return false;
    }
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
            success: function(data) {
                if(data.success==true){
		    var Review = '<div class="review">' +
		    '<div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name">' + data.name + '</span> <span class="date"><i class="fa fa-calendar"></i><span>'+ data.date +'</span></span></div>' +
		    '<div class="text">' + data.comment + '</div>' +
		    '</div>';
		    $("#containerReview").append(Review);
		    $(".loading").hide();
		    $("#discusion-description").val("");
		}
		else {
		    $(".loading").hide();
		    alert("You Get error ");
		    
		}
            }
    });
    
}).on('submit', function(e){
    e.preventDefault();
});
JS;
$this->registerJs($js);

		

<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app',$data->category_name),'url' => ['product/category','id'=>$data->category_id]],
    ['label' => \yii\helpers\Html::encode($data->name),'url' => ['product/read','id'=>$data->id]]   
];

$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->setting->Variable('Store Name')->content]);
$this->registerMetaTag(['name' => 'keywords', 'content' => str_replace(' ',',',$data->name)]);
$this->registerMetaTag(['name' => 'description', 'content' => $data->short_description]);

?>
<?=$this->title = $data->name;?> 

<div class="row  wow fadeInUp">
	<!-- ========================================================= /.gallery-holder  ==================================================================================== -->	
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
						471,
						575,
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
								67,
								92,
								\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
								['alt' => $data->name]
							);?>
						</a>
					</div>
					<?php $id++; } ?>
				</div><!-- /#owl-single-product-thumbnails -->
				<!-- /.nav-holder -->
				<div class="nav-holder left"><a class="prev-btn slider-prev" data-target="#owl-single-product2-thumbnails" href="#prev"></a></div><!-- /.nav-holder -->
				<div class="nav-holder right"><a class="next-btn slider-next" data-target="#owl-single-product2-thumbnails" href="#next"></a></div><!-- /.nav-holder -->
				<!-- /.nav-holder -->
            </div><!-- /.gallery-thumbs -->

		</div><!-- /.single-product-gallery -->
    </div><!-- /.gallery-holder -->	
	<!-- ========================================================= /.gallery-holder  ==================================================================================== -->		
    
	<!-- ========================================================= /.product-info-block  ==================================================================================== -->	
    <div class='col-sm-6 col-md-8 product-info-block'>
		<div class="product-info">
			<h3 class="name"><?=$data->name?></h3>
			<div class="rating-reviews m-t-20">
				<div class="row">
					<div class="col-sm-2">
						<div class="rating rateit-small"></div>
					</div>
			
					<div class="col-sm-8">
						<div class="reviews"><a href="#" class="lnk"><?=\Yii::t('app','weight')?> : <?=$data->weight?> <?=Yii::$app->params['weight']?></a></div>
					</div>
				</div><!-- /.row -->		
			</div><!-- /.rating-reviews -->

			<div class="stock-container info-container m-t-10">
				<div class="row">
				    <div class="col-sm-2">
					<div class="stock-box"><span class="value"><?=\Yii::t('app','sku')?></span></div>	
				    </div>
				    <div class="col-sm-1">
					<div class="stock-box"><span class="value">:</span></div>	
				    </div>
				    <div class="col-sm-9">
					<div class="stock-box"><span class="value"><?=$data->sku?></span></div>	
				    </div>
				</div><!-- /.row -->
				<div class="row">
				    <div class="col-sm-2">
					<div class="stock-box"><span class="value"><?=\Yii::t('app','price')?></span></div>	
				    </div>
				    <div class="col-sm-1">
					<div class="stock-box"><span class="value">:</span></div>	
				    </div>
				    <div class="col-sm-9">
					<div class="stock-box"><span class="value"><?=Yii::$app->Formatter->asDecimal($data->price,2)?></span></div>	
				    </div>
				</div><!-- /.row -->
				<div class="row">
				    <div class="col-sm-2">
					<div class="stock-box"><span class="value"><?=\Yii::t('app','availability')?></span></div>	
				    </div>
				    <div class="col-sm-1">
					<div class="stock-box"><span class="value">:</span></div>	
				    </div>
				    <div class="col-sm-9">
					<div class="stock-box"><span class="value"><?=$data->stock>0?Yii::t('app','in stock'):Yii::t('app','empty')?></span></div>	
				    </div>
				</div><!-- /.row -->
			</div><!-- /.stock-container -->
			
			<!-- /.description-container -->
			<div class="description-container m-t-20">
				<?=$data->short_description?>
			</div><!-- /.description-container -->
		                                   
			<div class="row outer-top-vs">
			    
			    <div class=" col-md-6 social-icons">
				    <ul class="list-inline">
					<?php if($data->stock>0){ ?>
					<li><i class="fa fa-file"></i> <?=\yii\helpers\Html::a($data->online?Yii::t('app','online'):Yii::t('app','not online'),['#'])?></li>
					<li><i class="fa fa-map-marker"></i> <?=\yii\helpers\Html::a($data->cod?Yii::t('app','cash on delivery'):Yii::t('app','not cod'),['#'])?></li>
					<li><i class="fa fa-umbrella"></i> <?=\yii\helpers\Html::a($data->dropshier?Yii::t('app','dropshier'):Yii::t('app','not dropshier'),['#'])?></li>
					<?php } else { ?>
					<li><i class="fa fa-time"></i> <?=Yii::t('app','in stock').' '.Yii::$app->formatter->asDate($data->arrival_date,'php:d M Y');?> </li>
					<?php } ?>
				    </ul><!-- /.social-icons -->
				</div>
			    
			    <div class="col-md-6 clearfix animate-effect">
				<!-- /.action -->
				<div class="action">
				    <ul class="list-unstyled pull-right">
					<li class="add-cart-button btn-group">
						
				        <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
					    <i class="fa <?=$data->stock>0?'fa-shopping-cart':'fa-thumbs-down'?>"></i>													
					</button>
					<?php if($data->stock>0){?>
					<?=\yii\helpers\Html::a(Yii::t('app','add to cart'),['cart/basket','id'=>$data->id,'slug'=>$data->slug],['class'=>'btn btn-primary'])?>
					<?php } else { ?>
					<?=\yii\helpers\Html::a(Yii::t('app','empty'),['product/read','id'=>$data->category_id,'slug'=>$data->slug],['class'=>'btn btn-primary'])?>
					<?php } ?>
					</li>
				    </ul>	
				</div><!-- /.action -->
				<div class="clearfix"></div>
			    </div>
			</div>
	    </div><!-- /.product-info -->
		
	</div><!-- /.col-sm-6 -->
 </div><!-- /.row -->

<div class="row  wow fadeInUp outer-top-xs">    
    <div class="product-tabs outer-top-smal  wow fadeInUp">
	<ul id="product-tabs" class="nav nav-tabs nav-tab-cell-detail">
	    <li class="active"><a data-toggle="tab" href="#description"><?=Yii::t('app','description')?></a></li>
	    <li><a data-toggle="tab" href="#tags"><?=Yii::t('app','product discussion')?></a></li>
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
			    <?php foreach($discussion as $comment){?>
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
			    
			    <?php if(!Yii::$app->user->isGuest){ ?>
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
					<?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','subscribe'), ['class' => 'btn btn-primary btn-md','name' => 'post'])?>
				    </div><!-- /.action -->
				    <div class="clearfix" style="margin-bottom:10px"></div>
				<?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->
			    </div><!-- /.form-container -->
			    <?php } else { ?>
			    
			    <h4><?=Yii::t('app/message','msg you must login')?></h4>
			    
			    <a  class="btn btn-primary" href="<?=\yii\helpers\Url::to(['site/register'])?>"> <i class="fa fa-user"></i>  <?=Yii::t('app','register')?></a>
			    <a  class="btn btn-primary" href="<?=\yii\helpers\Url::to(['site/login'])?>"> <i class="fa fa-key"></i> <?=Yii::t('app','login')?></a>
			    
			    <?php } ?>
			    
			</div><!-- /.review-form -->
			
			
		    </div><!-- /.product-add-review -->										
		</div>
	    </div><!-- /.tab-pane -->
	</div><!-- /.tab-content -->
    </div><!-- /.product-tabs -->
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

		

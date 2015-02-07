<?php
use common\assets\AppBundle;
$asset = AppBundle::register($this);

?>
<?php foreach($query as $row){ ?>
<div class="category-product-inner wow fadeInUp">
    <div class="products">				
	<div class="product-list product">
            <div class="row product-list-row">
                <div class="col col-sm-4 col-lg-4">
		    <div class="product-image">
			<div class="image">
			    <img data-echo="<?=Yii::$app->params['baseUrl'] . 'assets/images/products/'.$row->product_id.'/'. $row->img_thumbnail?>" src="/assets/images/blank.gif" alt="">
			</div>
		    </div><!-- /.product-image -->
		</div><!-- /.col -->
		
                <div class="col col-sm-8 col-lg-8">
		    <div class="product-info">
			<h3 class="name"><?=\yii\helpers\Html::a($row->name,['product/read','id'=>$row->product_id])?></h3>
			<div class="rating rateit-small"></div>
			<!-- /.product-price -->
                        <div class="product-price">	
			    <span class="price"><?=Yii::$app->formatter->asDecimal($row->price)?></span>
                            <span class="price-before-discount"><?=Yii::$app->formatter->asDecimal($row->price+10000)?></span>
			</div><!-- /.product-price -->
			<div class="description m-t-10"><?=$row->short_description?></div>
                	<div class="cart clearfix animate-effect">
			    <div class="action col-md-12 col-sm-12">
				<div class="row">
				<div class=" col-md-8 col-sm-8 social-icons">
				    <ul class="list-inline">
					<li><?=\yii\helpers\Html::a('<i class="fa fa-file"></i> '.Yii::t('app','online'),['#'])?></li>
					<li><?=\yii\helpers\Html::a('<i class="fa fa-map-marker"></i> '.Yii::t('app','cash on delivery'),['#'])?></li>
					<li><?=\yii\helpers\Html::a('<i class="fa fa-umbrella"></i> '.Yii::t('app','dropshir'),['#'])?></li>
				    </ul><!-- /.social-icons -->
				</div>
				
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
	    <div class="tag new"><span>new</span></div>
	</div><!-- /.product-list -->
    </div><!-- /.products -->
</div><!-- /.category-product-inner -->
<?php }?>
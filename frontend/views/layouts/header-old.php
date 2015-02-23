<?php
use vileosoft\shoppingcart\Cart;
$cart = new Cart();
?>
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown navbar-fixed-top">
	<div class="container">
	<div class="header-top-inner">
	    <div class="cnt-account">
		<!--<ul class="list-unstyled">
		    <li><a href="<?=\yii\helpers\Url::to(['user/profile'])?>"><i class="icon fa fa-user"></i><?=Yii::t('app','my account')?></a></li>
		</ul>-->
	    </div><!-- /.cnt-account -->

	    <div class="cnt-block">
		<ul class="list-unstyled list-inline">
		    <?php if(!Yii::$app->user->isGuest){ ?>
		    <li class="dropdown dropdown-small">
			<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="key"><?=Yii::t('app','hai')?> :</span><span class="value"><?=Yii::$app->user->identity->first_name?> </span><b class="caret"></b></a>
			    <ul class="dropdown-menu">
				<li><?=\yii\helpers\Html::a('<i class="fa fa-user"></i> ' .Yii::t('app','my profile'),['user/profile'])?></li>
				<li><?=\yii\helpers\Html::a('<i class="fa fa-exchange"></i> ' .Yii::t('app','history transaction'),['user/history'])?></li>
				<li><?=\yii\helpers\Html::a('<i class="fa fa-envelope"></i> ' . Yii::t('app','product discussion'),['user/discussion'])?></li>
				<li><?=\yii\helpers\Html::a('<i class="fa fa-map-marker"></i> ' . Yii::t('app','addresses'),['user/address'])?></li>
				<li><?=\yii\helpers\Html::a('<i class="fa fa-key"></i> ' . Yii::t('app','change password'),['user/chpassword'])?></li>
				<li><?=\yii\helpers\Html::a('<i class="fa fa-trello"></i> ' .Yii::t('app','logout'),['site/logout'])?></li>
			    </ul>
		    </li>
		    <?php } else { ?>
		    <li><a href="<?=\yii\helpers\Url::to(['site/login'])?>"><i class="icon fa fa-user"></i> <?=Yii::t('app','register')?></a></li>
		    <li><a href="<?=\yii\helpers\Url::to(['site/login'])?>"><i class="icon fa fa-key"></i> <?=Yii::t('app','login')?></a></li>
		    <?php } ?>
		</ul><!-- /.list-unstyled -->
	    </div><!-- /.cnt-cart -->
	    
	    <div class="clearfix"></div>
	    
	</div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.header-top -->

<!-- ============================================== TOP MENU : END ============================================== -->
<div class="main-header">
    <div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
		<!-- ============================================================= LOGO ============================================================= -->
		<div class="logo">
		    <a href="<?=\yii\helpers\Url::to(['site/index'])?>">
			<?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
			    '@assets/images/logo.png',
			    181,
			    68,
			    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
			    ['alt' => 'logo']
			);?>  	
		    </a>
		</div><!-- /.logo -->
		<!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

	    <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
		<div class="contact-row">
		    <div class="phone inline"><i class="icon fa fa-phone"></i> <?=Yii::$app->setting->Variable('Hunting Phone')->content?></div>
		    <div class="phone inline"><i class="icon fa fa-whatsapp"></i> <?=Yii::$app->setting->Variable('Hunting Phone')->content?></div>
		    <div class="contact inline"><i class="icon fa fa-wechat"></i> <?=Yii::$app->setting->Variable('BBM Pin')->content?></div>
		</div><!-- /.contact-row -->
		<!-- ============================================================= SEARCH AREA ============================================================= -->
		<div class="search-area">
		    <div class="control-group">
		    <?php
			$form = \yii\bootstrap\ActiveForm::begin([
			    'id' => 'formSearch',
			    'method' => 'GET',
			    'action' => ['product/search'],
			    'options' => ['class' => 'form-horizontal'],
			    'fieldConfig' => [
				'template' => "{input}",
				//'labelOptions' => ['class' => 'col-sm-2 control-label'],
			    ],
			]);?>
		        <?=\yii\helpers\Html::activeTextInput(new \common\models\Product(), 'name', ['placeholder' => Yii::t('app','search here'),'value' => isset(Yii::$app->request->QueryParams['Product']['name'])?Yii::$app->request->QueryParams['Product']['name']:'','class' => 'search-field']); ?>
		        <?=\yii\helpers\Html::submitButton('',['class' => 'search-button btn btn-default','name' => 'search'])?>
		    </div>	
			<!--<div class="control-group">
			    <input class="search-field" placeholder="Search here..." />
			    <a class="search-button" href="#" ></a>    
			</div>--->
		    <?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->
		</div><!-- /.search-area -->
		<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->




				<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
					<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
	
	<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
				<div class="total-price-basket">
					<span class="lbl"><?=Yii::t('app','shopping cart')?> -</span>
					<span class="total-price">
						<span class="sign"><?=Yii::$app->params['currency']?></span>
						<span class="value"><?=Yii::$app->formatter->asDecimal($cart->total(),2)?></span>
					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count"><?=Yii::$app->formatter->asDecimal($cart->total_items(),0)?></span></div>
			
		    </div>
		</a>
		<?php if(count($cart->contents()>0)){ ?>
		<ul class="dropdown-menu">
			<li>
				<div class="cart-item product-summary">
					<?php foreach ($cart->contents() as $items){ ?>
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="<?=\yii\helpers\Url::to(['product/read','id'=>$items['id']])?>">
								    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
				    '@image_product/'.$items['id'].'/'.$items['options']['image'],
				    47,
				    61,
				    \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
				    ['alt' => $items['name']]
				);
				?>  
								    
								</a>
							</div>
						</div>
						<div class="col-xs-7">
							
							<h3 class="name"><?=\yii\helpers\Html::a($items['name'],['product/read','id'=>$items['id']])?></h3>
							<div class="price"><?=Yii::$app->formatter->asDecimal($items['price'],2)?></div>
						</div>
						<div class="col-xs-1 action">
							<a href="<?=\yii\helpers\Url::to(['shopping/remove','id'=>$items['rowid']])?>"><i class="fa fa-trash"></i></a>
						</div>
					</div>
					<?php } ?>
					
					
				</div><!-- /.cart-item -->
				<div class="clearfix"></div>
			<hr>
		
			<div class="clearfix cart-total">
				<div class="pull-right">
					
						<span class="text">Sub Total :</span><span class='price'><?=Yii::$app->Formatter->asDecimal($cart->total()?$cart->total():0,2);?></span>
						
				</div>
				<div class="clearfix"></div>
				<?=\yii\helpers\Html::a(Yii::t('app','checkout'),['cart/shopping'],['class' => 'btn btn-upper btn-primary btn-block m-t-20'])?>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
		<?php } ?>
	</div><!-- /.dropdown-cart -->

<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	

</header>
<!-- ============================================== HEADER : END ============================================== -->

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
		    <?=yii\widgets\Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			'options' => ['class' => 'list-inline list-unstyled']
		    ])?>
							    
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
	
</div>


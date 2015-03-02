<?php
use vileosoft\shoppingcart\Cart;
$cart = new Cart();
?>
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
	<div class="container">
	    <div class="row">
		<!-- /.col lg 2 logo-holder -->
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 logo-holder">
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
		    <!-- ============================================================= LOGO : END ============================================================= -->
		</div>
		<!-- /.col lg 2 logo-holder -->
		
		<!-- /.col lg 4 search form -->
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 top-search-holder">
		    <div class="contact-row">
			<div class="phone inline"><i class="icon fa fa-phone"></i> <?=Yii::$app->setting->Variable('Hunting Phone')->content?></div>
			<div class="phone inline"><i class="icon fa fa-whatsapp"></i> <?=Yii::$app->setting->Variable('Hunting Phone')->content?></div>
			<div class="contact inline"><i class="icon fa fa-wechat"></i> <?=Yii::$app->setting->Variable('BBM Pin')->content?></div>
		    </div>
		    <!-- /.contact-row -->
		    
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
		    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
		</div>
		<!-- /.col lg 4 search form -->
		
		<!-- /.col lg 4 shopping cart -->
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
					    <span class="text"><?=Yii::t('app','sub total')?> :</span><span class='price'><?=Yii::$app->Formatter->asDecimal($cart->total()?$cart->total():0,2);?></span>			
					</div>
					<div class="clearfix"></div>
					<?=\yii\helpers\Html::a(Yii::t('app','checkout'),['cart/shopping'],['class' => 'btn btn-upper btn-primary btn-block m-t-20'])?>	
				    </div><!-- /.cart-total-->		
				</li>
			    </ul><!-- /.dropdown-menu-->
				<?php } ?>
			</div><!-- /.dropdown-cart -->
			<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
		    </div><!-- /.top-cart-row -->
		    
		    <!-- /.col lg 2 shopping cart -->
		    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
			<div class="pull-right">
			    <?php if(Yii::$app->user->isGuest){ ?>
			    <ul class="nav nav-pills">
			    <li role="presentation" class="divider"><a href="<?=\yii\helpers\Url::to(['site/login'])?>" role="button" aria-expanded="false"> <?=Yii::t('app','login')?> </a></li>
			    <li role="presentation" class="divider"><a href="<?=\yii\helpers\Url::to(['site/login'])?>" role="button" aria-expanded="false"> <?=Yii::t('app','register')?> </a></li>
			  </ul> 
			    <?php } else { ?>
			    <ul class="nav nav-pills">
			    <li role="presentation" class="dropdown">
			      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
				<i class="fa fa-user"></i> <?=Yii::$app->user->identity->first_name?> <span class="caret"></span>
			      </a>
			      <ul class="dropdown-menu" role="menu">
				    <li><a href="<?=\yii\helpers\Url::to(['user/profile'])?>"> <i class="icon fa fa-user fa-fw"></i>  <?=Yii::t('app','my profile')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/history'])?>"> <i class="icon fa fa-exchange fa-fw"></i>  <?=Yii::t('app','history transaction')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/discussion'])?>"> <i class="icon fa fa-envelope fa-fw"></i>  <?=Yii::t('app','product discussion')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/address'])?>"> <i class="icon fa fa-map-marker fa-fw"></i>  <?=Yii::t('app','addresses')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/dropship'])?>"> <i class="icon fa fa-umbrella fa-fw"></i>  <?=Yii::t('app','dropship setting')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/chpassword'])?>"> <i class="icon fa fa-key fa-fw"></i>  <?=Yii::t('app','change password')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['site/logout'])?>"> <i class="icon fa fa-trello fa-fw"></i>  <?=Yii::t('app','exit')?></a></li>
			      </ul>
			    </li>
			  </ul> 
			    <?php } ?>
			</div>
		    </div>
		    <!-- /.top-cart-row -->	
		    
		</div><!-- /.row -->
	</div><!-- /.container -->
    </div><!-- /.main-header -->
</header>
<!-- ============================================== HEADER : END ============================================== -->

<div class="breadcrumb">
    <div class="container bg-white">
	<div class="breadcrumb-inner">
	    <?=yii\widgets\Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		'options' => ['class' => 'list-inline list-unstyled']
	    ])?>
							    
	</div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->	
</div>


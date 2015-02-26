<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">
	  <div class="links-social inner-top-sm">
        <div class="container">
            <div class="row">
            	<div class="col-xs-12 col-sm-6 col-md-3">
            		 <!-- ============================================================= CONTACT INFO ============================================================= -->
<div class="contact-info">
    <div class="footer-logo">
        <div class="logo">
            <a href="index.php?page=home">
                
                <img src="assets/images/logo.png" alt="">

            </a>
        </div><!-- /.logo -->
    
    </div><!-- /.footer-logo -->

     <div class="module-body m-t-20">
        <p class="about-us"><?=Yii::$app->setting->Variable('Store Slogan')->content?></p>
    
        <div class="social-icons">
            
        <a href="http://facebook.com/vileostore" class='active'><i class="icon fa fa-facebook"></i></a>
        <a href="https://twitter.com/vileostore"><i class="icon fa fa-twitter"></i></a>
        <a href="https://linkedin.com/vileostore"><i class="icon fa fa-linkedin"></i></a>
        </div><!-- /.social-icons -->
    </div><!-- /.module-body -->

</div><!-- /.contact-info -->
<!-- ============================================================= CONTACT INFO : END ============================================================= -->            	</div><!-- /.col -->

            	<div class="col-xs-12 col-sm-6 col-md-3">
            		 <!-- ============================================================= CONTACT TIMING============================================================= -->
<div class="contact-timing">
	<div class="module-heading">
		<h4 class="module-title"><?=Yii::t('app','opening time')?></h4>
	</div><!-- /.module-heading -->

	<div class="module-body outer-top-xs">
		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr><td><?=Yii::t('app','monday-friday')?> : </td><td class="pull-right"><?=Yii::$app->setting->Variable('Weekday Opening')->content?></td></tr>
					<tr><td><?=Yii::t('app','saturday')?> :</td><td class="pull-right"><?=Yii::$app->setting->Variable('Saturday Opening')->content?></td></tr>
					<tr><td><?=Yii::t('app','sunday')?> :</td><td class="pull-right"><?=Yii::$app->setting->Variable('Sunday Opening')->content?></td></tr>
				</tbody>
			</table>
		</div><!-- /.table-responsive -->
		<p class='contact-number'><?=Yii::t('app','contact support & and sales')?> :   <?=Yii::$app->setting->Variable('Hunting Phone')->content?></p>
	</div><!-- /.module-body -->
</div><!-- /.contact-timing -->
<!-- ============================================================= CONTACT TIMING : END ============================================================= -->
</div><!-- /.col -->

<div class="col-xs-12 col-sm-6 col-md-3">
<!-- ============================================================= LATEST TWEET============================================================= -->
<div class="latest-tweet">
	<div class="module-heading">
		<h4 class="module-title"><?=Yii::t('app','latest news & info')?></h4>
	</div><!-- /.module-heading -->

	<div class="module-body outer-top-xs">
       
       <?php foreach(\common\models\Page::content(['status'=>1,'type'=>'News & Info']) as $page){?>	
       <div class="re-twitter">
            <div class="comment media">
                <div class='pull-left'>
                    <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <?=\yii\helpers\Html::a($page->title,['page/content','id'=>$page->id])?>
		    <?=substr($page->content,0,50)?>
                </div>
            </div>
           
        </div>
       <?php } ?>
        
    </div><!-- /.module-body -->
</div><!-- /.contact-timing -->
<!-- ============================================================= LATEST TWEET : END ============================================================= -->
</div><!-- /.col -->

            	<div class="col-xs-12 col-sm-6 col-md-3">
            		 <!-- ============================================================= INFORMATION============================================================= -->
<div class="contact-information">
	<div class="module-heading">
		<h4 class="module-title"><?=Yii::t('app','address store')?></h4>
	</div><!-- /.module-heading -->

	<div class="module-body outer-top-xs">
        <ul class="toggle-footer" style="">
            <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>
		    <?=Yii::$app->setting->Variable('Store Address')->content?>
		    <?=Yii::$app->setting->Variable('Store City')->content?>
		    <?=Yii::$app->setting->Variable('Store Province')->content?> ,
		    <?=Yii::$app->setting->Variable('Store Pos Code')->content?>
		    </p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p><?=Yii::$app->setting->Variable('Hunting Phone')->content?></p>
                </div>
            </li>
	  
             <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <span><a href="#"><?=Yii::$app->setting->Variable('Email')->content?></a></span>
                </div>
            </li>
              
            </ul>
    </div><!-- /.module-body -->
</div><!-- /.contact-timing -->
<!-- ============================================================= INFORMATION : END ============================================================= -->            	</div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.links-social -->

    <div class="footer-bottom inner-bottom-sm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title"><?=Yii::t('app','help & support')?></h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
			    <?php foreach(\common\models\Page::content(['status'=>1,'type'=>'Help & Support']) as $page){?>
				<li><?=\yii\helpers\Html::a($page->title,['site/page','id'=>$page->id,'slug'=>$page->slug])?></li>
                            <?php } ?>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title"><?=Yii::t('app','my account')?></h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><?=\yii\helpers\Html::a(Yii::t('app','login & register'),['site/login'])?></li>
			    <li><?=\yii\helpers\Html::a(Yii::t('app','my profile'),['user/profile'])?></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->
		
		<div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title"><?=Yii::t('app','online shop')?></h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <p>
			<?=Yii::$app->setting->Variable('Store About')->content?>     
			</p>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->
		
            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="copyright">
                   <?=Yii::t('app','copyright')?> &copy; 2014 - <?=date('Y')?>
                    <?=\yii\helpers\Html::a(Yii::$app->setting->Variable('Store Name')->content)?>
                    - <?=Yii::t('app','all right reserved')?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="<?=Yii::$app->homeUrl?>/assets/images/payments/1.png" alt=""></li>
                        <li><img src="<?=Yii::$app->homeUrl?>/assets/images/payments/2.png" alt=""></li>
                        <li><img src="<?=Yii::$app->homeUrl?>/assets/images/payments/3.png" alt=""></li>
                        <li><img src="<?=Yii::$app->homeUrl?>/assets/images/payments/4.png" alt=""></li>
                        <li><img src="<?=Yii::$app->homeUrl?>/assets/images/payments/5.png" alt=""></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>
<!-- ============================================================= FOOTER : END============================================================= -->
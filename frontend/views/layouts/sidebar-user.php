<!-- ============================================== SIDEBAR ============================================== -->	
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <div class="sidebar-module-container">
<!-- ============================================== MANUFACTURES============================================== -->
<div class="sidebar-widget outer-bottom-xs wow fadeInUp" style="border-right:0.1em dotted #CCC">
	<div class="widget-header">
	    <h4 class="widget-title"> <i class="fa fa-user"></i> <?=Yii::t('app','my profile')?> </h4>
	</div>
	<div class="sidebar-widget-body m-t-10">
	<ul class="list">
            <li><a href="<?=\yii\helpers\Url::to(['user/profile'])?>"> <i class="icon fa fa-user fa-fw"></i>  <?=Yii::t('app','my profile')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/history'])?>"> <i class="icon fa fa-exchange fa-fw"></i>  <?=Yii::t('app','history transaction')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/discussion'])?>"> <i class="icon fa fa-envelope fa-fw"></i>  <?=Yii::t('app','product discussion')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/address'])?>"> <i class="icon fa fa-map-marker fa-fw"></i>  <?=Yii::t('app','addresses')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/dropship'])?>"> <i class="icon fa fa-umbrella fa-fw"></i>  <?=Yii::t('app','dropship setting')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['user/chpassword'])?>"> <i class="icon fa fa-key fa-fw"></i>  <?=Yii::t('app','change password')?></a></li>
				    <li><a href="<?=\yii\helpers\Url::to(['site/logout'])?>"> <i class="icon fa fa-trello fa-fw"></i>  <?=Yii::t('app','exit')?></a></li>
          </ul>
        <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== MANUFACTURES: END ============================================== -->
    </div>
</div><!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->

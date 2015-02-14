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
            <li><a href="<?=\yii\helpers\Url::to(['user/profile'])?>"> <i class="fa fa-user"></i> <?=Yii::t('app','basic information')?></a></li>
            <li><a href="<?=\yii\helpers\Url::to(['user/history'])?>"> <i class="fa fa-exchange"></i> <?=Yii::t('app','history transaction')?></a></li>
            <li><a href="<?=\yii\helpers\Url::to(['user/discussion'])?>"> <i class="fa fa-envelope"></i> <?=Yii::t('app','product discussion')?></a></li>
            <li><a href="<?=\yii\helpers\Url::to(['user/address'])?>"> <i class="fa fa-map-marker"></i> <?=Yii::t('app','addresses')?></a></li>
            <li><a href="<?=\yii\helpers\Url::to(['user/chpassword'])?>"> <i class="fa fa-key"></i> <?=Yii::t('app','change password')?></a></li>
            <li><a href="<?=\yii\helpers\Url::to(['site/logout'])?>"> <i class="fa fa-trello"></i> <?=Yii::t('app','logout')?></a></li>
          </ul>
        <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== MANUFACTURES: END ============================================== -->
    </div>
</div><!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->

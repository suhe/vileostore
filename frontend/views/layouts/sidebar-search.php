<!-- ============================================== SIDEBAR ============================================== -->	
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">

    <!-- ================================== Search Bar By Price ================================== -->
    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
	<h3 class="section-title"><?=Yii::t('app','search by details')?></h3>
	    <div class="sidebar-widget-body ">
		<?php
		$form = \yii\bootstrap\ActiveForm::begin([
		    'id' => 'formPrice',
		    'method' => 'GET',
		    'action' => ['product/search'],
		    'options' => ['class' => 'form-horizontal'],
		    'fieldConfig' => [
			'template' => "<div class='col-md-12'>{label}{input}{error}</div>",
			//'labelOptions' => ['class' => 'col-sm-2 control-label'],
		    ],
		]);?>
		<?=$form->field(new \common\models\Product(),'name')->textInput(['value' => $this->params['product_name']])?>
		<?=$form->field(new \common\models\Product(),'category_id')->dropDownList(\common\models\Category::getHierarchyList(),['options'=>[$this->params['category_id'] => ["\nselected" => true]]])?>
		<?=$form->field(new \common\models\Product(),'brand_id')->dropDownList(\common\models\Brand::getDropDownList(),['options'=>[$this->params['brand_id'] => ["\nselected" => true]]])?>	
		<?=$form->field(new \common\models\Product(),'price_down')->textInput(['value' => $this->params['price_down'],'class' => 'form-control text-right'])?>
		<?=$form->field(new \common\models\Product(),'price_high')->textInput(['value' => $this->params['price_high'],'class' => 'form-control text-right'])?>
		
		<div class='col-md-12'>
		    <div class="form-group pull-right" >
			<?=\yii\helpers\Html::submitButton('<i class="fa fa-search icon-on-right"></i> '.Yii::t('app','search'), ['class' => 'btn btn-primary btn-md','name' => 'search'])?>
		    </div>
		    <div class="clearfix"></div>
		</div>
		<?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->
	</div><!-- /.sidebar-widget-body -->
    </div><!-- /.sidebar-widget -->
    <!-- ================================== Search Bar By Price ================================== -->

</div><!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->

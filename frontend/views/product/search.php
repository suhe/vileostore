<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','search'),'url' => ['product/search']],
];

$this->title = Yii::t('app','search');
//search
$this->params['product_name']= isset(Yii::$app->request->QueryParams['Product']['name'])?Yii::$app->request->QueryParams['Product']['name']:'';
$this->params['category_id']= isset(Yii::$app->request->QueryParams['Product']['category_id'])?Yii::$app->request->QueryParams['Product']['category_id']:'';
$this->params['price_down']= isset(Yii::$app->request->QueryParams['Product']['price_down'])?Yii::$app->request->QueryParams['Product']['price_down']:'';
$this->params['price_high']= isset(Yii::$app->request->QueryParams['Product']['price_high'])?Yii::$app->request->QueryParams['Product']['price_high']:'';
$this->params['brand_id']= isset(Yii::$app->request->QueryParams['Product']['brand_id'])?Yii::$app->request->QueryParams['Product']['brand_id']:'';
$this->params['sort_by']= isset(Yii::$app->request->QueryParams['Product']['sort_by'])?Yii::$app->request->QueryParams['Product']['sort_by']:'';

?>
<div class="clearfix filters-container m-t-10">
    <div class="row">
	<!-- /.col -->
	<div class="col col-sm-12 col-md-8">
	<?=Yii::t('app','query result')?> :
	<?=isset(Yii::$app->request->QueryParams['Product']['name'])?Yii::$app->request->QueryParams['Product']['name']:'';?>
	<?=Yii::t('app','availability')?> :
	<?=$pages->totalCount?> <?=Yii::t('app','result')?>
	</div><!-- /.col -->
			    
			    <div class="col col-sm-6 col-md-4 text-right">
				<div class="pagination-container">
				    <?=\yii\widgets\LinkPager::widget([
					'pagination' => $pages,
					'options' => ['class' => 'list-inline list-unstyled'],
					'prevPageLabel' => '&lt;',
					'prevPageCssClass' => 'prev',
					'nextPageLabel' => '&gt;',
					'nextPageCssClass' => 'next',
					'view' => 2
				    ])
				    ?>
				</div><!-- /.pagination-container -->
			    </div><!-- /.col -->
			</div><!-- /.row -->
		    </div>
		    
		    <div class="search-result-container">
			<div id="myTabContent" class="tab-content">			
			    <div class="tab-pane active"  id="list-container">
				<div class="category-product  inner-top-vs">
				    <?=$this->render($listView,['query' => $query]);?>
				</div><!-- /.category-product -->
			    </div><!-- /.tab-pane #list-container -->
			    
			</div><!-- /.tab-content -->
			
					<div class="clearfix filters-container">
						
							<div class="text-right">
						         <div class="pagination-container">
	<?=\yii\widgets\LinkPager::widget([
					'pagination' => $pages,
					'options' => ['class' => 'list-inline list-unstyled'],
					'prevPageLabel' => '&lt;',
					'prevPageCssClass' => 'prev',
					'nextPageLabel' => '&gt;',
					'nextPageCssClass' => 'next',
					'view' => 2
				    ])
				    ?>
</div><!-- /.pagination-container -->						    </div><!-- /.text-right -->
						
					</div><!-- /.filters-container -->

				</div><!-- /.search-result-container -->
<?php
$js = <<<JS

JS;
$this->registerJs($js);
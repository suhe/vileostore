<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app',$category->name),'url' => ['product/category','id'=>$category->id]],
];
$this->title = $category->name;
?>
<div class="clearfix filters-container m-t-10">
    <div class="row">
	<!-- /.col -->
	<div class="col col-sm-6 col-md-2">
	    <!-- /.filter-tabs -->
	    <div class="filter-tabs">
		<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
		    <li <?=$view=='list' || !$view?'class="active"' : ''?>>
			<?=\yii\helpers\Html::a('<i class="icon fa fa-th-list"></i> '.Yii::t('app','list'),['product/category','id'=>$category->id ,'view' => 'list','sort' =>isset(Yii::$app->request->QueryParams['sort'])?Yii::$app->request->QueryParams['sort']:'','orderby' => isset(Yii::$app->request->QueryParams['orderby'])?Yii::$app->request->QueryParams['orderby']:'',$pages->pageSizeParam=>isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page'] ])?>
		    </li>
		    <li <?=$view=='grid'?'class="active"' : ''?>>
			<?=\yii\helpers\Html::a('<i class="icon fa fa-th"></i> '.Yii::t('app','grid'),['product/category','id'=>$category->id ,'view' => 'grid','sort' =>isset(Yii::$app->request->QueryParams['sort'])?Yii::$app->request->QueryParams['sort']:'','orderby' => isset(Yii::$app->request->QueryParams['orderby'])?Yii::$app->request->QueryParams['orderby']:'',$pages->pageSizeParam=>isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page'] ])?>
		    </li>
		</ul>
	    </div><!-- /.filter-tabs -->
	</div><!-- /.col -->
	<!-- /.col -->
	<div class="col col-sm-12 col-md-6">
	    <div class="col col-sm-3 col-md-6 no-padding">
		<!-- /.lbl-cnt -->
		<div class="lbl-cnt">
		    <!-- /.fld -->
		    <span class="lbl"><?=Yii::t('app','sort by')?></span>
		    <div class="fld inline">
			<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
			    <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
				<?php
				if(isset(Yii::$app->request->QueryParams['sort'])){
				    switch(Yii::$app->request->QueryParams['sort']){
					case 'name': $string = Yii::$app->request->QueryParams['orderby']=='asc'?Yii::t('app','name A to Z'):Yii::t('app','name Z to A');break;
					case 'price': $string = Yii::$app->request->QueryParams['orderby']=='asc'?Yii::t('app','lower to high'):Yii::t('app','high to lower');break;
					default: $string=Yii::t('app','sort by');break;
				    }
				}
				else {
				    $string=Yii::t('app','sort by');
				}
				?>
				    <?=$string?>
				    <span class="caret"></span>
			    </button>
			    <ul role="menu" class="dropdown-menu">
				<li role="presentation"><?=\yii\helpers\Html::a(Yii::t('app','name A to Z'),['product/category','id'=>$category->id ,'view' => $view,'sort' =>'name','orderby' => 'asc',$pages->pageSizeParam=>isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page'] ])?></li>
				<li role="presentation"><?=\yii\helpers\Html::a(Yii::t('app','name Z to A'),['product/category','id'=>$category->id ,'view' => $view,'sort' =>'name','orderby' => 'desc',$pages->pageSizeParam => isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page']])?></li>
				<li role="presentation"><?=\yii\helpers\Html::a(Yii::t('app','price lower to high'),['product/category','id'=>$category->id ,'view' => $view,'sort' =>'price','orderby' => 'asc',$pages->pageSizeParam =>isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page']])?></li>
				<li role="presentation"><?=\yii\helpers\Html::a(Yii::t('app','price high to lower'),['product/category','id'=>$category->id ,'view' => $view,'sort' =>'price','orderby' => 'desc',$pages->pageSizeParam => isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page'] ])?></li>
			    </ul>
			</div>
		    </div>
		    <!-- /.fld -->
		</div><!-- /.lbl-cnt -->
	    </div><!-- /.col -->
				
				<div class="col col-sm-3 col-md-6 no-padding">
				    <div class="lbl-cnt">
					<span class="lbl"><?=Yii::t('app','page')?></span>
					<div class="fld inline">
					    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
						<button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
						    <?=isset(Yii::$app->request->QueryParams[$pages->pageSizeParam])?Yii::$app->request->QueryParams[$pages->pageSizeParam]:Yii::$app->params['show_page']?> <span class="caret"></span>
						</button>

						<ul role="menu" class="dropdown-menu">
						    <?php foreach(Yii::$app->params['list_page'] as $page){?>
							<li role="presentation"><?=\yii\helpers\Html::a($page,['product/category','id'=>$category->id,'view' => $view,'sort' => isset(Yii::$app->request->QueryParams['sort'])?Yii::$app->request->QueryParams['sort']:'','orderby' => isset(Yii::$app->request->QueryParams['orderby'])?Yii::$app->request->QueryParams['orderby']:'',$pages->pageSizeParam=>$page])?></li>
						    <?php } ?>
						</ul>
					    </div>
					</div><!-- /.fld -->
				    </div><!-- /.lbl-cnt -->
				</div><!-- /.col -->		
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
			    <div class="tab-pane <?=$view=='grid'?'active' : ''?>" id="grid-container">
				<div class="category-product inner-top-vs">
				    <?=$this->render($gridView,['query' => $query]);?>
				</div><!-- /.category-product -->
						
			    </div><!-- /.tab-pane -->
							
			    <div class="tab-pane <?=$view=='list' || !$view?'active' : ''?>"  id="list-container">
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
<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','my profile'),'url' => ['user/profile']],
    ['label' => Yii::t('app','history transaction'),'url' => ['user/history']],
];

$this->title = Yii::t('app','history transaction');

?>
<div class="contact-page"> 
    <div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title" style="border-bottom: 1px solid #CCC">
	    <h4 style="margin-bottom:5px"><?=Yii::t('app','history transaction')?></h4>
	</div>
	
    <div class="col-md-12 clearfix" style="margin-top:10px">	
	<?=\yii\grid\GridView::widget([
	    'dataProvider' => $dataProvider,
	    'filterModel'  => $model,
	    'tableOptions' => ['class'=>'table table-striped table-bordered table-hover tc-table'],
	    'layout' => '{summary}{errors}{items}<div class="pagination pull-right">{pager}</div> <div class="clearfix"></div>',
	    'columns'=>[
		['class' => 'yii\grid\SerialColumn'],
		'invoice_no' => [
		    'attribute' => 'invoice_no',
		    'filter' => true,
		],
		'status' => [
		    'attribute' => 'status',
		    'value' =>function($data){ return $data->status==5?\yii\helpers\Html::a(Yii::t('app','waiting payment'),['user/history_details','id'=>$data->id]):\common\models\Order::stringStatus($data->status); },
		    'format' => 'raw',
		    'filter' => \yii\helpers\Html::activeDropDownList($model,'status',\common\models\Order::dropdownStatus(),['class' => 'form-control']),
		],
		'created_date' => [
		    'attribute' => 'created_date',
		    'filter' => false,
		],	
		['class'=>'yii\grid\ActionColumn',
		    'controller'=>'user',
		    'template'=>'{history_details}',
			'buttons' => [
			    'history_details' => function ($url, $model) { 
					return \yii\helpers\Html::a('<i class="fa fa-eye icon-only"></i> '.Yii::t('app','details'),$url,['class' => 'btn btn-inverse btn-xs']);
				    },
			],
		],
	    ],
	    //'showFooter' => true ,
	]);?>
    </div>
    
</div>
</div><!-- /.contact-page -->

<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','history transaction'),'url' => ['user/history']],
    ['label' => $data->invoice_no,'url'=>['user/history_details','id'=>$data->id]],
];

$this->title = Yii::t('app','history transaction');

?>
<div class="contact-page"> 
    <div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title" style="border-bottom: 1px solid #CCC">
	    <h4 style="margin-bottom:5px"><?=Yii::t('app','invoice')?> : <?=$data->invoice_no?></h4>
	    <p>
	    <?php
	    if($data->status==5)
		echo Yii::t('app/message','msg confirm payment click').' '.\yii\helpers\Html::a(Yii::t('app','this link'),['user/confirm_payment','id'=>$data->id]);
	    else if($data->status==4)
		echo \common\models\Order::stringStatus($data->status).', '.Yii::t('app/message','msg wait to admin verification your payment 1x24 jam')
	    ?>
	    </p>
	</div>
	
    <div class="col-md-12 " style="margin-top:10px">	
	<?=\yii\grid\GridView::widget([
	    'dataProvider' => $dataProvider,
	    'tableOptions' => ['class'=>'table table-striped  table-hover tc-table'],
	    'layout' => '{errors}{items}<div class="pagination pull-right">{pager}</div>',
	    'columns'=>[
		['class' => 'yii\grid\SerialColumn'],
		'image' => [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return himiklab\thumbnail\EasyThumbnailImage::thumbnailImg('@image_product/'.$data->product_id.'/'.$data->product_image,55,55,
			\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => $data->product_name]);},
                        'headerOptions' => ['style'=>'width:10%'],
                ],
		'name' => [
		    'attribute' => 'product_name',
		    'value' => function($data){ return \yii\helpers\Html::a($data->product_name,['product/read','id'=>$data->product_id,'slug' => $data->product_slug ]); },
		    'format' => 'raw',
		],
		'price' => [
		    'attribute' => 'product_price',
		    'format'=>['decimal',0],
		    'contentOptions' => ['class' => 'text-right'],
		],
		'qty' => [
		    'attribute' => 'qty',
		    'format'=>['decimal',0],
		    'contentOptions' => ['class' => 'text-right'],
		],
		'subtotal' => [
		    'attribute' => 'subtotal',
		    'format'=>['decimal',0],
		    'contentOptions' => ['class' => 'text-right'],
		],
		
	    ],
	    //'showFooter' => true ,
	]);?>
    </div>
    
</div>
    
<div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title" style="border-bottom: 1px solid #CCC">
	    <h4 style="margin-bottom:5px"><?=Yii::t('app','history transaction')?> : <?=$data->status>1?Yii::t('app','not a shippping'):$data->awb?></h4>
	</div>
	
    <div class="col-md-12 clearfix" style="margin-top:10px">	
	<?=\yii\grid\GridView::widget([
	    'dataProvider' => $dataProviderHistory,
	    'tableOptions' => ['class'=>'table table-striped table-hover','id'=>'basicTable'],
	    'layout' => '{errors}{items}<div class="pagination pull-right">{pager}</div> <div class="clearfix"></div>',
	    'columns'=>[
		[
		    'class' => 'yii\grid\SerialColumn',
		    'headerOptions' => ['style'=>'width:5%'],
		],    
		'created_date' => [
		    'attribute' => 'created_date',
		    'headerOptions' => ['style'=>'width:15%'],
		    'value' => function($data) {return Yii::$app->formatter->asDate($data->created_date,'php:d/m/Y H:i:s');},
		    'contentOptions' => ['class'=>'text-center'],
		],
		'type' => [
		    'attribute' => 'type',
		    'headerOptions' => ['style'=>'width:10%'],
		],            
		'description' => [
		    'attribute' => 'description',
		    'headerOptions' => ['style'=>'width:20%'],
		],
		'user_name' => [
		    'attribute' => 'user_name',
		    'headerOptions' => ['style'=>'width:15%'],
		    'filter' => false
		],
	    ],
		
	]);?>
    </div>
    
</div>
    
    
</div><!-- /.contact-page -->
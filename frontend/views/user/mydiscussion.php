<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','my profile'),'url' => ['user/profile']],
    ['label' => Yii::t('app','product discussion'),'url'=>['user/discussion']],
];

$this->title = Yii::t('app','product discussion');

?>

<div class="blog-page">
    <div class="col-md-12 blog-review">
        <h4><?=Yii::t('app','product discussion')?></h4>
        <?php foreach($query as $row){ ?>
        <div class="blog-post-author-details wow fadeInUp animated">
            <div class="row">
                <div class="col-md-2">
                    <?=himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
			'@image_product/'.$row->product_id.'/'.$row->product_image,
			100,
                        100,
			\himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
			['alt' => $row->product_name,'class' => 'img-circle img-responsive' ]
		    );?>            
                </div>
                <div class="col-md-10">
                    <h4><?=\yii\helpers\Html::a($row->product_name,['product/read','id'=>$row->product_id])?></h4>
                        <div class="btn-group author-social-network pull-right">
                            <span><?=Yii::t('app','action')?></span>
                            <button data-toggle="dropdown" class="dropdown-toggle" type="button">
                                    <i class="twitter-icon fa fa-pencil"></i>
                                    <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="<?=\yii\helpers\Url::to(['product/read','id'=>$row->product_id])?>"><i class="icon fa fa-link"></i><?=Yii::t('app','go to discussion')?></a></li>
                                <li><a href="<?=\yii\helpers\Url::to(['user/removedisc','id'=>$row->id])?>"><i class="icon fa fa-remove"></i><?=Yii::t('app','remove')?></a></li>
                            </ul>
                        </div>
                        <span class="author-job"><?=$row->review.' '.Yii::t('app','reviews').', '.Yii::t('app','latest by').' '.$row->user_name?> </span>
                        <p><?=$row->description?></p>
                </div>
            </div>
            
    </div>
        <?php } ?>
    </div>
    
    <div class="col col-sm-12 col-md-12 text-right">
	<div class="pagination-container">
	    <?=\yii\widgets\LinkPager::widget([
		'pagination' => $pages,
		'prevPageLabel' => '&lt;',
		'prevPageCssClass' => 'prev',
		'nextPageLabel' => '&gt;',
		'nextPageCssClass' => 'next',
		'view' => 2
		])
	    ?>
	</div><!-- /.pagination-container -->
    </div><!-- /.col -->
			    
</div>
						
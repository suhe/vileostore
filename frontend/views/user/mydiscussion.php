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
        <div class="blog-post-author-details wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            
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
                            <span>Follow me on</span>
                            <button data-toggle="dropdown" class="dropdown-toggle" type="button">
                                    <i class="twitter-icon fa fa-twitter"></i>
                                    <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#"><i class="icon fa fa-facebook"></i>Facebook</a></li>
                                <li><a href="#"><i class="icon fa fa-linkedin"></i>Linkedin</a></li>
                                <li><a href=""><i class="icon fa fa-pinterest"></i>Pinterst</a></li>
                                <li><a href=""><i class="icon fa fa-rss"></i>RSS</a></li>
                            </ul>
                        </div>
                        <span class="author-job">Web Designer</span>
                        <p><?=$row->description?></p>
                </div>
            </div>
            
    </div>
        <?php } ?>
    </div>
</div>
						
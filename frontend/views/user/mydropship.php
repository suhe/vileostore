<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','my profile'),'url' => ['user/profile']],
    ['label' => Yii::t('app','dropship'),'url'=>['user/dropship']],
];
$this->title = Yii::t('app','dropship');
?>

<div class="blog-page">
    <p class="text-danger"><?=Yii::$app->session->getFlash('msg')?></p>	
    <div class="col-md-12 blog-review">
        <h4><?=Yii::t('app','address')?> - <?=\yii\helpers\Html::a(Yii::t('app','add new'),['user/adddropship'],['class' => 'pull-right' ])?></h4>
        <?php foreach($query as $row){ ?>
        <div class="blog-post-author-details wow fadeInUp animated">
            <div class="row">
                <div class="col-md-12">
                    <h4><?=\yii\helpers\Html::a($row->receiver.'-'.$row->receiver_contact,['user/addressedit','id'=>$row->id])?>
		    
		    </h4>
                        <div class="btn-group author-social-network pull-right">
                            <span><?=Yii::t('app','action')?></span>
                            <button data-toggle="dropdown" class="dropdown-toggle" type="button">
                                    <i class="twitter-icon fa fa-pencil"></i>
                                    <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="<?=\yii\helpers\Url::to(['user/editdropship','id'=>$row->id])?>"><i class="icon fa fa-pencil"></i><?=Yii::t('app','edit')?></a></li>
                                <li><a href="<?=\yii\helpers\Url::to(['user/removedropship','id'=>$row->id])?>"><i class="icon fa fa-remove"></i><?=Yii::t('app','remove')?></a></li>
                            </ul>
                        </div>
                        <span class="author-job"><?=Yii::t('app','latest date').' '.Yii::$app->formatter->asDatetime(($row->updated_date?$row->updated_date:$row->created_date),"php:m/d/Y")?> </span>
                        <p><?=$row->address.' '.$row->town.' '.$row->city.' '.$row->province?></p>
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
						
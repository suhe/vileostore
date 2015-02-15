<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','register & login'),'url' => ['site/login']],
    ['label' => Yii::t('app','forgot password'),'url' => ['site/forgot_password']],
];
$this->title = Yii::t('app','reset password');
?>
<div class="sign-in-page inner-bottom-sm">
    <div class="row">
        <!-- Sign-in -->			
        <div class="col-md-6 col-sm-6 sign-in">
            <h4 class=""><?=Yii::t('app','reset password')?></h4>
            <p class=""><?=Yii::$app->session->getFlash('msg')?></p>
            <?php
	    $form = \yii\bootstrap\ActiveForm::begin([
                'id' => 'form',
		'method' => 'post',
		'options' => ['class' => 'register-form outer-top-xs'],
                    'fieldConfig' => [
                    'template' => "{label}{input}{error}",
		//'labelOptions' => ['class' => 'col-sm-2 control-label'],
		],
	    ]);?>
	    <?=count($query)?>
            <?=$form->field($model,'new_password')->passwordInput(['class' => 'form-control unicase-form-control text-input'])?>
	    <?=$form->field($model,'confirm_password')->passwordInput(['class' => 'form-control unicase-form-control text-input'])?>
            <!-- /.action -->
            <div class="action text-right">
		<?=\yii\helpers\Html::submitButton('<i class="fa fa-key icon-on-right"></i> '.Yii::t('app','send password'), ['class' => 'btn btn-primary btn-md','name' => 'login'])?>
	    </div><!-- /.action -->
            <div class="clearfix"></div>
	    
	    
	    <div class="clearfix"></div>
	    
            <?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->					
        </div>
        <!-- Sign-in -->

    </div><!-- /.row -->
</div><!-- /.sigin-in-->
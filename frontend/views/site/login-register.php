<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','register & login'),'url' => ['site/login']],
];
$this->title = Yii::t('app','register & login');
?>
<div class="sign-in-page inner-bottom-sm">
    <div class="row">
        <!-- Sign-in -->			
        <div class="col-md-6 col-sm-6 sign-in">
            <h4 class=""><?=Yii::t('app','sign in')?></h4>
            <p class=""><?=Yii::$app->session->getFlash('msg')?Yii::$app->session->getFlash('msg'):Yii::t('app','welcome back')?></p>
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
            <?=$form->field($loginModel,'email')->textInput(['class' => 'form-control unicase-form-control text-input'])?>
            <?=$form->field($loginModel,'password')->passwordInput(['class' => 'form-control unicase-form-control text-input'])?>
	    
            <!-- /.action -->
            <div class="action text-right">
		<?=\yii\helpers\Html::submitButton('<i class="fa fa-key icon-on-right"></i> '.Yii::t('app','sign in'), ['class' => 'btn btn-primary btn-md','name' => 'login'])?>
	    </div><!-- /.action -->
            <div class="clearfix"></div>
	    
	    <div class="radio outer-xs">
		<?=\yii\helpers\Html::a(Yii::t('app','forgot password'),['site/forgot_password'],['class' => 'forgot-password'])?>
	    </div>
	    <div class="clearfix"></div>
	    
            <?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->					
        </div>
        <!-- Sign-in -->

	<!-- create a new account -->
	<div class="col-md-6 col-sm-6 create-new-account">
	    <h4 class="checkout-subtitle"><?=Yii::t('app','create a new account')?></h4>
	    <p class="text title-tag-line"><?=Yii::t('app','sign up account')?></p>
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
	    <?=$form->field($registerModel,'first_name')->textInput(['class' => 'form-control unicase-form-control text-input'])?>
	    <?=$form->field($registerModel,'middle_name')->textInput(['class' => 'form-control unicase-form-control text-input'])?>
	    <?=$form->field($registerModel,'last_name')->textInput(['class' => 'form-control unicase-form-control text-input'])?>
	    <?=$form->field($registerModel,'email')->textInput(['class' => 'form-control unicase-form-control text-input'])?>
            <?=$form->field($registerModel,'password')->passwordInput(['class' => 'form-control unicase-form-control text-input'])?>
	    <!-- /.action -->
            <div class="action text-right">
		<?=\yii\helpers\Html::submitButton('<i class="fa fa-pencil icon-on-right"></i> '.Yii::t('app','sign up'), ['class' => 'btn btn-primary btn-md','name' => 'register'])?>
	    </div><!-- /.action -->
	    <div class="clearfix"></div> 		
	    <?php \yii\bootstrap\ActiveForm::end() ?><!-- /.cnt-form -->			
	</div>
	
	<!-- create a new account -->
    </div><!-- /.row -->
</div><!-- /.sigin-in-->
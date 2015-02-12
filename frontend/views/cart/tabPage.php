<ul class="wizard-steps">
    <li data-target="#step1" class="active">
	<span class="step">1</span>
	<span class="title"><?=\yii\helpers\Html::a(Yii::t('app','shopping cart'),['cart/shopping'])?></span>
    </li>
	
    <li data-target="#step2">
	<span class="step">2</span>
	<span class="title"><?=\yii\helpers\Html::a(Yii::t('app','shipping address'),['cart/address'])?></span>
    </li>
	
    <li data-target="#step3">
	<span class="step">3</span>
	<span class="title"><?=\yii\helpers\Html::a(Yii::t('app','payment'),['cart/payment'])?></span>
	</li>
	
    <li data-target="#step4">
	<span class="step">4</span>
	<span class="title"><?=\yii\helpers\Html::a(Yii::t('app','finish'),['cart/finish'])?></span>
    </li>
</ul>
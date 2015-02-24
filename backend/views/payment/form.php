<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','administration'),'url' => ['#']],
    ['label' => Yii::t('app','payment'),'url' => ['payment/index']],
    ['label' => Yii::t('app','form payment'),'url' => ['payment/edit']],
];
$this->title = Yii::t('app','payment');
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
 ;
?>

<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-transparent ">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','form payment')?></div>
                    <div class="btn-group pull-right m-b-10">
                        <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=Html::a('<i class="fa fa-times"></i> '.Yii::t('app','exit'),['payment/index'])?></li>
                            </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="panel-body">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'form-work',
                        'options' => [
                            'class' => 'form-horizontal',
                            'role' => 'form',
                            'autocomplete' =>'off',
                            'enctype'=>'multipart/form-data',
                        ],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-9">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-3 control-label'],
                        ],
                    ]); ?>
                    <?=$form->field($model,'account')->textInput()?>
                    <?=$form->field($model,'owner')->textInput()?>
                    <?=$form->field($model,'name')->textInput()?>
                    <?=$form->field($model,'branch')->textInput()?>
                    <?=$form->field($model,'status')->inline()->radioList(['1'=>Yii::t('app','active'),'0'=>Yii::t('app','non active')]); ?>
                    <?=$form->field($model,'order')->textInput(['style'=>'width:10%'])?>
                    <?=$form->field($model,'icon')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*',],
                        'pluginOptions' => [
                            'initialPreview' => [
                                isset($model->id)?Html::img(str_replace('backend/web/','',Yii::$app->request->baseUrl.'/assets/images/banks/'.$model->id.'/'.$model->icon), ['class'=>'file-preview-image img-responsive']):'',
                            ],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ]
                    ]);?>
                    <div class="form-group" style="margin-bottom:20px">
                        <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>    
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
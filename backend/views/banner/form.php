<?php
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','catalog'),'url' => ['#']],
    ['label' => Yii::t('app','banner'),'url' => ['banner/index']],
    ['label' => Yii::t('app','form banner'),'url' => ['banner/edit']],
];
$this->title = Yii::t('app','banner');
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
                    <div class="panel-title"><?=Yii::t('app','form banner')?></div>
                    <div class="btn-group pull-right m-b-10">
                        <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=Html::a('<i class="fa fa-times"></i> '.Yii::t('app','exit'),['banner/index'])?></li>
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
                    <?=$form->field($model, 'image')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*',],
                        'pluginOptions' => [
                            'initialPreview' => [
                                isset($model->id)?Html::img(str_replace('backend/web/','',Yii::$app->request->baseUrl.'/assets/images/banners/'.$model->id.'/'.$model->image), ['class'=>'file-preview-image img-responsive']):'',
                            ],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ]
                    ]);?>
                    <?=$form->field($model,'name')->textInput()?>
                    <?=$form->field($model,'description')->textInput()?>
                    <?=$form->field($model,'status')->inline()->radioList(['1'=>Yii::t('app','active'),'0'=>Yii::t('app','non active')]); ?>
                    <?=$form->field($model,'link_url')->textInput()?>
                    <?=$form->field($model,'slide')->dropDownList(\common\models\Banner::dropDownSlide(false),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
                    <?=$form->field($model,'position')->dropDownList(\common\models\Banner::dropDownPosition(false),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
                    <?=$form->field($model,'width')->textInput(['style'=>'width:10%','data-a-dec'=>'.','data-a-sep'=>',','class'=>'autonumeric form-control text-right'])?>
                    <?=$form->field($model,'height')->textInput(['style'=>'width:10%','data-a-dec'=>'.','data-a-sep'=>',','class'=>'autonumeric form-control text-right'])?>
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
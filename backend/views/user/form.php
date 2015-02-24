<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','administration'),'url' => ['user/admin']],
    ['label' => Yii::t('app','administrator'),'url' => ['user/admin']],
    ['label' => Yii::t('app','form administrator'),'url' => ['user/add','id'=>isset(Yii::$app->request->QueryParams['id'])]],
];
$this->title = Yii::t('app','user information');

?>

<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-transparent ">
                <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app','form user')?></div>
                    <div class="btn-group pull-right m-b-10">
                        <button type="button" class="btn btn-default"><i class="fa fa-list"></i> <?=Yii::t('app','toolbar')?> </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=Html::a('<i class="fa fa-times"></i> '.Yii::t('app','exit'),['category/index'])?></li>
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
                        ],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-9">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-3 control-label'],
                        ],
                    ]); ?>
                    <?=$form->field($model,'group_id')->dropDownList(\common\models\User::dropdownGroup(false),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
                    <?=$form->field($model,'first_name')->textInput()?>
                    <?=$form->field($model,'middle_name')->textInput()?>
                    <?=$form->field($model,'last_name')->textInput()?>
                    <?=$form->field($model,'email')->textInput()?>
                    <?=$form->field($model,'password')->passwordInput()?>
                    <?=$form->field($model,'status')->dropDownList(\common\models\User::dropdownStatus(false),['class'=>'cs-select cs-skin-slide','data-init-plugin'=>'cs-select'])?>
                    <div class="form-group" style="margin-bottom:10px">
                        <?=Html::submitButton('<i class="fa fa-save icon-on-right"></i> '.Yii::t('app','save'), ['class' => 'btn btn-primary btn-md pull-right','name' => 'post'])?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>    
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
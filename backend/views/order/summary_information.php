<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','order'),'url' => ['order/index']],
    ['label' => Yii::t('app','summary'),'url' => ['order/summary','id'=>isset(Yii::$app->request->QueryParams['id'])]],
];
$this->title = Yii::t('app','summary');

?>

<div class="row">
    <div class="col-md-6">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','invoice no')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=$data->invoice_no?></h5>
                    <h4 class="no-margin text-white"><?=$data->invoice_no?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','date')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=$data->created_date?></h5>
                    <h4 class="no-margin text-white"><?=$data->created_date?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','type')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=\common\models\Order::stringType($data->type)?></h5>
                    <h4 class="no-margin text-white"><?=\common\models\Order::stringType($data->type)?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','customer')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=$data->customer_name?></h5>
                    <h4 class="no-margin text-white"><?=$data->customer_name?></h4>
                </div>
            </div>
        </div>
    </div>
    
     <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','courier')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=$data->courier_name?></h5>
                    <h4 class="no-margin text-white"><?=$data->courier_name?></h4>
                </div>
            </div>
        </div>
    </div>
     
     <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','shipping value')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=Yii::$app->Formatter->asDecimal($data->shipping_cost,0)?></h5>
                    <h4 class="no-margin text-white"><?=Yii::$app->Formatter->asDecimal($data->shipping_cost,0)?></h4>
                </div>
            </div>
        </div>
    </div>
     
     <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','bank')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=$data->bank_name?></h5>
                    <h4 class="no-margin text-white"><?=$data->bank_name?></h4>
                </div>
            </div>
        </div>
    </div>
     
    <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','sub total')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=Yii::$app->Formatter->asDecimal($data->sub_total,0)?></h5>
                    <h4 class="no-margin text-white"><?=Yii::$app->Formatter->asDecimal($data->sub_total,0)?></h4>
                </div>
            </div>
        </div>
    </div>
     
    <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','status')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=\common\models\Order::stringStatus($data->status)?></h5>
                    <h4 class="no-margin text-white"><?=\common\models\Order::stringStatus($data->status)?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 box">
        <div class="container-sm-height">
            <div class="row row-sm-height b-a b-grey">
                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                    <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','grand total')?></h5>
                </div>
                <div class="col-sm-9 text-right bg-primary col-sm-height col-middle padding-10">
                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold"><?=Yii::$app->Formatter->asDecimal($data->grand_total,0)?></h5>
                    <h4 class="no-margin text-white"><?=Yii::$app->Formatter->asDecimal($data->grand_total,0)?></h4>
                </div>
            </div>
        </div>
    </div>
    
</div>
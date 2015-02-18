<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','order'),'url' => ['order/index']],
    ['label' => Yii::t('app','invoice'),'url' => ['order/invoice','id'=>Yii::$app->request->QueryParams['id']]],
];
$this->title = Yii::t('app','invoice');

?>

<div class="invoice padding-20 sm-padding-10">
    <div>
        <div class="pull-left">
            <img width="200" height="58" alt="" class="invoice-logo" data-src-retina="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" data-src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png" src="<?=Yii::$app->request->baseUrl?>/assets/images/logo.png">
            <address class="m-t-10"><?=Yii::$app->setting->Variable('Store Address')->content?>
            <br><?=Yii::$app->setting->Variable('Hunting Phone')->content?>
            <br>
            </address>
        </div>
        <div class="pull-right sm-m-t-20">
            <h2 class="font-montserrat all-caps hint-text"><?=Yii::t('app','invoice')?></h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
    <div class="container-sm-height">
        <div class="row-sm-height">
            <div class="col-md-9 col-sm-height sm-no-padding">
                <p class="small no-margin"><?=Yii::t('app','invoice to')?></p>
                <h5 class="semi-bold m-t-0"><?=$data->receiver?></h5>
            <address>
            <?=$data->address?>
            </address>
            </div>
            <div class="col-md-3 col-sm-height col-bottom sm-no-padding sm-p-b-20">
                <br>
                <div>
                    <div class="pull-left font-montserrat bold all-caps"><?=Yii::t('app','invoice no')?>:</div>
                    <div class="pull-right"><?=$data->invoice_no?></div>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="pull-left font-montserrat bold all-caps"><?=Yii::t('app','date')?> :</div>
                    <div class="pull-right"><?=Yii::$app->formatter->asDate($data->created_date,'php:d/m/Y');?></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table m-t-50">
        <thead>
            <tr>
            <th class=""><?=Yii::t('app','product name')?></th>
            <th class="text-center"><?=Yii::t('app','price')?></th>
            <th class="text-center"><?=Yii::t('app','qty')?></th>
            <th class="text-right"><?=Yii::t('app','sub total')?></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $grandtotal=0;
        foreach($details as $row){?>    
        <tr>
            <td class=""><p class="text-black"><?=$row->product_name?></p></td>
            <td class="text-center"><?=Yii::$app->Formatter->asDecimal($row->product_price,0)?></td>
            <td class="text-center"><?=Yii::$app->Formatter->asDecimal($row->qty,0)?></td>
            <td class="text-right"><?=Yii::$app->Formatter->asDecimal($row->subtotal,0)?></td>
        </tr>
        <?php
        $grandtotal+=$row->subtotal;
        } ?>  
        </tbody>
    </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div>
        <img width="150" height="58" alt="" class="invoice-signature" data-src-retina="assets/img/invoice/signature2x.png" data-src="assets/img/invoice/signature.png" src="assets/img/invoice/signature2x.png">
    <p><?=Yii::$app->setting->Variable('Store Name')->content?></p>
    </div>
    <br>
    <br>
    <div class="container-sm-height">
        <div class="row row-sm-height b-a b-grey">
            <div class="col-sm-2 col-sm-height col-middle p-l-25 sm-p-t-15 sm-p-l-15 clearfix sm-p-b-15">
                <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','sub total')?></h5>
                <h3 class="no-margin"><?=Yii::$app->Formatter->asDecimal($grandtotal,0)?></h3>
            </div>
        <div class="col-sm-5 col-sm-height col-middle clearfix sm-p-b-15">
        <h5 class="font-montserrat all-caps small no-margin hint-text bold"><?=Yii::t('app','shipping')?></h5>
        <h3 class="no-margin"><?=Yii::$app->Formatter->asDecimal($data->shipping_cost,0)?></h3>
        </div>
        <div class="col-sm-5 text-right bg-menu col-sm-height padding-15">
        <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
        <h1 class="no-margin text-white"><?=Yii::$app->Formatter->asDecimal($grandtotal+$data->shipping_cost,0)?></h1>
        </div>
        </div>
    </div>
</div>
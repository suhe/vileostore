<?php
namespace common\models;
use Yii;

class OrderProduct extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'order_product';
    }
    
    public function getOrder(){
        return $this->hasOne(\common\models\Order::className(), ['id' => 'order_id']);
    }
    
    public function getRequestOrder($items=[]){
        $model = new OrderProduct();
        $model->order_id = $items['order_id'];
        $model->product_id = $items['product_id'];
        $model->product_price = $items['product_price'];
        $model->product_weight = $items['product_weight'];
        $model->qty = $items['qty'];
        $model->subtotal = $items['subtotal'];
        $model->insert();
        return true;
    }
    
}
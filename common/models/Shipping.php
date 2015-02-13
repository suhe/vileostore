<?php
namespace common\models;
use Yii;

class Shipping extends \yii\db\ActiveRecord {
    
    public $labelid;
    public $name;
    public $icon;
    public $town;
   
    
    public static function tableName(){
        return 'shipping';
    }
    
    public function getCourier(){
        return $this->hasOne(Courier::className(), ['id' => 'courier_id']);
    }
    
    public function getTown(){
        return $this->hasOne(Town::className(), ['id' => 'town_id']);
    }
    
    public static function getShippingTotal($town_id){
        return static::find()
        ->select(['courier.id','courier.name','courier.icon','town.name town','shipping.cost'])
        ->joinWith('courier')
        ->joinWith('town')
        ->where(['town_id' => $town_id])
        ->all();
    }
    
}
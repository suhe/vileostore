<?php
namespace common\models;
use Yii;

class Courier extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'courier';
    }
    
    public function getShipping(){
        return $this->hasOne(Shipping::className(), ['id' => 'courier_id']);
    }
    
}
<?php
namespace common\models;

class Brand extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'brand';
    }
    
    public static function ActiveBrand(){
        return static::find()
        ->where(['status' => 1])
        ->all();    
    }
}
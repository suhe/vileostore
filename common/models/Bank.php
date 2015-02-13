<?php
namespace common\models;
use Yii;

class Bank extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'bank';
    }
    
    public static function getAccount(){
        return static::find()->all();
    }
    
}
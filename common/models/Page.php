<?php
namespace common\models;
use Yii;

class Page extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'page';
    }
    
    public static function content($options=[]){
        return static::find()
        ->where($options)
        ->all();
    }
    
    public static function publish($options=[]){
        return static::find()
        ->where($options)
        ->one();
    }
    
}
<?php
namespace common\models;
use Yii;

class Setting extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'setting';
    }
    
    public function rules(){
        return[
            [['id','name','type','content'],'safe'],
        ];
    }
    
    public function Variable($name){
        return static::find()
        ->where(['name' => $name])
        ->one();    
    }
}
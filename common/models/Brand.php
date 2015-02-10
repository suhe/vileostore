<?php
namespace common\models;
use Yii;

class Brand extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'brand';
    }
    
    public static function ActiveBrand(){
        return static::find()
        ->where(['status' => 1])
        ->all();    
    }
    
    public static function getDropDownList($All=true){
        $data = [];
        if($All) $data[0] = Yii::t('app','all brand');
        $query = static::find()
        ->all();
        
        foreach($query as $row){
            $data[$row->id] = $row->name;
        }
        return $data;
    }
}
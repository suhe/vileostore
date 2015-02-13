<?php
namespace common\models;
use Yii;

class Province extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'province';
    }
    
    public static function dropdownList($captionTitle='',$condition=[]){
        $options[0] = $captionTitle;
        $query = static::find();
        if($condition)
            $query = $query->andWhere($condition);
        
        $result = $query->all();
        
        foreach($result as $row){
            $options[$row->id] = $row->name;
        }
        
        return $options;
    }
    
}
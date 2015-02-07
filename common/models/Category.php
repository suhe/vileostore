<?php
namespace common\models;

class Category extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'category';
    }
    
    public function getProductCategory(){
        return $this->hasMany(\common\models\ProductCategory::className(), ['category_id' => 'id']);
    }
    
    public static function getNestedCategory($status,$parent_id){
        return static::find()
        ->where(['status' => $status , 'parent_id' => $parent_id ])
        ->all();    
    }
}
<?php
namespace common\models;

class ProductImage extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'product_image';
    }
    
    public function getProduct(){
        return $this->hasMany(Product::className(), ['product_id' => 'id']);
    }
    
}
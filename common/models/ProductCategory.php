<?php
namespace common\models;

class ProductCategory extends \yii\db\ActiveRecord {
    public $name;
    public $price;
    public $img_thumbnail;
    public $short_description;
    
    public static function tableName(){
        return 'product_category';
    }
    
    public function getProduct(){
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }
    
    public function getCategory(){
        return $this->hasOne(\common\models\Category::className(), ['id' => 'category_id']);
    }
    
    public function attributeLabels(){
        return [
            'product_id' => Yii::t('app','product id'),
            'category_id' => Yii::t('app','category id'),
            'name' => Yii::t('app','name'),
        ];
    }
    
    public function rules(){
        return[
            [['product_id'], 'required'],
            [['product_id','price'],'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
    
    public function getAllQueryWithPagination($id){
        return static::find()
        ->select(['product_category.product_id','product.name','product.price','product.img_thumbnail','product.short_description'])
        ->joinWith('product')
        ->where(['product_category.category_id' => $id])
        ->all();
    }
    
}
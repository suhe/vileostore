<?php
namespace common\models;
use Yii;

class ProductCategory extends \yii\db\ActiveRecord {
    public $name;
    public $price;
    public $image;
    public $short_description;
    public $online;
    public $cod;
    public $dropshier;
    
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
    
    public function getAllQueryWithPagination($id,$params){
        $query =  static::find()
        ->select(['product_category.product_id','product.name','product.price','product.image','product.short_description',
            'product.online','product.cod','product.dropshier'
        ])
        ->joinWith('product')
        ->where(['product_category.category_id' => $id]);
        
        if (!isset($params['sort'])) 
            return $query;
        
        if(($params['sort']=='name') && ($params['orderby']=='asc'))   $query = $query->orderBy(['product.name' => SORT_ASC]);
        if(($params['sort']=='name') && ($params['orderby']=='desc'))  $query = $query->orderBy(['product.name'=> SORT_DESC]);
        if(($params['sort']=='price') && ($params['orderby']=='asc'))  $query = $query->orderBy(['ABS(product.price)' => SORT_ASC]);
        if(($params['sort']=='price') && ($params['orderby']=='desc')) $query = $query->orderBy(['ABS(product.price)' => SORT_DESC]);
        
        return $query;
        
    }
    
}
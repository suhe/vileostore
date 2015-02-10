<?php
namespace common\models;
use Yii;
use yii\helpers\Html;

class Product extends \yii\db\ActiveRecord {
    
    public $product_id;
    public $price_down;
    public $price_high;
    public $category_id;
    public $sort_by;
    public $order_by;
    public $page;
    
    public static function tableName(){
        return 'product';
    }
    
    public function getProductCategory(){
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_id']);
    }
    
    public function getProduct_category(){
        return $this->hasOne(ProductCategory::className(), ['product_id' => 'id']);
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'name' => Yii::t('app','name'),
            'price_down' => Yii::t('app','price down'),
            'price_high' => Yii::t('app','price high'),
            'category_id' => Yii::t('app','category'),
            'brand_id' => Yii::t('app','brand'),
        ];
    }
    
    public function rules(){
        return[
            [['id','name'], 'required','on'=>['save']],
            [['id'],'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'safe'],
            [['category_id'], 'safe','on'=>['search']],
            [['brand_id'], 'safe','on'=>['search']],
            [['price_down'], 'safe','on'=>['search']],
            [['price_high'], 'safe','on'=>['search']],
            
        ];
    }
    
    public static function GetProductByCategory($category,$limit='',$status=''){
        $query = static::find()
        ->joinWith('product_category')
        ->where(['product_category.category_id' => $category]);
        
        if(!$status)
            return $query->all();
        
        $query = $query->andFilterWhere(['product.status' => $status]);
        return $query->all();
    }
    
    public static function getProductByCondition($condition=[]){
        $query = static::find()
        ->where($condition);
        return $query->all();
    }
    
    public static function NewProduct($limit,$category_id=0){
        $query = static::find()
        ->joinWith('product_category')
        ->orderBy(['product.id' => SORT_DESC])
        ->limit($limit);
        
        if(!$query)
            return $query=$query->all();
        
        $query = $query->andWhere(['product_category.category_id' => $category_id]);
        return $query = $query->all();
    }
    
    public function getAllQueryWithSearch($params){
        $query =  static::find()
        ->select(['product.id  product_id','name','price','image','short_description','online','cod','dropshier'])
         ->joinWith('product_category')
        ->andWhere(['status' => 1]);
        
        if (!$this->load($params))
            return $query;
        
        if ($this->load($params) && $this->name)
            $query = $query->andFilterWhere(['LIKE', 'name', $this->name]);
        
        if ($this->load($params) && $this->category_id)
            $query = $query->andFilterWhere(['product_category.category_id' => $this->category_id]);
            
        if ($this->load($params) && $this->brand_id)
            $query = $query->andWhere(['product.brand_id' => $this->brand_id]);
        
        if ($this->load($params) && $this->price_down)
            $query = $query->andFilterWhere(['>=', 'product.price', $this->price_down]);
        
        if ($this->load($params) && $this->price_high)
            $query = $query->andFilterWhere(['<=', 'product.price', $this->price_high]);
            
        //if(($params['sort']=='name') && ($params['orderby']=='asc'))   $query = $query->orderBy(['product.name' => SORT_ASC]);
        //if(($params['sort']=='name') && ($params['orderby']=='desc'))  $query = $query->orderBy(['product.name'=> SORT_DESC]);
        //if(($params['sort']=='price') && ($params['orderby']=='asc'))  $query = $query->orderBy(['ABS(product.price)' => SORT_ASC]);
        //if(($params['sort']=='price') && ($params['orderby']=='desc')) $query = $query->orderBy(['ABS(product.price)' => SORT_DESC]); 
        
        return $query;
    
        //if (!isset($params['sort'])) 
            //return $query;
        
    }
    
}
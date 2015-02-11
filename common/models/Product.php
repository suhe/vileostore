<?php
namespace common\models;
use Yii;
use yii\helpers\Html;
//use yz\shoppingcart\CartPositionInterface;
//implements CartPositionInterface
class Product extends \yii\db\ActiveRecord  {
    
    public $product_id;
    public $category_name;
    public $price_down;
    public $price_high;
    //public $category_id;
    public $sort_by;
    public $cost=0;
    
    
    public static function tableName(){
        return 'product';
    }
    
    public function getProductCategory(){
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_id']);
    }
    
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
            [['sort_by'], 'safe','on'=>['search']],
        ];
    }
    
    public static function getProductSortByList($All=true){
        $data = [];
        if($All)
            $data[0] = Yii::t('app','random sort');
        
        $data[1] = Yii::t('app','name A to Z');
        $data[2] = Yii::t('app','name Z to A');
        $data[3] = Yii::t('app','price lower to high');
        $data[4] = Yii::t('app','price high to lower');
        return $data;
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
        ->select(['product.id  product_id','category_id','name','price','image','short_description','online','cod','dropshier'])
        ->joinWith('product_category')
        ->andWhere(['status' => 1])
        ->groupBy('product.id');
        
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
        
        if ($this->load($params) && $this->sort_by==1)
            $query = $query->orderBy(['product.name' => SORT_ASC]);
            
        if ($this->load($params) && $this->sort_by==2)
            $query = $query->orderBy(['product.name'=> SORT_DESC]);
            
        if ($this->load($params) && $this->sort_by==3)
            $query = $query->orderBy(['ABS(product.price)' => SORT_ASC]);
            
        if ($this->load($params) && $this->sort_by==4)
            $query = $query->orderBy(['ABS(product.price)' => SORT_DESC]);
            
        return $query;
        
    }
    
    /**
     * Abstract for Shopping Cart
     * /
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getCost($withDiscount = true){
        return '2';
    }
    
    public function getCount($withDiscount = true){
        return '5';
    }
    
    public function setQuantity($quantity){
        return $quantity;
    }
    
    public function getQuantity(){
        
    }
    
    
     * Abstract for Shopping Cart
     * /
    **/
    
}
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
    public $price_down;
    public $price_high;
    public $brand_id = 0;
    public $arrival_date;
    public $stock;
    public $weight;
    
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
            [['name'], 'string', 'max' => 255],
            [['brand_id'],'safe'],
            [['price_down'],'safe'],
            [['price_high'],'safe']
        ];
    }
    
    public function getAllQueryWithPagination($id,$params){
        $query =  static::find()
        ->select(['product_category.product_id','product.name','product.price','product.image','product.short_description',
            'product.online','product.cod','product.dropshier','product.stock','product.arrival_date','product.weight'
        ])
        ->joinWith('product')
        ->where(['product_category.category_id' => $id]);
        
        if ($this->load($params) && $this->brand_id)
            $query = $query->andWhere(['product.brand_id' => $this->brand_id]);
        
        if ($this->load($params) && $this->price_down)
            $query = $query->andFilterWhere(['>=', 'product.price', $this->price_down]);
        
        if ($this->load($params) && $this->price_high)
            $query = $query->andFilterWhere(['<=', 'product.price', $this->price_high]);
            
        if (!isset($params['sort'])) 
            return $query;
        
        if(($params['sort']=='name') && ($params['orderby']=='asc'))   $query = $query->orderBy(['product.name' => SORT_ASC]);
        if(($params['sort']=='name') && ($params['orderby']=='desc'))  $query = $query->orderBy(['product.name'=> SORT_DESC]);
        if(($params['sort']=='price') && ($params['orderby']=='asc'))  $query = $query->orderBy(['ABS(product.price)' => SORT_ASC]);
        if(($params['sort']=='price') && ($params['orderby']=='desc')) $query = $query->orderBy(['ABS(product.price)' => SORT_DESC]); 
        return $query;
        
    }
    
}
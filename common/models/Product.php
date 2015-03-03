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
    
    public function getDiscussion(){
        return $this->hasMany(Discussion::className(), ['id' => 'product_id']);
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'name' => Yii::t('app','name'),
            'image' => Yii::t('app','image'),
            'price' => Yii::t('app','price'),
            'price_down' => Yii::t('app','price down'),
            'price_high' => Yii::t('app','price high'),
            'stock' => Yii::t('app','stock'),
            'category_id' => Yii::t('app','category'),
            'brand_id' => Yii::t('app','brand'),
            'short_description' => Yii::t('app','short description'),
            'long_description' => Yii::t('app','long description'),
        ];
    }
    
    public function rules(){
        return[
            [['id','name'], 'required','on'=>['save']],
            [['id'],'integer'],
            [['name'], 'string', 'max' => 255],
            [['sku'],'safe','on'=>['search']],
            [['name'],'safe','on'=>['search']],
            [['price'],'safe','on'=>['search']],
            [['weight'],'safe','on'=>['search']],
            [['status'],'safe','on'=>['search']],
            [['stock'],'safe','on'=>['search']],
            [['category_id'], 'safe','on'=>['search']],
            [['brand_id'], 'safe','on'=>['search']],
            [['arrival_date'], 'safe','on'=>['arrival date']],
            [['price_down'], 'safe','on'=>['search']],
            [['price_high'], 'safe','on'=>['search']],
            [['sort_by'], 'safe','on'=>['search']],
            
            //save/update information required
            [['sku','name','weight','category_id','brand_id'],'required','on'=>['save_information','update_information']],
            [['short_description','long_description'],'safe','on'=>['save_information','update_information']],
            //save/update options required
            [['stock','price','status','best_seller','online','cod','dropshier'],'required','on'=>['update_options']],
            [['arrival_date'],'safe','on'=>['update_options']],
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
        ->select(['product.id  product_id','product.category_id','name','price','stock',
                  'image','short_description','online','cod','dropshier','arrival_date'])
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
    
    public static function stringStatus($status){
        switch($status){
            case 1 : $str = Yii::t('app','active');break;
            default: $str = Yii::t('app','non active');break;   
        }
        return $str;
    }
    
    public static function dropdownStatus($All=true){
       if($All) $data[0] = Yii::t('app','all');
       $data[1] = Yii::t('app','active');
       $data[2] = Yii::t('app','non active');
       return $data;
    }

    public function getActiveDataProviderProduct($params){
        $query = static::find()
        ->joinWith('category')
        ->select(['product.id AS id','product.image','product.sku','product.name','product.price','product.stock',
                  'category.name AS category_name','product.status']);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_ASC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->sku?$query->andFilterWhere(['like','product.sku',$this->sku]):'';
        $this->name?$query->andFilterWhere(['like','product.name',$this->name]):'';
        $this->category_id?$query->andFilterWhere(['product.category_id'=>$this->category_id]):'';
        $this->status?$query->andFilterWhere(['product.status'=>$this->status]):'';
        $this->weight?$query->andFilterWhere(['product.weight'=>$this->weight]):'';
        $this->price?$query->andFilterWhere(['product.price'=>$this->price]):'';
        $this->stock?$query->andFilterWhere(['product.stock'=>$this->stock]):'';
        return $dataProvider;
    }
    
    public function getUpdateInformation($id=0){
        if($this->validate()){
            $model = new Product();
            if($id) $model = $model->findOne($id);
            $model->sku = $this->sku;    
            $model->name = $this->name;
            $model->slug = Yii::$app->store->slug($this->name);    
            $model->weight = str_replace(',','',$this->weight);
            $model->category_id = $this->category_id;
            $model->brand_id = $this->brand_id;
            $model->short_description = $this->short_description;
            $model->long_description = $this->long_description;
            if($id)
                $model->update();
            else
                $model->insert();
                
            $storeFolder = Yii::getAlias('@image_product/'.$model->id);
            $cdir = \yii\helpers\FileHelper::createDirectory($storeFolder,0777);
            return $model->id;
        }
        return false;
    }
    
    public function getUpdateOptions($id){
        if($this->validate()){
            $model = new Product();
            $model = $model->findOne($id);
            $model->price = str_replace(',','',$this->price);
            $model->stock = str_replace(',','',$this->stock);    
            $model->arrival_date = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1',$this->arrival_date);
            $model->status = $this->status;
            $model->best_seller = $this->best_seller;  
            $model->online = $this->online;
            $model->cod = $this->cod;
            $model->dropshier = $this->dropshier;
            $model->update();
            return true;
        }
        return false;
    }
    
    public static function TotalOrder($condition = []){
       return static::find()
        ->where($condition?$condition:'')
        ->count();
    }
    
    public static function getActiveDataProviderBestSeller($limit){
        $query = static::find()
        ->joinWith('category')
        ->select(['product.id AS id','product.image','product.sku','product.name','product.price','product.stock',
                  'category.name AS category_name','product.status'])
        ->limit($limit);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['best_seller'=> SORT_DESC]],
            'pagination' =>[
                'pageSize' => $limit
            ]    
        ]);
        return $dataProvider;
    }
    
}
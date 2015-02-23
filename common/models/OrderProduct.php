<?php
namespace common\models;
use Yii;

class OrderProduct extends \yii\db\ActiveRecord {
    public $sku;
    public $product_name;
    public $product_image;
    public $product_slug;
   
    
    public static function tableName(){
        return 'order_product';
    }
    
    public function rules(){
        return[
            [['sku'],'safe','on'=>['search']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'sku' => Yii::t('app','sku'),
            'product_name' => Yii::t('app','product name'),
        ];
    }
    
    
    public function getOrder(){
        return $this->hasOne(\common\models\Order::className(), ['id' => 'order_id']);
    }
    
    public function getProduct(){
        return $this->hasOne(\common\models\Product::className(), ['id' => 'product_id']);
    }
    
    public static function getRequestOrder($items=[]){
        $model = new OrderProduct();
        $model->order_id = $items['order_id'];
        $model->product_id = $items['product_id'];
        $model->product_price = $items['product_price'];
        $model->product_weight = $items['product_weight'];
        $model->qty = $items['qty'];
        $model->subtotal = $items['subtotal'];
        $model->insert();
        return true;
    }
    
    public function getMyOrderProductTransaction($id,$params){
        $query = static::find()
        ->select(['product.sku','product.name as product_name','order_product.product_price','order_product.qty','product.slug as product_slug',
                  'subtotal','order_product.product_id'])
        ->joinWith('order')
        ->joinWith('product')
        ->andWhere(['order.user_id' => Yii::$app->user->getId()])
        ->andWhere(['order.id' => $id]);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'product.sku'=>[
                    'asc' => ['product.sku' => SORT_ASC],
                    'desc' =>['product.sku' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        
        $query->andFilterWhere(['like', 'product.sku',  $this->sku]);
        
        return $dataProvider;
    }
    
    public static function AllOrderProduct($id){
        return static::find()
        ->select(['product.sku','product.name as product_name','order_product.product_price','order_product.qty',
                  'subtotal','order_product.product_id'])
        ->joinWith('order')
        ->joinWith('product')
        ->andWhere(['order.id' => $id])
        ->all();
    }
    
}
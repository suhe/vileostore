<?php
namespace common\models;
use Yii;
use vileosoft\shoppingcart\Cart;

class Order extends \yii\db\ActiveRecord {
    
    public $label_courier_id=1;
    public $label_bank_id=1;
    
    public static function tableName(){
        return 'order';
    }
    
    public function rules(){
        return[
            [['id','confirm'],'safe','on'=>['payment']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'label_courier_id' => '',
            'label_bank_id' => ''
        ];
    }
    
    public function getOrderProduct(){
        return $this->hasMany(\common\models\OrderProduct::className(), ['id' => 'order_id']);
    }
    
    public function getId(){
        $count = static::find()
        ->where(['MONTH(created_date)' => date('m'),'YEAR(created_date)' => date('Y')])
        ->count();
        return Yii::$app->params['invoice_prefix'].Yii::$app->params['invoice_separator'].date('Y').Yii::$app->params['invoice_separator'].date('m').Yii::$app->params['invoice_separator'].$count;
    }
    
    public static function getShippingTotal($town_id){
        return static::find()
        ->where(['town_id' => $town_id])
        ->all();
    }
    
    public function getRequestOrder($user_id){
        $post = Yii::$app->request->post();
        $cart = new Cart();
        $model = new Order();
        $model->invoice_no = $this->getId();
        $model->user_id  = $user_id;
        $model->courier_id  = $post['courier'];
        $model->bank_id  = $post['bank'];
        $model->sub_total = $cart->total();
        
        //get cost
        $address = \common\models\UserAddress::getLatestAddress(Yii::$app->user->getId()); 
        $query = \common\models\Shipping::findOne(['courier_id' => $this->label_courier_id,'town_id' => $address?$address->town_id:0]);
            
        $model->shipping_cost = ($query->cost * $cart->total_weight_kg());
        $model->grand_total = ($query->cost * $cart->total_weight_kg()) + $cart->total();
        $model->confirm = 0;
        $model->created_by = $user_id;
        $model->created_date = date('Y-m-d H:i:s');
        $insert_master = $model->insert();
        
        //set id to session 
        Yii::$app->session->set('payment_id',$model->id);
        
        if($insert_master){
            foreach($cart->contents() as $v){
                $items = [
                    'order_id'  =>  $model->id,
                    'product_id' => $v['id'],
                    'product_price' => $v['price'],
                    'product_weight' => $v['weight'],
                    'qty' => $v['qty'],
                    'subtotal' => $v['price'] * $v['qty']
                ];
                $insert_details =  \common\models\OrderProduct::getRequestOrder($items);
            }
            
        }
    }
    
}
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
            [['invoice_no','created_date','status'],'safe','on'=>['search']],
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
    
    public static function stringStatus($status){
        switch($status){
            case 1 : $str = Yii::t('app','completed');break;
            case 2 : $str = Yii::t('app','shipping');break;
            case 3 : $str = Yii::t('app','paid');break;
            case 4 : $str = Yii::t('app','verify payment');break;
            default : $str = Yii::t('app','waiting payment');break;
        }
        return $str;
    }
    
    public static function dropdownStatus($all=true){
        $data = [];
        if($all=true)
            $data[0] = Yii::t('app','all');
        $data[1] = Yii::t('app','completed');
        $data[2] = Yii::t('app','shipping');
        $data[3] = Yii::t('app','paid');
        $data[4] = Yii::t('app','verify payment');
        $data[5] = Yii::t('app','confirm payment');
        return $data;
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
    
    public function getMyOrderTransaction($params){
        $query = static::find()
        ->select(['id','invoice_no','DATE_FORMAT(created_date,\'%d/%m/%Y\') created_date','status'])
        ->andWhere(['user_id' => Yii::$app->user->getId()]);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'invoice_no'=>[
                    'asc' => ['invoice_no' => SORT_ASC],
                    'desc' =>['invoice_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'created_date'=>[
                    'asc' => ['created_date' => SORT_ASC],
                    'desc' =>['created_date' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'status'=>[
                    'asc' => ['status' => SORT_ASC],
                    'desc' =>['status' => SORT_DESC],
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
        
        $query->andFilterWhere(['like', 'invoice_no',  $this->invoice_no]);
        if($this->status)
            $query->andFilterWhere(['like', 'status',  $this->status]);
        return $dataProvider;
    }
    
}
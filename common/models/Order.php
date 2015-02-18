<?php
namespace common\models;
use Yii;
use vileosoft\shoppingcart\Cart;

class Order extends \yii\db\ActiveRecord {
    
    public $label_courier_id=1;
    public $label_bank_id=1;
    public $courier_name;
    public $bank_name;
    public $customer_name;
    
    public static function tableName(){
        return 'order';
    }
    
    public function rules(){
        return[
            [['id','confirm'],'safe','on'=>['payment']],
            [['invoice_no','customer_name','created_date','status'],'safe','on'=>['search']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'label_courier_id' => '',
            'label_bank_id' => '',
            'created_date' => Yii::t('app','date'),
        ];
    }
    
    public function getOrderProduct(){
        return $this->hasMany(\common\models\OrderProduct::className(), ['id' => 'order_id']);
    }
    
    public function getCourier(){
        return $this->hasOne(\common\models\Courier::className(), ['id' => 'courier_id']);
    }
    
    public function getBank(){
        return $this->hasOne(\common\models\Bank::className(), ['id' => 'bank_id']);
    }
    
    public function getUser(){
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
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
            case 5 : $str = Yii::t('app','waiting payment');break;    
            default : $str = Yii::t('app','waiting payment');break;
        }
        return $str;
    }
    
    public static function stringType($type){
        switch($type){
            case 1 : $str = Yii::t('app','shipping');break;
            case 2 : $str = Yii::t('app','dropshier');break;
            case 3 : $str = Yii::t('app','cash on delivery');break;
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
        $data[5] = Yii::t('app','waiting payment');
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
        $model->status  = 5;
        $model->courier_id  = isset($post['courier'])?$post['courier']:0;
        $model->bank_id  = $post['bank'];
        $model->sub_total = $cart->total();
        $model->type = Yii::$app->session->get('cart_address_type');
        
        //get cost
        if(Yii::$app->session->get('cart_address_type') == 1)
            $address = \common\models\UserAddress::getLatestAddress(Yii::$app->user->getId());
        else if(Yii::$app->session->get('cart_address_type') == 2)
            $address = \common\models\UserDropship::getLatestAddress(Yii::$app->user->getId());
        else if(Yii::$app->session->get('cart_address_type') == 3)
            $address = '';
        
        $query = \common\models\Shipping::findOne(['courier_id' => $this->label_courier_id,'town_id' => $address?$address->town_id:0]);
    
        $model->shipping_cost = $query?($query->cost * $cart->total_weight_kg()):0;
        $model->grand_total =  ($query?($query->cost * $cart->total_weight_kg()):0) + $cart->total();
        $model->confirm = 0;
        $model->address = $address?$address->address:Yii::t('app','cash on delivery');
        $model->town = $address?\common\models\Town::findOne($address->town_id)->name:Yii::t('app','cash on delivery');
        $model->city = $address?\common\models\City::findOne($address->city_id)->name:Yii::t('app','cash on delivery');
        $model->province = $address?\common\models\Province::findOne($address->province_id)->name:Yii::t('app','cash on delivery');
        $model->sender = $address?$address->sender:Yii::t('app','cash on delivery');;
        $model->sender_contact = $address?$address->sender_contact:Yii::t('app','cash on delivery');
        $model->receiver = $address?$address->receiver:Yii::t('app','cash on delivery');
        $model->receiver_contact = $address?$address->receiver_contact:Yii::t('app','cash on delivery');
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
        //send email
        Yii::$app->mail->invoice($model->id);
    }
    
    public function getMyOrderTransaction($params){
        $query = static::find()
        ->select(['id','invoice_no','DATE_FORMAT(created_date,\'%d/%m/%Y\') created_date','status'])
        ->andWhere(['user_id' => Yii::$app->user->getId()]);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['ABS(id)'=> SORT_DESC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'invoice_no'=>[
                    'asc' => ['invoice_no' => SORT_ASC],
                    'desc' =>['invoice_no' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'created_date'=>[
                    'asc' => ['created_date' => SORT_ASC],
                    'desc' =>['created_date' => SORT_DESC],
                    'default' => SORT_DESC
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
    
    public function getActiveDataProviderOrder($params){
        $query = static::find()
        ->joinWith('user')
        ->select(['order.id id','order.invoice_no','user.first_name as customer_name','order.created_date','order.grand_total',
                  'order.sub_total','order.shipping_cost','order.status']);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->invoice_no?$query->andFilterWhere(['like','invoice_no',$this->invoice_no]):'';
        $this->created_date?$query->andFilterWhere(['<=','order.created_date', Yii::$app->store->MySQLDate($this->created_date)]):'';
        $this->status?$query->andFilterWhere(['order.status'=>$this->status]):'';
        $this->customer_name?$query->andFilterWhere(['like','user.first_name',$this->customer_name]):'';
        return $dataProvider;
    }
    
    public function getSingleOrder($id){
        return static::find()
        ->from('order')
        ->joinWith('user')
        ->joinWith('courier')
        ->joinWith('bank')
        ->select(['order.id','order.invoice_no','order.created_date','order.status','order.type','courier.name as courier_name',
                  'CONCAT(user.first_name,\' \',user.middle_name,\' \',user.last_name) as customer_name','bank.name as bank_name',
                  'order.shipping_cost','order.grand_total','order.sub_total'])
        ->andWhere(['order.id'=>$id])
        ->one();
    }
    
}
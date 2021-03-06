<?php
namespace frontend\controllers;

use Yii;
use vileosoft\shoppingcart\Cart;

/**
 * Cart controller
 */
class CartController extends \yii\web\Controller {
    
    public $qty = 1;
    
    public function actionBasket($id){
        $product = \common\models\Product::findOne($id);
        
        if((!$product) || ($product->stock<1))
            return $this->redirect(['site/index'],302);
        
        $cart = new Cart();
        $data = [
            'id'      => $product->id,
            'qty'     => $this->qty,
            'price'   => $product->price,
            'name'    => $product->name,
            'weight'  => $product->weight,
            'options' => [
                'image' =>  $product->image,
                'sku'   =>  $product->sku,
                'slug'  =>  $product->slug,
            ]
        ];
        
        $cart->insert($data);
        return $this->redirect(['cart/shopping'],301);
    }
    
    public function actionRemove($id){
        $cart = new Cart();
        $cart->remove($id);
        return $this->redirect(['cart/shopping'],301);
    }
    
    public function actionShopping(){
        if(Yii::$app->session->get('payment_id')) {
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must have confirmation payment before continue'));
            return $this->redirect(['cart/confirmation']);
        }
        
        $formModel = new \frontend\models\CartForm();
        $cart = new Cart();
        if($formModel->load(Yii::$app->request->post()) && $formModel->validate()){
            //$rowid  = $formModel->rowid;
            $qty = $formModel->qty;
            //$weight = $formModel->weight;
            $cart = new Cart();
            foreach($cart->contents() as $items){
                $data = [
                    'rowid'   => $items['rowid'],
                    'qty'     => $qty[$items['rowid']],
                    'weight'  => $items['weight'],
                ];
                $cart->update($data);
            }
        }
        $this->layout = 'shopping-cart';
       
        return $this->render('shopping', [
            'cart'  => $cart,
            'formModel' => $formModel,
        ]);
    }
    
    public function switchAddress(){
        if(Yii::$app->session->get('payment_id')) {
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must have confirmation payment before continue'));
            return $this->redirect(['cart/confirmation']);
        }
        
        $type = Yii::$app->session->get('cart_address_type');
        switch($type){
            case 1 : $route = 'cart/address';break;
            case 2 : $route = 'cart/dropship';break;
            case 3 : $route = 'cart/cod';break;
            default: $route = 'cart/address';break;
        }
        return $route;
    }
    
    public function actionAddress(){    
        //cek auth
        $user_id = Yii::$app->user->getId();
         
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must have login to continue'));
            Yii::$app->getUser()->setReturnUrl([Yii::$app->controller->getRoute()]);
            return $this->redirect(['site/login'],301);
        }
        
        //cek cart
        $cart = new Cart();
        if(!$cart->contents()){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must buy minimal one product'));
            return $this->redirect(['site/login'],301);
        }
        
        $formModel = new \common\models\UserAddress(['scenario' => 'register']);
        
        if(Yii::$app->session->get('cart_payment')){
            $address = \common\models\UserAddress::getLatestAddress($user_id);
            $formModel->latest_address = $address->id;
            $formModel->address = $address->address;
            $formModel->province_id = $address->province_id;
            $formModel->city_id = $address->city_id;
            $formModel->town_id = $address->town_id;
            $formModel->receiver = $address->receiver;
            $formModel->receiver_contact = $address->receiver_contact;
        }
        
        if($formModel->load(Yii::$app->request->post()) && $id = $formModel->getSaveUserAddress($user_id)){
            Yii::$app->session->set('cart_payment',TRUE); // set to set payment
            Yii::$app->session->set('cart_address_id',$id); // set to set town id
            Yii::$app->session->set('cart_address_type',1); // set to address type 1= address 
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg config address finish'));
            return $this->redirect(['cart/payment'],301);
        }
        $this->layout = 'shopping-address';
        return $this->render('address', [
            'formModel' => $formModel,
        ]);
    }
    
    public function actionDropship(){
        //cek auth
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must have login to continue'));
            Yii::$app->getUser()->setReturnUrl([Yii::$app->controller->getRoute()]);
            return $this->redirect(['site/login'],301);
        }
        
        //cek cart
        $cart = new Cart();
        if(!$cart->contents()){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must buy minimal one product'));
            return $this->redirect(['site/login'],301);
        }
        
        $formModel = new \common\models\UserDropship(['scenario' => 'register']);
        $user_id = Yii::$app->user->getId();
        if($formModel->load(Yii::$app->request->post()) && $formModel->getSaveUserDropship($user_id)){
            Yii::$app->session->set('cart_payment',TRUE); // set to set payment
            Yii::$app->session->set('cart_address_id',$formModel->id); // set to set town id
            Yii::$app->session->set('cart_address_type',2); // set to set town id 
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg config dropship finish'));
            return $this->redirect(['cart/payment'],301);
        }
        $this->layout = 'shopping-address';
        return $this->render('dropship', [
            'formModel' => $formModel,
        ]);
    }
    
    
    public function actionCod(){    
        //cek auth
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must have login to continue'));
            Yii::$app->getUser()->setReturnUrl([Yii::$app->controller->getRoute()]);
            return $this->redirect(['site/login'],301);
        }
        
        //cek cart
        $cart = new Cart();
        if(!$cart->contents()){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must buy minimal one product'));
            return $this->redirect(['site/login'],301);
        }
        
        $this->layout = 'shopping-address';
        return $this->render('cod', [
            'formModel' => $formModel,
        ]);
    }

    public function actionPayment($id=0){
        if(Yii::$app->user->isGuest) return $this->redirect(['cart/address'],301);
        $Cart = new Cart();
        
        //set if take
        if($id==3){
            Yii::$app->session->set('cart_payment',TRUE); // set to set payment
            Yii::$app->session->set('cart_address_id',0); // set to set town id
            Yii::$app->session->set('cart_address_type',3); // set to set town id 
        }
        
        $user_id = Yii::$app->user->getId();
        $formModel = new \common\models\Order(['scenario' => 'payment']);
        
        if(Yii::$app->session->get('payment_id')) {
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg you must have confirmation payment before continue'));
            return $this->redirect(['cart/confirmation']);
        }
        
        if(!Yii::$app->session->get('cart_payment')){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg your address / cart empty'));
            return $this->redirect(['cart/address'],301);
        }
        //get Address
        if(Yii::$app->session->get('cart_address_type') == 1)
            $address = \common\models\UserAddress::getLatestAddress($user_id);
        else if(Yii::$app->session->get('cart_address_type') == 2)
            $address = \common\models\UserDropship::getLatestAddress($user_id);
        else if(Yii::$app->session->get('cart_address_type') == 3)
            $address = 0;
        
        //action here
        if($formModel->load(Yii::$app->request->post()) && $formModel->validate()){
            Yii::$app->session->set('after_payment',TRUE);
            $formModel->getRequestOrder(Yii::$app->user->getId());
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg thanks for purchase we wait confirm'));
            /**
            * Unset Session
            * unset all session for cart
            * */
            $Cart->destroy(); //destroy cart
            Yii::$app->session->remove('cart_payment');
            Yii::$app->session->remove('cart_address_id');
            
            return $this->redirect(['cart/confirmation'],301);
        }
        
        $this->layout = 'shopping-payment';
        return $this->render('payment', [
            'formModel' => $formModel,
            'cart'  => new Cart(),
            'courier' => \common\models\Shipping::getShippingTotal($address?$address->town_id:0),
            'shipping' => \common\models\Shipping::findOne(['town_id' => $address?$address->town_id:0,'courier_id' => Yii::$app->params['default_courier']])
        ]);
    }
    
    public function actionConfirmation(){
        //check payment
        if(!Yii::$app->session->get('after_payment'))  return $this->redirect(['cart/payment'],301);
        $this->layout = 'single';
        $formModel = new \common\models\ConfirmationForm(['scenario' => 'confirm_user']);
        $cart =  \common\models\Order::findOne(Yii::$app->session->get('payment_id'));
        $formModel->bank_name = Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->middle_name.' '.Yii::$app->user->identity->last_name;
        $formModel->total_transfer = Yii::$app->Formatter->asDecimal($cart->grand_total,0);
        
        if($formModel->load(Yii::$app->request->post()) && $formModel->getConfirmPayment(Yii::$app->session->get('payment_id'))){
             //put history transaction
            \common\models\OrderHistory::InsertHistory(Yii::$app->session->get('payment_id'),'Payment Confirmation',Yii::t('app','invoice no').' : '.$cart->invoice_no);
            
            Yii::$app->mail->verification(Yii::$app->session->get('payment_id'),Yii::t('app','confirm payment invoice'));
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg thanks for confirmation wait for verification'));
            //delete session payment id and adddress type
            Yii::$app->session->remove('payment_id');
            Yii::$app->session->remove('cart_address_type');
            return $this->redirect(['user/history_details','id' => $cart->id],301);
        }
        
        return $this->render('confirmation', [
            'formModel' => $formModel,
            'cart' => $cart,
        ]);
    }
    
    public function actionCompile(){
        $id = isset($_POST['id'])?$_POST['id']:0;
        $query = \common\models\UserAddress::findOne($id);
        Yii::$app->response->format = 'json';
        if($query){
            return [
                'success' => true,
                'address' => $query->address,
                'city'    => $query->city_id,
                'province' => $query->province_id,
                'town' => $query->town_id,
                'receiver' => $query->receiver,
                'receiver_contact' => $query->receiver_contact,
            ];
        } else {
            return [
                'success' => false
            ];
        }
    }
    
    public function actionCompile_dropship(){
        $id = isset($_POST['id'])?$_POST['id']:1;
        $query = \common\models\UserDropship::findOne($id);
        Yii::$app->response->format = 'json';
        if($query){
            return [
                'success' => true,
                'address' => $query->address,
                'city'    => $query->city_id,
                'province' => $query->province_id,
                'town' => $query->town_id,
                'receiver' => $query->receiver,
                'receiver_contact' => $query->receiver_contact,
                'sender' => $query->sender,
                'sender_contact' => $query->sender_contact,
            ];
        } else {
            return [
                'success' => false
            ];
        }
    }
    
    public function actionProvince(){
        $id = isset($_POST['id'])?$_POST['id']:5;
        $models = \common\models\City::find()
        ->where(['province_id' => $id])
        ->orderBy(['name' => SORT_ASC])
        ->all();
        
        if($models) {
            $result = '';
            $result.= "<option>".Yii::t('app','select city')."</option>";
            foreach($models as $row){
                $result.= "<option value='".$row->id."'>".$row->name."</option>";
            }
        }
        else {
            $result = "<option>-</option>";
        }
        
        Yii::$app->response->format = 'json';
        if($result){
            return [
                'success' => true,
                'result' => $result,
            ];
        } else {
            return [
                'success' => false
            ];
        }
        
    }
    
    public function actionTown(){
        $id = isset($_POST['id'])?$_POST['id']:379;
        $models = \common\models\Town::find()
        ->where(['city_id' => $id])
        ->orderBy(['name' => SORT_ASC])
        ->all();
        
        if($models) {
            $result = '';
            $result.= "<option>".Yii::t('app','select town')."</option>";
            foreach($models as $row){
                $result.= "<option value='".$row->id."'>".$row->name."</option>";
            }
        }
        else {
            $result = "<option>-</option>";
        }
        
        Yii::$app->response->format = 'json';
        if($result){
            return [
                'success' => true,
                'result' => $result,
            ];
        } else {
            return [
                'success' => false
            ];
        }
        
    }
    
    public function actionCost(){
        $cart = new Cart();
        $id = isset($_POST['id'])?$_POST['id']:1;
        
        if(Yii::$app->session->get('cart_address_type') == 1)
            $address = \common\models\UserAddress::getLatestAddress(Yii::$app->user->getId());
        else if(Yii::$app->session->get('cart_address_type') == 2)
            $address = \common\models\UserDropship::getLatestAddress(Yii::$app->user->getId());
        
        $query = \common\models\Shipping::findOne(['courier_id' => $id,'town_id' => $address?$address->town_id:0]);
        if($query)
            $cost =($query->cost * $cart->total_weight_kg()) + $cart->total();
        else
            $cost = 0;
        Yii::$app->response->format = 'json';
        if($query){
            return [
                'success' => true,
                'cost' => Yii::$app->formatter->asDecimal($cost,2)
            ];
        } else {
            return [
                'success' => false
            ];
        }
    }
    
}

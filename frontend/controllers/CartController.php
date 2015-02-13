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
        $cart = new Cart();
        $data = [
            'id'      => $product->id,
            'qty'     => $this->qty,
            'price'   => $product->price,
            'name'    => $product->name,
            'options' => [
                'image' =>  $product->image,
                'sku'   =>  $product->sku,
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
        $formModel = new \frontend\models\CartForm();
        $cart = new Cart();
        if($formModel->load(Yii::$app->request->post()) && $formModel->validate()){
            $rowid  = $formModel->rowid;
            $qty = $formModel->qty;
            $cart = new Cart();
            foreach($cart->contents() as $items){
                $data = [
                    'rowid'   => $rowid[$items['rowid']],
                    'qty'     => $qty[$items['rowid']],
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
    
    public function actionAddress(){
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
        
        $formModel = new \common\models\UserAddress(['scenario' => 'register']);
        $user_id = Yii::$app->user->getId();
        if($formModel->load(Yii::$app->request->post()) && $formModel->getSaveUserAddress($user_id)){
            Yii::$app->session->set('cart_payment',TRUE); // set to set payment
            Yii::$app->session->set('cart_address_id',$formModel->id); // set to set town id 
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg config address finish'));
            return $this->redirect(['cart/payment'],301);
        }
        $this->layout = 'shopping-address';
        return $this->render('address', [
            'formModel' => $formModel,
        ]);
    }
    
    public function actionPayment(){
        if(Yii::$app->user->isGuest) return $this->redirect(['cart/address'],301);
            
        $user_id = Yii::$app->user->getId();
        $formModel = new \common\models\Order(['scenario' => 'payment']);
        
        if(!Yii::$app->session->get('cart_payment')){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg your address / cart empty'));
            return $this->redirect(['cart/address'],301);
        }
        //get Address
        $address = \common\models\UserAddress::getLatestAddress($user_id);
        
        //action here
        if($formModel->load(Yii::$app->request->post()) && $formModel->validate()){
            return $this->redirect(['cart/address'],301);
        }
        
        $this->layout = 'shopping-payment';
        return $this->render('payment', [
            'formModel' => $formModel,
            'cart'  => new Cart(),
            'courier' => \common\models\Shipping::getShippingTotal($address?$address->town_id:0),
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
    
    public function actionProvince($id){
        $models = \common\models\City::find()
        ->where(['province_id' => $id])
        ->orderBy(['name' => SORT_ASC])
        ->all();
        
        if($models) {
            echo "<option>".Yii::t('app','select city')."</option>";
            foreach($models as $row){
                echo "<option value='".$row->id."'>".$row->name."</option>";
            }
        }
        else {
            echo "<option>-</option>";
        }
        
    }
    
    public function actionTown($id){
        $models = \common\models\Town::find()
        ->where(['city_id' => $id])
        ->orderBy(['name' => SORT_ASC])
        ->all();
        
        if($models) {
            echo "<option>".Yii::t('app','select town')."</option>";
            foreach($models as $row){
                echo "<option value='".$row->id."'>".$row->name."</option>";
            }
        }
        else {
            echo "<option>-</option>";
        }
        
    }
    
}

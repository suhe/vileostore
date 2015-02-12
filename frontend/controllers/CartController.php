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
        $this->layout = 'single';
       
        return $this->render('shopping', [
            'cart'  => $cart,
            'formModel' => $formModel,
        ]);
    }
}

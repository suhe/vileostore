<?php
namespace common\models;
use Yii;

class Mail extends \yii\base\Model {    
    public function send($user=[],$subject,$mail_theme,$options=[]){
        $users = $user;
        $mail = [];
        foreach ($users as $user) {
            $mail[] = Yii::$app->mailer->compose($mail_theme,$options) 
            ->setFrom(Yii::$app->params['mail_user'])
            ->setTo($user)
            ->setBcc(Yii::$app->params['mail_admin'])
            ->setSubject($subject);
        }
        Yii::$app->mailer->sendMultiple($mail);
    }
    
    public function invoice($id,$subject='Invoice'){
        $data = \common\models\Order::find()
        ->select(['order.invoice_no','courier.name as courier_name','order.grand_total','order.status','order.confirm',
                    'order.receiver','order.receiver_contact','order.address','order.town',
                    'order.city','order.town','order.shipping_cost','bank.name as bank_name'])     
        ->joinWith('courier')
        ->joinWith('bank')
        ->where(['order.id'=>$id])
        ->one();
        
        $products =  \common\models\OrderProduct::find()
        ->select(['product_id','product.sku','product.image as product_image','product.name as product_name','qty','product_price',
                    'subtotal','product_weight'])
        ->joinWith('product')
        ->where(['order_id' => $id])
        ->all();
                        
        return Yii::$app->mail->send([Yii::$app->user->identity->email],
            $subject.' '.$data->invoice_no.' Vileo.co.id','invoice',[
                'data' => $data,
                'product' => $products,
             ]);
    }
    
    public function verification($id,$subject='verifiy'){
        $data = \common\models\Order::find()
        ->select(['order.invoice_no','courier.name as courier_name','order.grand_total','order.status','order.confirm',
                    'order.receiver','order.receiver_contact','order.address','order.town','order.confirm_total',
                    'order.confirm_account','order.confirm_owner','order.city','order.town','order.shipping_cost','bank.name as bank_name'])     
        ->joinWith('courier')
        ->joinWith('bank')
        ->where(['order.id'=>$id])
        ->one();
        
        $products =  \common\models\OrderProduct::find()
        ->select(['product_id','product.sku','product.image as product_image','product.name as product_name','qty','product_price',
                    'subtotal','product_weight'])
        ->joinWith('product')
        ->where(['order_id' => $id])
        ->all();
                        
        return Yii::$app->mail->send([Yii::$app->user->identity->email],
            $subject.' '.$data->invoice_no.' Vileo.co.id','verification',[
                'data' => $data,
                'product' => $products,
             ]);
    }
}
            
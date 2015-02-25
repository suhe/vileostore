<?php
namespace common\models;
use Yii;

class OrderHistory extends \yii\db\ActiveRecord {
    public $user_name;
   
    
    public static function tableName(){
        return 'order_history';
    }
    
    public function rules(){
        return [
            [['type','description'],'required','on'=>['update']],    
        ];
    }
    
    public function attributeLabels(){
        return [
            'created_date' => Yii::t('app','date'),
            'type' => Yii::t('app','type'),
            'description' => Yii::t('app','description'),
            'user_name' => Yii::t('app','by'),
        ];
    }
    
    public function getUser(){
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }
    
    public static function dropDownList(){
        return [
            'Buy' => 'Buy',
            'Payment Confirmation' => 'Payment Confirmation',
            'Payment Accepted' => 'Payment Accepted',
            'Payment Rejected' => 'Payment Rejected',
            'Shipping' => 'Shipping',
            'Completed' => 'Completed'
        ];
    }

    public function getActiveDataProviderOrderHistory($id){
        $query = static::find()
        ->select(['order_history.created_date','order_history.type','order_history.description','CONCAT(user.first_name,\' \',user.middle_name,\' \',user.last_name) as user_name'])
        ->joinWith('user')
        ->andWhere(['order_history.order_id' => $id]);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);    
        return $dataProvider;
    }
    
    public function getUpdateHistory($id){
        if($this->validate()){
            switch($this->type){
                case 'Payment Accepted' :
                    \common\models\Order::UpdateAll(['status'=>3],['id'=>$id]);
                    Yii::$app->mail->payment($id,TRUE);
                    break;
                case 'Payment Rejected' :
                    \common\models\Order::UpdateAll(['status'=>5],['id'=>$id]);
                    Yii::$app->mail->payment($id,FALSE);
                    break;
                case 'Shipping' :
                    \common\models\Order::UpdateAll(['status'=>2,'awb' =>$this->description,'updated_date' => date('Y-m-d H:i:s')],['id'=>$id]);
                    Yii::$app->mail->shipping($id);
                    break;    
            }
            
            $model = new OrderHistory();
            $model->created_date = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->getId();
            $model->type = $this->type;
            $model->order_id = $id;
            $model->description = $this->description;
            $model->insert();
            return true;
        }
        return false;
    }
    
    public static function Insert($order_id,$type,$description){
        $history = new \common\models\OrderHistory();
        $history->order_id = $order_id;
        $history->type = $type;
        $history->description = $description;
        $history->created_by = Yii::$app->user->getId();
        $history->created_date = date('Y-m-d H:i:s');
        $history->insert();
        return true;
    }
    
}
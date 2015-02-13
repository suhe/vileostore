<?php
namespace common\models;
use Yii;

class Order extends \yii\db\ActiveRecord {
    
    public $label_courier_id;
    public $label_bank_id;
    
    public static function tableName(){
        return 'order';
    }
    
    public function rules(){
        return[
            [['label_courier_id'],'required','on'=>['payment']],
            [['label_courier_id'],'integer','tooSmall'=>Yii::t('app/message','msg fill one'),'min'=>1,'on'=>['payment']],
            
            [['label_bank_id'],'required','on'=>['payment']],
            [['label_bank_id'],'integer','tooSmall'=>Yii::t('app/message','msg fill one'),'min'=>1,'on'=>['payment']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'label_courier_id' => '',
            'label_bank_id' => '',
            'name' => Yii::t('app','name'),
            'price_down' => Yii::t('app','price down'),
            'price_high' => Yii::t('app','price high'),
            'category_id' => Yii::t('app','category'),
            'brand_id' => Yii::t('app','brand'),
        ];
    }
    
    public static function getShippingTotal($town_id){
        return static::find()
        ->where(['town_id' => $town_id])
        ->all();
    }
    
}
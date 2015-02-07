<?php
namespace common\models;
use Yii;
use yii\helpers\Html;

class Product extends \yii\db\ActiveRecord {
    
    public $category_name = 'Perdana & Voucher Three';
    
    public static $image_path = 'assets/images/products/';
    
    public static function tableName(){
        return 'product';
    }
    
    public function getProductCategory(){
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_id']);
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'name' => Yii::t('app','name'),
        ];
    }
    
    public function rules(){
        return[
            [['id','name'], 'required'],
            [['id'],'integer'],
            [['name'], 'string', 'max' => 255]
            
        ];
    }
       
    public static function  getImage($product_id,$filename,$options=[]) {
        $options['src'] = Yii::$app->params['baseUrl'] . 'assets/images/products/'.$product_id .'/'. $filename;
        return Html::tag('img', '', $options);
    }
    
}
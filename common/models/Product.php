<?php
namespace common\models;
use Yii;
use yii\helpers\Html;

class Product extends \yii\db\ActiveRecord {
    
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
    
}
<?php
namespace common\models;
use Yii;
use yii\helpers\Html;

class ProductImage extends \yii\db\ActiveRecord  {
    public static function tableName(){
        return 'product_image';
    }
    
    public function rules(){
        return[
            [['name'],'safe','on'=>['upload']],
            [['name'],'file','on'=>['upload']],
        ];
    }
    
    public function getImageByProduct($product_id){
        return static::find()
        ->where(['product_id'=>$product_id])
        ->all();
    }
    
    public static function DropdownList(){
        $result = [];
        $query = static::find()
        ->where(['product_id' => Yii::$app->request->QueryParams['id']])
        ->all();
        
        if($query){
            foreach($query as $row){
                $result[$row->id] =  $row->name;
            }
        }
        return $result;
    }
}
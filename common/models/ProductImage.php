<?php
namespace common\models;
use Yii;
use yii\helpers\Html;

class ProductImage extends \yii\db\ActiveRecord  {
    public static function tableName(){
        return 'product_image';
    }
    
    public function getImageByProduct($product_id){
        return static::find()
        ->where(['product_id'=>$product_id])
        ->all();
    }
    
    public function getActiveDataProviderImage($id){
        $query = static::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_ASC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        $query->andFilterWhere(['product_id' => $id]);
        return $dataProvider;
    }
}
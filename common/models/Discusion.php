<?php
namespace common\models;
use Yii;

class Discusion extends \yii\db\ActiveRecord {
    
    public $full_name;
    public $product_name;
    public $product_image;
    
    public static function tableName(){
        return 'discusion';
    }
    
    /**
     * Relation
     */
    public function getUser(){
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }
    
    public function getProduct(){
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }
    
    public static function getDiscusionByProduct($id){
        return static::find()
        ->select(['CONCAT(user.first_name,\' \',user.middle_name,\' \',user.last_name ) as full_name','description','discusion.created_date'])
        ->joinWith('user')
        ->where(['discusion.product_id' => $id])
        ->all();
    }
    
    /**
     * @inheritdoc
     */
    public function rules(){
        return[
            [['description'], 'required','on'=>['comment']],
        ];
    }
    
    public function getSave($id){
        if($this->validate()){
            $model = new Discusion();
            $model->user_id = 2;
            $model->product_id = $id;
            $model->created_by = 2;
            $model->description = $this->description;
            $model->insert();
            return true;
        }
        return false;
    }
    
    public function getAllQueryWithPagination($id,$params){
        $query =  static::find()
        ->select(['discusion.product_id','product.name as product_name','product.image as product_image','discusion.description'])
        ->joinWith('product')
        ->where(['user_id' => $id])
        ->orderBy(['ABS(discusion.id)' => SORT_DESC]);
        return $query;
    }
    
}
<?php
namespace common\models;
use Yii;

class Discussion extends \yii\db\ActiveRecord {
    
    public $user_name;
    public $full_name;
    public $product_name;
    public $product_image;
    public $review;
    
    public static function tableName(){
        return 'discussion';
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
        ->select(['CONCAT(user.first_name,\' \',user.middle_name,\' \',user.last_name ) as full_name','description','discussion.created_date'])
        ->joinWith('user')
        ->where(['discussion.product_id' => $id])
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
            $model = new Discussion();
            $model->user_id = Yii::$app->user->getId();
            $model->product_id = $id;
            $model->created_by = Yii::$app->user->getId();
            $model->description = $this->description;
            $model->insert();
            //update product
            \common\models\Product::updateAllCounters(['review' => 1],['id'=>$id]);
            \common\models\Product::updateAll(['latest_discussion' => Yii::$app->user->getId()],['id'=>$id]);
            return true;
        }
        return false;
    }
    
    public function getAllQueryWithPagination($id,$params){
        $query =  static::find()
        ->select(['discussion.product_id','product.name as product_name','product.image as product_image',
                  'discussion.description','product.review','discussion.id','CONCAT(user.first_name,\' \',user.middle_name,\' \',user.last_name) as user_name'])
        ->joinWith('product')
        ->joinWith('user')
        ->where(['user_id' => $id])
        ->orderBy(['ABS(discussion.id)' => SORT_DESC]);
        return $query;
    }
    
}
<?php
namespace common\models;
use Yii;

class Discusion extends \yii\db\ActiveRecord {
    
    public $full_name;
    
    public static function tableName(){
        return 'discusion';
    }
    
    /**
     * Relation
     */
    public function getUser(){
        return $this->hasMany(User::className(), ['id' => 'user_id']);
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
    
}
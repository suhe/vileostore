<?php
namespace common\models;
use Yii;

class Category extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'category';
    }
    
    public function getProductCategory(){
        return $this->hasMany(\common\models\ProductCategory::className(), ['category_id' => 'id']);
    }
    
    public static function getNestedCategory($status,$parent_id){
        return static::find()
        ->where(['status' => $status , 'parent_id' => $parent_id ])
        ->all();    
    }
    
    public static function getHierarchyCategory($parent_id=0){
        return static::find()
        ->where(['parent_id' => $parent_id ])
        ->all();    
    }
    
    public static function ListCategory($option=[],$All=true){
        return static::find()
        ->where(['id' => $option])
        ->all();   
    }
    
    public static function getHierarchyList($All=true) {
        $options = [];
        if($All==true)
            $options[0] = Yii::t('app','all category');
            
        $parents = self::find()
        ->where(['parent_id'=> 0])
        ->all();
        
        foreach($parents as $id => $p) {
            $children = self::find()
            ->where(['parent_id'=> $p->id])
            ->all();
            
            $child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options[$p->name] = $child_options;
        }
        return $options;
    }
}
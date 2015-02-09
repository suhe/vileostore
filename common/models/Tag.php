<?php
namespace common\models;

class Tag extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'tag';
    }

    public static function ListTag(){
        return static::find()
        ->all();    
    }
}
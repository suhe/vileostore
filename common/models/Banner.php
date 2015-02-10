<?php
namespace common\models;

class Banner extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'banner';
    }
    
    public static function HomePageBanner($position='home',$slide='static'){
        return \common\models\Banner::find()
        ->where(['status' => 1,'slide' => $slide])
        ->all();
    }
}
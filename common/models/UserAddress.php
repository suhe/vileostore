<?php
namespace common\models;
use Yii;

class UserAddress extends \yii\db\ActiveRecord  {
    
    public $latest_address;
    public $receiver;
    public $receiver_contact;
    
    public static function tableName(){
        return 'user_address';
    }
    
    public function attributeLabels(){
        return [
            'latest_address' => Yii::t('app','address'),
            'address' => Yii::t('app','address'),
            'province_id' => Yii::t('app','province'),
            'city_id' => Yii::t('app','city'),
            'town_id' => Yii::t('app','district'),
            'receiver' => Yii::t('app','receiver'),
            'receiver_contact' => Yii::t('app','receiver contact'),
        ];
    }
    
    public static function dropdownList($captionTitle='',$condition=[]){
        $options[0] = $captionTitle;
        $query = static::find();
        if($condition)
            $query = $query->andWhere($condition);
        
        $result = $query->all();
        
        foreach($result as $row){
            $options[$row->id] = $row->address;
        }
        
        return $options;
    }
    
}
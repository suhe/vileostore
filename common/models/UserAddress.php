<?php
namespace common\models;
use Yii;

class UserAddress extends \yii\db\ActiveRecord  {
    
    public $latest_address;
    public $province;
    public $city;
    public $town;
    
    public static function tableName(){
        return 'user_address';
    }
    
    public function rules(){
        return[
            [['address','province_id','city_id','town_id','receiver','receiver_contact'],'required','on'=>'register'],
            [['latest_address','id'],'safe','on'=>['register']],
            [['province_id'],'integer','tooSmall'=>Yii::t('app/message','msg fill province'),'min'=>1,'on'=>['register']],
            [['city_id'],'integer','tooSmall'=>Yii::t('app/message','msg fill city'),'min'=>1,'on'=>['register']],
            [['town_id'],'integer','tooSmall'=>Yii::t('app/message','msg fill town'),'min'=>1,'on'=>['register']],
        ];
    }
    
    /**
     * Relation Table
    */
    public function getProvince(){
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }
    
    public function getCity(){
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    
    public function getTown(){
        return $this->hasOne(Town::className(), ['id' => 'town_id']);
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
    
    public function getSaveUserAddress($user_id){
        if($this->validate()){
            if(!$this->latest_address)
                $this->getSave($user_id);
            else
                $this->getUpdate($user_id);
            return true;
        }
        return false;
    }
    
    public function getSave($user_id){
        $model = new UserAddress();
        $model->user_id = $user_id;
        $model->address = $this->address;
        $model->province_id = $this->province_id;
        $model->city_id = $this->city_id;
        $model->town_id = $this->town_id;
        $model->receiver =  $this->receiver;
        $model->receiver_contact =  $this->receiver_contact;
        $model->created_by = Yii::$app->user->getId();
        $model->created_date = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->getId();
        $model->updated_date = date('Y-m-d H:i:s');
        $model->insert();
    }
    
    public function getUpdate($user_id){
        $model = new UserAddress();
        $model = $model->findOne($this->latest_address);
        $model->user_id = $user_id;
        $model->address = $this->address;
        $model->province_id = $this->province_id;
        $model->city_id = $this->city_id;
        $model->town_id = $this->town_id;
        $model->receiver =  $this->receiver;
        $model->receiver_contact =  $this->receiver_contact;
        $model->updated_by = Yii::$app->user->getId();
        $model->updated_date = date('Y-m-d H:i:s');
        $model->update();
    }
    
    public function getUpdateUserAddress($user_id,$id){
        if($this->validate()){
            $this->latest_address =  $id;
            $this->getUpdate($user_id);
            return true;
        }
        return false;
    }
    
    public static function getLatestAddress($user_id){
        return static::find()
        ->where(['user_id' => $user_id])
        ->orderBy(['updated_date' => SORT_DESC])
        ->one();
    }
    
    public function getAllQueryWithPagination($id,$params){
        $query =  static::find()
        ->select(['user_address.id','user_address.created_date','user_address.updated_date','user_address.address',
                  'user_address.receiver','user_address.receiver_contact','province.name as province','city.name as city',
                  'town.name as town'])
        ->joinWith('province')
        ->joinWith('city')
        ->joinWith('town')
        ->where(['user_id' => $id])
        ->orderBy(['ABS(user_address.id)' => SORT_ASC]);
        return $query;
    }
    
}
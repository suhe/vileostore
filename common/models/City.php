<?php
namespace common\models;
use Yii;

class City extends \yii\db\ActiveRecord {
    public $province_name;
    
    public static function tableName(){
        return 'city';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['name','province_id'],'required','on'=>['save','update']]
        ];
    }
    
    public function attributeLabels(){
        return [
            'name' => Yii::t('app','city'),
            'province_id' => Yii::t('app','province'),
        ];
    }
    
    public function getProvince(){
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }
    
    public static function dropdownList($captionTitle='',$condition=[]){
        $options[0] = $captionTitle;
        $query = static::find();
        if($condition)
            $query = $query->andWhere($condition);
        
        $result = $query->all();
        
        foreach($result as $row){
            $options[$row->id] = $row->name;
        }
        
        return $options;
    }
    
    public static function dropdownWithProvinceList($captionTitle='',$condition=[]){
        $options[0] = $captionTitle;
        $query = static::find()
        ->joinWith('province')
        ->select(['city.name','city.id','province.name AS province_name'])
        ->orderBy(['province_name'=>SORT_ASC,'city.name'=>SORT_ASC]);
        
        if($condition)
            $query = $query->andWhere($condition);
        
        $result = $query->all();
        
        foreach($result as $row){
            $options[$row->id] = $row->province_name.' > '.$row->name;
        }

        return $options;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new City();
            $model->name = $this->name;
            $model->province_id = $this->province_id;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            return true;
        }
        return false;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new City();
            $model = $model->findOne($id);
            $model->name = $this->name;
            $model->province_id = $this->province_id;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
}
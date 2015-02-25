<?php
namespace common\models;
use Yii;

class Province extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'province';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['name'],'required','on'=>['save','update']]
        ];
    }
    
    public function attributeLabels(){
        return [
            'name' => Yii::t('app','province'),
        ];
    }
    
    
    public static function dropdownList($captionTitle='',$condition=[]){
        $options[0] = $captionTitle;
        $query = static::find()
        ->orderBy(['name' => SORT_ASC]);
        if($condition)
            $query = $query->andWhere($condition);
        
        $result = $query->all();
        
        foreach($result as $row){
            $options[$row->id] = $row->name;
        }
        
        return $options;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Province();
            $model->name = $this->name;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            return true;
        }
        return false;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new Province();
            $model = $model->findOne($id);
            $model->name = $this->name;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
}
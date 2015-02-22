<?php
namespace common\models;
use Yii;

class Brand extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'brand';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['name','status','slug','created_date'],'safe','on'=>['search']],
            [['id','logo'],'safe','on'=>['save','update']],
            [['logo'],'file','extensions'=>'jpg, gif, png','on'=>['save','update']],
            [['name','status'],'required','on'=>['save','update']]
        ];
    }
    
    public static function ActiveBrand(){
        return static::find()
        ->where(['status' => 1])
        ->all();    
    }
    
    public static function dropdownStatus($All=true){
       if($All) $data[0] = Yii::t('app','all');
       $data[1] = Yii::t('app','active');
       $data[2] = Yii::t('app','non active');
       return $data;
    }
    
    public static function stringStatus($status){
        switch($status){
            case 1 : $str = Yii::t('app','active');break;
            default: $str = Yii::t('app','non active');break;   
        }
        return $str;
    }
    
    public static function getDropDownList($All=true){
        $data = [];
        if($All) $data[0] = Yii::t('app','all brand');
        $query = static::find()
        ->orderBy(['name' => SORT_ASC])
        ->all();
        
        foreach($query as $row){
            $data[$row->id] = $row->name;
        }
        return $data;
    }
    
    public function getActiveDataProviderBrand($params){
        $query = static::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['name'=> SORT_ASC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->name?$query->andFilterWhere(['like','name',$this->name]):'';
        $this->slug?$query->andFilterWhere(['slug'=>$this->slug]):'';
        $this->status?$query->andFilterWhere(['status'=>$this->status]):'';
        return $dataProvider;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new Brand();
            $model = $model->findOne($id);
            $model->name = $this->name;
            $model->slug = Yii::$app->store->slug($this->name);
            $model->status = $this->status;
            $model->update();
            return true;
        }
        return false;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Brand();
            $model->name = $this->name;
            $model->slug = Yii::$app->store->slug($this->name);
            $model->status = $this->status;
            $model->insert();
            return $model->id;
        }
        return false;
    }
}
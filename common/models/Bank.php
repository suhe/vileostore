<?php
namespace common\models;
use Yii;

class Bank extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'bank';
    }
    
    public function rules(){
        return[
            [['id','order'],'integer'],
            [['account','owner','name','branch','status','order'],'safe','on'=>['search']],
            [['id','icon'],'safe','on'=>['save','update']],
            [['icon'],'file','extensions'=>'jpg, gif, png','on'=>['save','update']],
            [['account','owner','name','branch','order','status'],'required','on'=>['save','update']]
        ];
    }
    
    public static function getAccount(){
        return static::find()->all();
    }
    
    public function getActiveDataProviderCategory($params){
        $query = static::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['order'=>SORT_ASC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->account?$query->andFilterWhere(['like','account',$this->account]):'';
        $this->owner?$query->andFilterWhere(['like','owner',$this->owner]):'';
        $this->name?$query->andFilterWhere(['like','name',$this->name]):'';
        $this->branch?$query->andFilterWhere(['like','branch',$this->branch]):'';
        $this->status?$query->andFilterWhere(['status'=>$this->status]):'';
        return $dataProvider;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Bank();
            $model->account = $this->account;
            $model->owner = $this->owner;
            $model->name = $this->name;
            $model->branch = $this->branch;
            $model->icon = $this->icon;
            $model->order = $this->order;
            $model->status = $this->status;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date  = date('Y-m-d H:i:s');
            $model->insert();
            return $model->id;
        }
        return false;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new Bank();
            $model = $model->findOne($id);
            $model->account = $this->account;
            $model->owner = $this->owner;
            $model->name = $this->name;
            $model->branch = $this->branch;
            $model->icon = $this->icon;
            $model->order = $this->order;
            $model->status = $this->status;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date  = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
}
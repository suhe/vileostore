<?php
namespace common\models;
use Yii;

class Courier extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'courier';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['name','status'],'safe','on'=>['search']],
            [['id','icon'],'safe','on'=>['save','update']],
            [['icon'],'file','extensions'=>'jpg, gif, png','on'=>['save','update']],
            [['name','status'],'required','on'=>['save','update']]
        ];
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'name' => Yii::t('app','name'),
            'icon' => Yii::t('app','icon'),
            'status' => Yii::t('app','status'),
        ];
    }
    
    public function getShipping(){
        return $this->hasOne(Shipping::className(), ['id' => 'courier_id']);
    }
    
    public function getActiveDataProviderCourier($params){
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
        $this->status?$query->andFilterWhere(['status'=>$this->status]):'';
        return $dataProvider;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Courier();
            $model->name = $this->name;
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
            $model = new Courier();
            $model = $model->findOne($id);
            $model->name = $this->name;
            $model->status = $this->status;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date  = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
    
}
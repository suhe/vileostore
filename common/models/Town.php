<?php
namespace common\models;
use Yii;

class Town extends \yii\db\ActiveRecord {
    public $area;
    public $city_name;
    public $province_name;
    public $province_id;
    
    public static function tableName(){
        return 'town';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['area','city_id','province_id'],'safe','on'=>['search']],
            [['name','city_id'],'required','on'=>['save','update']]
        ];
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'area' => Yii::t('app','area'),
            'name' => Yii::t('app','area'),
            'city_id' => Yii::t('app','city'),
            'city_name' => Yii::t('app','city'),
            'province_name' => Yii::t('app','province'),
        ];
    }
    
    public function getCourier(){
        return $this->hasOne(Courier::className(), ['id' => 'town_id']);
    }
    
    public function getCity(){
        return $this->hasOne(City::className(), ['id' => 'city_id']);
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
    
    public function getActiveDataProviderTown($params){
        $query = static::find()
        ->joinWith('city')
        ->leftJoin('province','province.id = city.province_id')
        ->select(['town.id','CONCAT(province.name,\', \',city.name,\', \',town.name) AS area','city.name as city_name',
            'province.name as province_name','city.id AS city_id','province.id AS province_id'])
        ->orderBy(['CONCAT(province.name,\', \',city.name,\', \',town.name)' => SORT_ASC]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['CONCAT(city.name,\', \',town.name)'=>SORT_ASC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->area?$query->andFilterWhere(['like','CONCAT(province.name,\', \',city.name,\', \',town.name)',$this->area]):'';
        $this->province_id?$query->andFilterWhere(['city.province_id'=>$this->province_id]):'';
        $this->city_id?$query->andFilterWhere(['town.city_id'=>$this->city_id]):'';
        return $dataProvider;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Town();
            $model->name = $this->name;
            $model->city_id = $this->city_id;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            return true;
        }
        return false;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new Town();
            $model = $model->findOne($id);
            $model->name = $this->name;
            $model->city_id = $this->city_id;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
}
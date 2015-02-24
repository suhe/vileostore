<?php
namespace common\models;
use Yii;

class Shipping extends \yii\db\ActiveRecord {
    
    public $labelid;
    public $name;
    public $icon;
    public $town;
    public $area;
    public $province_id;
    public $city_id;
   
    
    public static function tableName(){
        return 'shipping';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['city_id','province_id'],'safe','on'=>['search']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'province_id' => Yii::t('app','province'),
        ];
    }
    
    public function getCourier(){
        return $this->hasOne(Courier::className(), ['id' => 'courier_id']);
    }
    
    public function getTown(){
        return $this->hasOne(Town::className(), ['id' => 'town_id']);
    }
    
    public static function getShippingTotal($town_id){
        return static::find()
        ->select(['courier.id','courier.name','courier.icon','town.name town','shipping.cost'])
        ->joinWith('courier')
        ->joinWith('town')
        ->where(['town_id' => $town_id])
        ->all();
    }
    
    public function getActiveDataProviderShipping($id,$params){
        $query = static::find()
        ->from('town')
        ->leftJoin('city','city.id = town.city_id')
        ->leftJoin('province','province.id = city.province_id')
        ->select(['town.id','CONCAT(province.name,\', \',city.name,\', \',town.name) AS area','city.name as city_name',
            'province.name as province_name','city.id AS city_id','province.id AS province_id',
            ])
        ->orderBy(['CONCAT(province.name,\', \',city.name,\', \',town.name)' => SORT_ASC]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->province_id?$query->andFilterWhere(['city.province_id'=>$this->province_id]):'';
        $this->city_id?$query->andFilterWhere(['town.city_id'=>$this->city_id]):'';
        return $dataProvider;
    }
    
    public static function Cost($courier_id,$town_id){
        $query =  static::findOne(['courier_id' => $courier_id,'town_id'=>$town_id]);
        if($query)
            $cost = $query->cost;
        else
            $cost = 0;
        return $cost;    
    }
    
}
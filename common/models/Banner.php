<?php
namespace common\models;
use Yii;

class Banner extends \yii\db\ActiveRecord {
    
    public static function tableName(){
        return 'banner';
    }
    
    public function rules(){
        return[
            [['id'],'integer'],
            [['name','status','link_url','position','slide','created_date','status'],'safe','on'=>['search']],
            [['id','image'],'safe','on'=>['save','update']],
            [['image'],'file','extensions'=>'jpg, gif, png','on'=>['save','update']],
            [['name','description','status','link_url','slide','position','width','height'],'required','on'=>['save','update']]
        ];
    }
    
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'name' => Yii::t('app','name'),
            'image' => Yii::t('app','image'),
            'status' => Yii::t('app','status'),
            'description' => Yii::t('app','description'),
            'link_url' => Yii::t('app','link url'),
            'position' => Yii::t('app','position'),
            'slide' => Yii::t('app','slide'),
            'height' => Yii::t('app','height'),
            'width' => Yii::t('app','width')
        ];
    }
    
    public static function HomePageBanner($position='home',$slide='static'){
        return \common\models\Banner::find()
        ->where(['status' => 1,'slide' => $slide])
        ->all();
    }
    
    public static function stringStatus($status){
        switch($status){
            case 1 : $str = Yii::t('app','active');break;
            case 0 : $str = Yii::t('app','non active');break;
        }
        return $str;
    }
    
    public static function dropDownPosition($all=true){
        $data = [];
        if($all==true)
            $data[0] = Yii::t('app','all');
        $data['home'] = Yii::t('app','home');
        $data['sidebar'] = Yii::t('app','sidebar');
        return $data;
    }
    
    public static function dropDownSlide($all=true){
        $data = [];
        if($all==true) $data[0] = Yii::t('app','all');
        $data['static'] = Yii::t('app','static');
        $data['slideshow'] = Yii::t('app','slideshow');
        return $data;
    }
    
    public static function dropdownStatus($All=true){
       if($All) $data[0] = Yii::t('app','all');
       $data[1] = Yii::t('app','active');
       $data[2] = Yii::t('app','non active');
       return $data;
    }
    
    public function getActiveDataProviderBanner($params){
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
        $this->position?$query->andFilterWhere(['position'=>$this->position]):'';
        $this->slide?$query->andFilterWhere(['slide'=>$this->slide]):'';
        $this->link_url?$query->andFilterWhere(['link_url'=>$this->link_url]):'';
        
        return $dataProvider;
    }
     
    public function getUpdate($id){
        if($this->validate()){
            $model = new Banner();
            $model = $model->findOne($id);
            $model->name = $this->name;
            $model->description = $this->description;
            $model->slide = $this->slide;
            $model->position = $this->position;
            $model->status = $this->status;
            $model->width = $this->width;
            $model->height = $this->height;
            $model->link_url = $this->link_url;
            $model->update();
            return true;
        }
        return false;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Banner();
            $model->name = $this->name;
            $model->description = $this->description;
            $model->slide = $this->slide;
            $model->position = $this->position;
            $model->status = $this->status;
            $model->width = $this->width;
            $model->height = $this->height;
            $model->link_url = $this->link_url;
            $model->insert();
            return $model->id;
        }
        return false;
    }
}
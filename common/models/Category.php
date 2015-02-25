<?php
namespace common\models;
use Yii;

class Category extends \yii\db\ActiveRecord {
    public $structcategory;
    
    public static function tableName(){
        return 'category';
    }
    
    public function rules(){
        return[
            [['id','order'],'integer'],
            [['structure','status','slug','created_date'],'safe','on'=>['search']],
            [['id','image','icon','parent_id'],'safe','on'=>['save','update']],
            [['image'],'file','extensions'=>'jpg, gif, png','on'=>['save','update']],
            [['name','status','order','layout'],'required','on'=>['save','update']]
        ];
    }
    
    public function attributeLabels(){
        return [
            'id' => Yii::t('app','id'),
            'name' => Yii::t('app','name'),
            'icon' => Yii::t('app','icon'),
            'image' => Yii::t('app','image'),
            'parent_id' => Yii::t('app','position'),
            'status' => Yii::t('app','status'),
            'order' => Yii::t('app','order'),
        ];
    }
    
    public function getProductCategory(){
        return $this->hasMany(\common\models\ProductCategory::className(), ['category_id' => 'id']);
    }
    
    public static function getNestedCategory($status,$parent_id){
        return static::find()
        ->where(['status' => $status , 'parent_id' => $parent_id ])
        ->all();    
    }
    
    public static function getHierarchyCategory($parent_id=0){
        return static::find()
        ->where(['parent_id' => $parent_id ])
        ->all();    
    }
    
    public static function ListCategory($option=[],$All=true){
        return static::find()
        ->where(['id' => $option])
        ->all();   
    }
    
    public static function getHierarchyList($All=true,$caption='') {
        $options = [];
        if($All==true)
            $options[0] = $caption?$caption:Yii::t('app','all category');
            
        $parents = self::find()
        ->where(['parent_id'=> 0])
        ->all();
        
        foreach($parents as $id => $p) {
            $children = self::find()
            ->where(['parent_id'=> $p->id])
            ->all();
            
            $child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options[$p->name] = $child_options;
        }
        return $options;
    }
    
    public static function getHierarchyDropdownList($All=true,$caption='') {
        $options = [];
        if($All==true)
            $options[0] = $caption?$caption:Yii::t('app','all category');
        
        $parents = self::find()
        ->where(['parent_id'=> 0])
        ->orderBy(['parent_id' => SORT_ASC])
        ->all();
        
        foreach($parents as $id => $p) {
            $children = self::find()
            ->where(['parent_id'=> $p->id])
            ->orderBy(['order' => SORT_ASC])
            ->all();
            $options[$p->id] = $p->name;
            $child_options = [];
            foreach($children as $child) {
                $options[$child->id] = "&nbsp;&nbsp;&nbsp; > ". $child->name;
            }
        }
        return $options;
    }
    
    public static function getDropdownLayout($All=true,$caption='') {
        $options = [];
        if($All==true)
            $options[0] = $caption?$caption:Yii::t('app','all layout');
        
        $storeFolder = Yii::getAlias('@frontend/views/layouts');
        $files = scandir($storeFolder);
        if ( false!==$files) {
            foreach($files as $file) {
                if ( '.'!=$file && '..'!=$file) { 
                    $options[$file] = $file;
                }
            }
        }
        
        return $options;
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
    
    public function getActiveDataProviderCategory($params){
        $query = static::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_ASC,'parent_id'=>SORT_ASC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->structure?$query->andFilterWhere(['like','structure',$this->structure]):'';
        $this->slug?$query->andFilterWhere(['like','slug',$this->slug]):'';
        $this->status?$query->andFilterWhere(['status'=>$this->status]):'';
        return $dataProvider;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new Category();
            $model->structure = $this->GetStructureParentSingleData($this->parent_id);
            $model->name = $this->name;
            $model->icon = $this->icon;
            $model->order = $this->order;
            $model->slug = Yii::$app->store->slug($this->name);
            $model->status = $this->status;
            $model->parent_id = $this->parent_id;
            $model->layout = $this->layout;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date  = date('Y-m-d H:i:s');
            $model->insert();
            return $model->id;
        }
        return false;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new Category();
            $model = $model->findOne($id);
            $model->structure = $this->GetStructureParentSingleData($this->parent_id);
            $model->name = $this->name;
            $model->icon = $this->icon;
            $model->order = $this->order;
            $model->slug = Yii::$app->store->slug($this->name);
            $model->status = $this->status;
            $model->parent_id = $this->parent_id;
            $model->layout = $this->layout;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date  = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
    /**
     *check to parent child data to category structure
    **/
    public function GetStructureParentSingleData($parent,$level=1){
        if($level==1) $this->structcategory = $this->name;
        $row = Category::find()->where(['id' => $parent])->one();
        if($row){
            $this->structcategory = $row->name.' > '.$this->structcategory ;
            $this->GetStructureParentSingleData($row['parent_id'],$level+1);
        }
        return $this->structcategory;
    }
    
    public static function Layout($id){
        $query = self::findOne($id);
        if(isset($query->layout))
            $layout = $query->layout;
        else
            $layout = static::tableName();
        return $layout;    
    }
}
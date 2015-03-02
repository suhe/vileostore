<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * Banner controller
 */
class AreaController extends \yii\web\Controller {
    
    public function actions(){
        if(!Yii::$app->store->isAdmin()) return $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Town(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderTown(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd_area() {
        $model =  new \common\models\Town(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && $model->getSave()){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been succcesffuly'));
            return $this->redirect(['area/index']);
        }
        
        return $this->render('formArea',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit_area($id){
        $model =  new \common\models\Town(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['area/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
            $model->city_id = $query->city_id;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update has been succesfuly'));
            $this->redirect(['area/edit_area','id'=>$id]);
        }
        
        return $this->render('formArea',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove_area($id){
        $model =  new \common\models\Town();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['area/index']);
        
        $delete = \common\models\Town::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been successfuly'));
        return $this->redirect(['area/index']);
    }
    
    public function actionAdd_city() {
        $model =  new \common\models\City(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && $model->getSave()){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been succesfuly'));
            return $this->redirect(['area/index']);
        }
        
        return $this->render('formCity',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit_city($id){
        $model =  new \common\models\City(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['area/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
            $model->province_id = $query->province_id;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update has been succesfuly'));
            $this->redirect(['area/edit_city','id'=>$id]);
        }
        
        return $this->render('formCity',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove_city($id){
        $model =  new \common\models\City();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['area/index']);
        
        $delete = \common\models\City::deleteAll('id = :id',[':id' => $id]);
        $delete = \common\models\Town::deleteAll('city_id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been successfuly'));
        return $this->redirect(['area/index']);
    }
    
    public function actionAdd_province() {
        $model =  new \common\models\Province(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && $model->getSave()){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been succesfuly'));
            return $this->redirect(['area/index']);
        }
        
        return $this->render('formProvince',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit_province($id){
        $model =  new \common\models\Province(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['area/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update has been succesfuly'));
            $this->redirect(['area/edit_province','id'=>$id]);
        }
        
        return $this->render('formProvince',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove_province($id){
        $model =  new \common\models\Province();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['area/index']);
        
        // delete town
        $selCity = \common\models\City::find()->where(['province_id' => $id])->all();
        foreach($selCity as $row){
            $delTown = \common\models\Town::deleteAll('city_id = :id',[':id' => $row->id]);
        }
        //two , delete city after select city
        $delCity = \common\models\City::deleteAll('province_id = :id',[':id' => $id]);
        //end delete province
        $delProv = \common\models\Province::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been successfuly'));
        return $this->redirect(['area/index']);
    }


}
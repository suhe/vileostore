<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * Courier controller
 */
class CourierController extends \yii\web\Controller {
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Courier(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderCourier(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd(){
        $model =  new \common\models\Courier(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && ($id = $model->getSave())){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->icon;
            $storeFolder = Yii::getAlias('@image_courier/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->icon = UploadedFile::getInstance($model, 'icon')){
                $model->icon->saveAs($storeFolder.'/'.$model->icon->name); 
                \common\models\Courier::updateAll(['icon'=>$model->icon->name],['id'=>$id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been successfuly'));
            return $this->redirect(['courier/update_information','id'=>$id]);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionUpdate_information($id=0){
        $model =  new \common\models\Courier(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['courier/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
            $model->origin = $query->origin;
            $model->icon = $query->icon;
            $model->status = $query->status;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->icon;
            $storeFolder = Yii::getAlias('@image_courier/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->icon= UploadedFile::getInstance($model, 'icon')){
                $model->icon->saveAs($storeFolder.'/'.$model->icon->name); 
                $query->icon = $model->icon->name;
                $query->update();
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update banner has been successfuly'));
            $this->redirect(['courier/update_information','id'=>$id]);
        }
        
        return $this->render('form_main',[
            'model' => $model,
            'form' => 'form_information',
        ]);
    }
    
    public function actionRemove($id){
        $model =  new \common\models\Courier();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['courier/index']);
        
        $storeFolder = Yii::getAlias('@image_courier/'.$id);
        $filename = $storeFolder.'/'.$query->icon;
        if($query->icon && file_exists($filename)){
            unlink($filename);
        }
        $deleteImage = \common\models\Courier::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been successfuly'));
        return $this->redirect(['courier/index']);
    }
    
    public function actionShipping($id){
        $model =  new \common\models\Shipping(['scenario' => 'search']);
        //update $model
        if($model->load(Yii::$app->request->QueryParams) && $model->validate() ){
            $params = Yii::$app->request->QueryParams;
        }
        return $this->render('form_main',[
            'model' => $model,
            'form' => 'form_shipping',
            'dataProvider' => $model->getActiveDataProviderShipping($id,Yii::$app->request->QueryParams)
        ]);
    }
    
    public function actionUpdate_shipping($id){
        $town_id = isset($_POST['town_id'])?$_POST['town_id']:0;
        $value = isset($_POST['value'])?$_POST['value']:0;
        $id = isset($id)?$id:0;
        Yii::$app->response->format = 'json';
        // update / insert model
        $model = new \common\models\Shipping();
        $query = $model->findOne(['courier_id'=>$id,'town_id'=>$town_id]);
        if($query){
            $query->cost = $value;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date = date('Y-m-d H:i:s');
            $query->update();
        }
        else {
            $model->courier_id = $id;
            $model->town_id = $town_id;
            $model->cost = $value;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date = date('Y-m-d H:i:s');
            $query = $model->insert();
        }
        
        if($value==0){
            $delete = \common\models\Shipping::deleteAll('courier_id = :courier_id AND town_id > :town_id', [':courier_id' => $id, ':town_id' => $town_id]);
        }
        
        if($query){
            return [
                'success' => true,
                'id' => $id,
                'town_id' => $town_id,
                'value' => $value,
            ];
        } else {
            return [
                'success' => false
            ];
        }
    }
    
    

}
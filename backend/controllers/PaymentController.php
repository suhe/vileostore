<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * Banner controller
 */
class PaymentController extends \yii\web\Controller {
    
    public function actions(){
        if(!Yii::$app->store->isAdmin()) return $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Bank(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderCategory(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd(){
        $model =  new \common\models\Bank(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && ($id = $model->getSave())){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->icon;
            $storeFolder = Yii::getAlias('@image_bank/'.$id);
            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->icon = UploadedFile::getInstance($model, 'icon')){
                $model->icon->saveAs($storeFolder.'/'.$model->icon->name); 
                \common\models\Bank::updateAll(['icon'=>$model->icon->name],['id'=>$id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been succcesffuly'));
            return $this->redirect(['payment/index']);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit($id){
        $model =  new \common\models\Bank(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['payment/index']);
        
        if($query){
            $model->id = $query->id;
            $model->account = $query->account;
            $model->owner = $query->owner;
            $model->branch = $query->branch;
            $model->name = $query->name;
            $model->icon = $query->icon;
            $model->order = $query->order;
            $model->status = $query->status;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->icon;
            $storeFolder = Yii::getAlias('@image_bank/'.$id);
    
            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->icon= UploadedFile::getInstance($model, 'icon')){
                $model->icon->saveAs($storeFolder.'/'.$model->icon->name);
                $query->icon = $model->icon->name;
                $query->update();
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update has been succcesffuly'));
            $this->redirect(['payment/edit','id'=>$id]);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove($id){
        $model =  new \common\models\Bank();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['payment/index']);
        
        $storeFolder = Yii::getAlias('@image_bank/'.$id);
        $filename = $storeFolder.'/'.$query->icon;
        if($query->icon && file_exists($filename)){
            unlink($filename);
        }
        $deleteImage = \common\models\Bank::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been succcesfuly'));
        return $this->redirect(['payment/index']);
    }

}
<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * Banner controller
 */
class BrandController extends \yii\web\Controller {
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Brand(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderBrand(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd(){
        $model =  new \common\models\Brand(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && ($id = $model->getSave())){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->logo;
            $storeFolder = Yii::getAlias('@image_brand/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->logo = UploadedFile::getInstance($model, 'logo')){
                $model->logo->saveAs($storeFolder.'/'.$model->logo->name); 
                \common\models\Brand::updateAll(['logo'=>$model->logo->name],['id'=>$id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been succcesffuly'));
            return $this->redirect(['brand/index']);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit($id){
        $model =  new \common\models\Brand(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['brand/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
            $model->logo = $query->logo;
            $model->status = $query->status;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->logo;
            $storeFolder = Yii::getAlias('@image_brand/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->logo= UploadedFile::getInstance($model, 'logo')){
                $model->logo->saveAs($storeFolder.'/'.$model->logo->name); 
                $query->logo = $model->logo->name;
                $query->update();
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update banner has been succcesffuly'));
            $this->redirect(['brand/edit','id'=>$id]);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove($id){
        $model =  new \common\models\Brand();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['brand/index']);
        
        $storeFolder = Yii::getAlias('@image_brand/'.$id);
        $filename = $storeFolder.'/'.$query->logo;
        if($query->logo && file_exists($filename)){
            unlink($filename);
        }
        $deleteImage = \common\models\Brand::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been succcesfuly'));
        return $this->redirect(['brand/index']);
    }

}
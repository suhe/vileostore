<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * Banner controller
 */
class BannerController extends \yii\web\Controller {
    
    public function actions(){
        if(!Yii::$app->store->isAdmin()) return $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Banner(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderBanner(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd(){
        $model =  new \common\models\Banner(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && ($id = $model->getSave())){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->image;
            $storeFolder = Yii::getAlias('@image_banner/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->image = UploadedFile::getInstance($model, 'image')){
                $model->image->saveAs($storeFolder.'/'.$model->image->name); 
                \common\models\Banner::updateAll(['image'=>$model->image->name],['id'=>$id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save new banner has been succcesffuly'));
            return $this->redirect(['banner/index']);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit($id){
        $model =  new \common\models\Banner(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['banner/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
            $model->link_url = $query->link_url;
            $model->slide = $query->slide;
            $model->position = $query->position;
            $model->image = $query->image;
            $model->width = $query->width;
            $model->height = $query->height;
            $model->status = $query->status;
            $model->description = $query->description;
        }
        
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->image;
            $storeFolder = Yii::getAlias('@image_banner/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->image= UploadedFile::getInstance($model, 'image')){
                $model->image->saveAs($storeFolder.'/'.$model->image->name); 
                $query->image = $model->image->name;
                $query->update();
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update banner has been succcesffuly'));
            $this->redirect(['banner/edit','id'=>$id]);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove($id){
        $model =  new \common\models\Banner();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['banner/index']);
        
        $storeFolder = Yii::getAlias('@image_banner/'.$id);
        $filename = $storeFolder.'/'.$query->image;
        if($query->image && file_exists($filename)){
            unlink($filename);
        }
        $deleteImage = \common\models\Banner::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete banner has been succcesffuly'));
        return $this->redirect(['banner/index']);
    }

}
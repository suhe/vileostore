<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * Banner controller
 */
class CategoryController extends \yii\web\Controller {
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Category(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderCategory(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd(){
        $model =  new \common\models\Category(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && ($id = $model->getSave())){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->image;
            $storeFolder = Yii::getAlias('@image_category/'.$id);
            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->image = UploadedFile::getInstance($model, 'image')){
                $model->image->saveAs($storeFolder.'/'.$model->image->name); 
                \common\models\Category::updateAll(['image'=>$model->image->name],['id'=>$id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been succcesffuly'));
            return $this->redirect(['category/index']);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit($id){
        $model =  new \common\models\Category(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['category/index']);
        
        if($query){
            $model->id = $query->id;
            $model->name = $query->name;
            $model->icon = $query->icon;
            $model->order = $query->order;
            $model->image = $query->image;
            $model->parent_id = $query->parent_id;
            $model->layout = $query->layout;
            $model->status = $query->status;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            /** Upload Image **/
            $ds = DIRECTORY_SEPARATOR;
            $fileName = $model->image;
            $storeFolder = Yii::getAlias('@image_category/'.$id);

            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            if($model->image= UploadedFile::getInstance($model, 'image')){
                $model->image->saveAs($storeFolder.'/'.$model->image->name); 
                $query->image = $model->image->name;
                $query->update();
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update has been succcesffuly'));
            $this->redirect(['category/edit','id'=>$id]);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionRemove($id){
        $model =  new \common\models\Category();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['category/index']);
        
        $storeFolder = Yii::getAlias('@image_category/'.$id);
        $filename = $storeFolder.'/'.$query->image;
        if($query->image && file_exists($filename)){
            unlink($filename);
        }
        $deleteImage = \common\models\Category::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been succcesfuly'));
        return $this->redirect(['category/index']);
    }

}
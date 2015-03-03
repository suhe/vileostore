<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * Setting controller
 */
class SettingController extends \yii\web\Controller {
    
    public $customer = 1;
    public $administrator = 2;
    
    public function actions(){
        if(!Yii::$app->store->isAdmin()) return $this->redirect(['site/login']);
    }
    
    public function actionBasic(){
        $model =  new \common\models\Setting();
        $items = $model
        ->find()
        ->where(['type' => Yii::$app->controller->action->id])
        ->all();
        
        if (Model::loadMultiple($items, Yii::$app->request->post()) && Model::validateMultiple($items)) {
            $count = 0;
            foreach ($items as $item) {
                \common\models\Setting::updateAll(['content'=>$item->content],['id'=>$item->id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg update has been successfuly'));
            return $this->redirect(['setting/basic']);
        }
            
        return $this->render('form-main',[
            'model' => $model,
            'items' => $items,
            'form' => 'form-textInput',
        ]);
    }
    
    public function actionContact(){
        $model =  new \common\models\Setting();
        $items = $model
        ->find()
        ->where(['type' => Yii::$app->controller->action->id])
        ->all();
        
        if (Model::loadMultiple($items, Yii::$app->request->post()) && Model::validateMultiple($items)) {
            $count = 0;
            foreach ($items as $item) {
                \common\models\Setting::updateAll(['content'=>$item->content],['id'=>$item->id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg update has been successfuly'));
            return $this->redirect([Yii::$app->controller->getRoute()]);
        }
            
        return $this->render('form-main',[
            'model' => $model,
            'items' => $items,
            'form' => 'form-textInput',
        ]);
    }
    
    public function actionMeta(){
        $model =  new \common\models\Setting();
        $items = $model
        ->find()
        ->where(['type' => Yii::$app->controller->action->id])
        ->all();
        
        if (Model::loadMultiple($items, Yii::$app->request->post()) && Model::validateMultiple($items)) {
            $count = 0;
            foreach ($items as $item) {
                \common\models\Setting::updateAll(['content'=>$item->content],['id'=>$item->id]);
            }
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg update has been successfuly'));
            return $this->redirect([Yii::$app->controller->getRoute()]);
        }
            
        return $this->render('form-main',[
            'model' => $model,
            'items' => $items,
            'form' => 'form-textarea',
        ]);
    }

}
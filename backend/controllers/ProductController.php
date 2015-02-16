<?php
namespace backend\controllers;
use Yii;

/**
 * Category controller
 */
class ProductController extends \yii\web\Controller {
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Product(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderProduct(Yii::$app->request->queryParams)
        ]);
    }

}
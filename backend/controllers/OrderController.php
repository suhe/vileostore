<?php
namespace backend\controllers;
use Yii;

/**
 * Category controller
 */
class OrderController extends \yii\web\Controller {
    
    public function actions(){
        if(!Yii::$app->store->isAdmin()) return $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Order(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderOrder(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionSummary($id){
        $model = new \common\models\Order(['scenario' => 'summary']);
        if(!$query = $model->findOne($id))
            return $this->redirect(['order/index']);
        
        return $this->render('summary',[
            'model' => $model,
            'view'  => 'summary_information',
            'data'  => $model->getSingleOrder($id)
        ]);
    }
    
    public function actionInvoice($id){
        $model = new \common\models\Order(['scenario' => 'summary']);
        if(!$query = $model->findOne($id))
            return $this->redirect(['order/index']);
        
        return $this->render('summary',[
            'model' => $model,
            'view'  => 'summary_invoice',
            'data'  => $model->getSingleOrder($id),
            'details' => \common\models\OrderProduct::AllOrderProduct($id),
        ]);
    }
    
    public function actionHistory($id){
        $model = new \common\models\OrderHistory();
        return $this->render('summary',[
            'model' => $model,
            'view'  => 'summary_history',
            'data' => $model->getActiveDataProviderOrderHistory($id)
        ]);
    }
    
    public function actionHistory_add($id){
        $model = new \common\models\OrderHistory(['scenario' => 'update' ]);
        if($model->load(Yii::$app->request->post()) && $model->getUpdateHistory($id)){
            $this->redirect(['order/history','id'=>$id],302);
        }
        return $this->render('summary',[
            'model' => $model,
            'view'  => 'summary_history_form',
            'data' => $model->getActiveDataProviderOrderHistory($id)
        ]);
    }

}
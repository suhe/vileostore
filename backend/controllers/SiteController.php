<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller{    
    public function actionLogin(){
        if(Yii::$app->store->isAdmin()) return $this->goHome();
        
        $model = new \common\models\LoginForm(['scenario' => 'login']);
        
        //process to login
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg welcome back'));
            return $this->redirect(['site/index']);
        }
        
        $this->layout = 'login';    
        return $this->render('login', [
                'model' => $model,
        ]);
    }
    
    public function actionIndex() {
        if(!Yii::$app->store->isAdmin()) return $this->redirect(['site/login']);
        
        return $this->render('index', [
            'bestSellerdataProvider' => \common\models\Product::getActiveDataProviderBestSeller(5),
            'salesTodaydataProvider' => \common\models\Order::getActiveDataProviderOrderByCondition(['date_format(order.created_date,\'%Y-%m-%d\')' => date('Y-m-d'),'order.status'=>1],5),
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }
}

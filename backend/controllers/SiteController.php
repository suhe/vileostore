<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller{    
    public function actionLogin(){
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new \common\models\LoginForm(['scenario' => 'login']);
        
        //process to login
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg welcome back'));
            return $this->redirect(['product/index']);
        }
        
        $this->layout = 'login';    
        return $this->render('login', [
                'model' => $model,
        ]);
    }
    
    public function actionIndex() {
        if(Yii::$app->user->isGuest)
            return $this->redirect(['site/login']);

    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }
}

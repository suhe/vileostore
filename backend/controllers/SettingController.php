<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

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
        $user_id = Yii::$app->user->getId();
        $model =  new \common\models\User(['scenario' => 'update_profile']);
        $query = $model->findOne($user_id);
        
        if($query){
            $model->first_name = $query->first_name;
            $model->middle_name = $query->middle_name;
            $model->last_name = $query->last_name;
            $model->email = $query->email;
        }
        
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdateProfile($user_id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg update has been successfuly'));
            return $this->redirect(['setting/basic']);
        }

        return $this->render('form-main',[
            'model' => $model,
            'form' => 'form-basic',
        ]);
    }

}
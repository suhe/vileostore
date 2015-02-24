<?php
namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;

/**
 * User controller
 */
class UserController extends \yii\web\Controller {
    
    public $customer = 1;
    public $administrator = 2;
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionCustomer(){
        $model = new \common\models\User(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'title' => Yii::t('app','customer'),
            'dataProvider' => $model->getActiveDataProviderUser($this->customer,Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdmin(){
        $model = new \common\models\User(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'title' => Yii::t('app','administrator'),
            'dataProvider' => $model->getActiveDataProviderUser($this->administrator,Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionAdd(){
        $model =  new \common\models\User(['scenario' => 'save']);
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getSave())){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save has been successfuly'));
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        return $this->render('form',[
            'model' => $model,
        ]);
    }
    
    public function actionEdit($id){
        $model =  new \common\models\User(['scenario' => 'update']);
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['category/index']);
        
        if($query) {
            $model->id = $query->id;
            $model->first_name = $query->first_name;
            $model->middle_name = $query->middle_name;
            $model->last_name = $query->last_name;
            $model->email = $query->email;
            $model->status = $query->status;
        }
        //update $model
        if($model->load(Yii::$app->request->post()) && ($model->getUpdate($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update has been successfuly'));
            $this->redirect(['user/edit','id'=>$id]);
        }
        
        return $this->render('form_main',[
            'model' => $model,
            'form' => 'form_information',
        ]);
    }
    
    public function actionAddress($id){
        $model = new \common\models\UserAddress(['scenario' => 'search']);
        return $this->render('form_main',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderUserAddress($id,Yii::$app->request->queryParams),
            'form' => 'form_address',
        ]);
    }
    
    public function actionTransaction($id){
        $model = new \common\models\Order(['scenario' => 'search']);
        return $this->render('form_main',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderOrderByUser($id,Yii::$app->request->queryParams),
            'form' => 'form_transaction',
        ]);
    }
    
    public function actionRemove($id){
        $model =  new \common\models\User();
        $query = $model->findOne($id);
        if(!$query) return $this->redirect(['user/index']);
    
        $delete= \common\models\User::deleteAll('id = :id',[':id' => $id]);
        Yii::$app->session->setFlash('msg',Yii::t('app/message','delete has been successfuly'));
        return $this->redirect(['user/index']);
    }

}
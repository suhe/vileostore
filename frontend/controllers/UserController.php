<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class UserController extends Controller {
    /**
     * @inheritdoc
     */
    
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            return $this->redirect(['site/login'],301);
    }

    public function actionProfile(){
        $this->layout = 'user';
        $user = \common\models\User::findOne(Yii::$app->user->getId());
        $formModel = new \common\models\User(['scenario' => 'update_profile']);
        $formModel->first_name = $user->first_name;
        $formModel->middle_name = $user->middle_name;
        $formModel->last_name = $user->last_name;
        $formModel->email = $user->email;
        
        if($formModel->load(Yii::$app->request->post()) && $formModel->getUpdateProfile(Yii::$app->user->getId())){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg your profile is up to date'));
            return $this->redirect(['user/profile'],301);
        }
        
        return $this->render('myprofile',[
            'formModel' => $formModel
        ]);
    }
    
    public function actionHistory(){
        $this->layout = 'user';
        $model = new \common\models\Order(['scenario' => 'search']);
        return $this->render('mytransaction',[
            'model' => $model,
            'dataProvider' => $model->getMyOrderTransaction(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionHistory_details($id){
        $query = \common\models\Order::findOne($id);
        //cek valid user id and order user id
        if($query->user_id!=Yii::$app->user->getId()) return $this->redirect(['user/history'],301);
        
        $this->layout = 'user';
        $model  = new \common\models\OrderProduct(['scenario' => 'search']);
        $model2 = new \common\models\OrderHistory();
        return $this->render('mytransaction_details',[
            'data'  => $query,
            'model' => $model,
            'dataProvider' => $model->getMyOrderProductTransaction($id,Yii::$app->request->queryParams),
            'dataProviderHistory' => $model2->getActiveDataProviderOrderHistory($id),
        ]);
    }
    
    public function actionConfirm_payment($id){
        $query = \common\models\Order::findOne($id);
        //cek valid user id and order user id
        if($query->user_id!=Yii::$app->user->getId()) return $this->redirect(['user/history'],301);
        
        $formModel = new \common\models\ConfirmationForm(['scenario' => 'confirm_user']);
        
        //process to action
        if($formModel->load(Yii::$app->request->post()) && $formModel->getConfirmPayment($id)){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg thanks for confirmation wait for verification'));
            Yii::$app->mail->verification($id,Yii::t('app','confirm payment invoice'));
            return $this->redirect(['user/history_details','id' => $id],301);
        }
        
        $this->layout = 'user';
        $formModel->bank_name = Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->middle_name.' '.Yii::$app->user->identity->last_name;
        $formModel->total_transfer = Yii::$app->Formatter->asDecimal($query->grand_total,0);
        return $this->render('myconfirmation',[
            'formModel' => $formModel,
            'cart' => $query,
        ]);
    }
    
    
    public function actionDiscussion(){
        $model = new \common\models\Discussion();
        $query = $model->getAllQueryWithPagination(Yii::$app->user->getId(),Yii::$app->request->QueryParams);
        $countQuery = clone $query; //coun total query
        //pagination total count and pagesize
        $pages = new \yii\data\Pagination([
            'pageSizeParam' => 'show',
            'totalCount' => $countQuery->count(),
            'pageSize' => Yii::$app->params['show_page'],
            'params' => array_merge($_GET),
        ]);
        
        // get query
        $query = $query
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        
        $this->layout = 'user';
        return $this->render('mydiscussion',[
            'query' => $query,
            'pages' => $pages,
        ]);
    }
    
    public function actionRemovedisc($id){
        $query = \common\models\Discussion::findOne($id);
        //cek valid user id and order user id
        if($query->user_id != Yii::$app->user->getId()) return $this->redirect(['user/discussion'],301);
        $query->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionAddress(){
        $model = new \common\models\UserAddress();
        $query = $model->getAllQueryWithPagination(Yii::$app->user->getId(),Yii::$app->request->QueryParams);
        $countQuery = clone $query; //coun total query
        //pagination total count and pagesize
        $pages = new \yii\data\Pagination([
            'pageSizeParam' => 'show',
            'totalCount' => $countQuery->count(),
            'pageSize' => Yii::$app->params['show_page'],
            'params' => array_merge($_GET),
        ]);
        
        // get query
        $query = $query
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        
        $this->layout = 'user';
        return $this->render('myaddress',[
            'query' => $query,
            'pages' => $pages,
        ]);
    }
    
    public function actionAddaddress(){
        $formModel = new \common\models\UserAddress(['scenario' => 'register']);
        $this->layout = 'user';
        //proceess to action
        if($formModel->load(Yii::$app->request->post()) && $formModel->getSaveUserAddress(Yii::$app->user->getId())){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg address have successfully saved'));
            return $this->redirect(['user/address'],301);
        }
        
        return $this->render('myaddress_form',[
            'formModel' => $formModel,
            'query' => 0,
            'title' => Yii::t('app','add address') 
        ]);
    }
    
    public function actionEditaddress($id){
         $query = \common\models\UserAddress::findOne($id);
        //cek valid user id and order user id
        if($query->user_id != Yii::$app->user->getId()) return $this->redirect(['user/address'],301);
        
        $formModel = new \common\models\UserAddress(['scenario' => 'register']);
        $this->layout = 'user';
        //proceess to action
        if($formModel->load(Yii::$app->request->post()) && $formModel->getUpdateUserAddress(Yii::$app->user->getId(),$id)){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg address have successfully updated'));
            return $this->redirect(['user/address'],301);
        }
        
        $formModel->address = $query->address;
        $formModel->province_id = $query->province_id;
        $formModel->city_id = $query->city_id;
        $formModel->town_id = $query->town_id;
        $formModel->receiver = $query->receiver;
        $formModel->receiver_contact = $query->receiver_contact;
        return $this->render('myaddress_form',[
            'formModel' => $formModel,
            'query' => $query,
            'title' => Yii::t('app','edit address') 
        ]);
    }
    
    public function actionRemoveaddress($id){
        $query = \common\models\UserAddress::findOne($id);
        //cek valid user id and order user id
        if($query->user_id != Yii::$app->user->getId()) return $this->redirect(['user/address'],301);
        $query->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionChpassword(){
        $this->layout = 'user';
        $formModel = new \common\models\User(['scenario' => 'update_password']);
        $user = $formModel->findOne(Yii::$app->user->getId());
        if($formModel->load(Yii::$app->request->post()) && $formModel->getUpdatePassword(Yii::$app->user->getId())){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg your password is changed'));
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        return $this->render('mypassword',[
            'formModel' => $formModel
        ]);
    }
    
    
    public function actionDropship(){
        $model = new \common\models\UserDropship();
        $query = $model->getAllQueryWithPagination(Yii::$app->user->getId(),Yii::$app->request->QueryParams);
        $countQuery = clone $query; //coun total query
        //pagination total count and pagesize
        $pages = new \yii\data\Pagination([
            'pageSizeParam' => 'show',
            'totalCount' => $countQuery->count(),
            'pageSize' => Yii::$app->params['show_page'],
            'params' => array_merge($_GET),
        ]);
        
        // get query
        $query = $query
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        
        $this->layout = 'user';
        return $this->render('mydropship',[
            'query' => $query,
            'pages' => $pages,
        ]);
    }
    
    public function actionAdddropship(){
        $formModel = new \common\models\UserDropship(['scenario' => 'register']);
        $this->layout = 'user';
        //proceess to action
        if($formModel->load(Yii::$app->request->post()) && $formModel->getSaveUserDropship(Yii::$app->user->getId())){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg address have successfully saved'));
            return $this->redirect(['user/dropship'],301);
        }
        
        return $this->render('mydropship_form',[
            'formModel' => $formModel,
            'query' => 0,
            'title' => Yii::t('app','add dropship') 
        ]);
    }
    
    public function actionEditdropship($id){
         $query = \common\models\UserDropship::findOne($id);
        //cek valid user id and order user id
        if($query->user_id != Yii::$app->user->getId()) return $this->redirect(['user/address'],301);
        
        $formModel = new \common\models\UserDropship(['scenario' => 'register']);
        $this->layout = 'user';
        //proceess to action
        if($formModel->load(Yii::$app->request->post()) && $formModel->getUpdateUserDropship(Yii::$app->user->getId(),$id)){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','msg address have successfully updated'));
            return $this->redirect(['user/dropship'],301);
        }
        
        $formModel->address = $query->address;
        $formModel->province_id = $query->province_id;
        $formModel->city_id = $query->city_id;
        $formModel->town_id = $query->town_id;
        $formModel->receiver = $query->receiver;
        $formModel->receiver_contact = $query->receiver_contact;
        $formModel->sender = $query->sender;
        $formModel->sender_contact = $query->sender_contact;
        
        return $this->render('mydropship_form',[
            'formModel' => $formModel,
            'query' => $query,
            'title' => Yii::t('app','edit dropship') 
        ]);
    }
    
    public function actionRemovedropship($id){
        $query = \common\models\UserDropship::findOne($id);
        //cek valid user id and order user id
        if($query->user_id != Yii::$app->user->getId()) return $this->redirect(['user/dropship'],301);
        $query->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
    
}

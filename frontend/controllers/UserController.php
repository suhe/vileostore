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
        $model = new \common\models\OrderProduct(['scenario' => 'search']);
        return $this->render('mytransaction_details',[
            'data'  => $query,
            'model' => $model,
            'dataProvider' => $model->getMyOrderProductTransaction($id,Yii::$app->request->queryParams)
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
        $model = new \common\models\Discusion();
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
    
}

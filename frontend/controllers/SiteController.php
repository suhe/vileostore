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
class SiteController extends Controller {
    /**
     * @inheritdoc
     */
    
    
    public function actions(){
    }

    public function actionIndex(){
        $this->layout = 'home';
        return $this->render('home');
    }

    public function actionLogin(){
        if (!\Yii::$app->user->isGuest) return $this->redirect(['user/profile']);
        $loginModel = new LoginForm(['scenario' => 'login']);
        $registerModel = new \common\models\User(['scenario' => 'register']);
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg welcome back'));
            return $this->goBack();
        }
        else if($registerModel->load(Yii::$app->request->post()) && $registerModel->Register()) {
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg thanks for registration please login your email and password'));
            return $this->redirect(['site/login']);
        }
        
        $this->layout = 'login-register';
        return $this->render('login-register', [
            'loginModel' => $loginModel,
            'registerModel' => $registerModel,
        ]);
    }
    
    public function actionForgot_password(){
        if (!\Yii::$app->user->isGuest) return $this->goHome();
        $model = new LoginForm(['scenario' => 'forgot_password']);
        if ($model->load(Yii::$app->request->post()) && $model->forgotPassword()) {
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg password has been send to email please check inbox/spam'));
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = 'login-register';
        return $this->render('forgot_password', [
            'model' => $model
        ]);
    }
    
    public function actionResetpassword($id=''){
        $query = \common\models\User::findOne(['auth_key' => $id,'auth_key_expired' => date('Y-m-d')]);
        if(!$query){
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg token reset password not valid'));
            return $this->redirect(['site/forgot_password']);
        }
        
        $this->layout = 'login-register';
        $model = new LoginForm(['scenario' => 'reset_password']);
        
        if ($model->load(Yii::$app->request->post()) && $model->resetPassword($id)) {
            Yii::$app->session->setFlash('msg', Yii::t('app/message','msg reset password has been send to email please check inbox/spam'));
            return $this->redirect(['site/login']);
        }
        
        return $this->render('reset_password', [
            'model' => $model,
            'query' => $query,
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(['site/index']);
    }

    public function actionRequestPasswordReset(){
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    
    public function actionTest(){
        Yii::$app->mail->send(['hendarsyahss@gmail.com'],'Invoice Vileo.co.id','invoice',[
            'data' => \common\models\Order::find()
                        ->select(['order.invoice_no','courier.name as courier_name','order.grand_total',
                                  'order.receiver','order.receiver_contact','order.address','order.town',
                                  'order.city','order.town','order.shipping_cost'])     
                        ->joinWith('courier')
                        ->where(['order.id'=>21])
                        ->one(),
            'product' => \common\models\OrderProduct::find()
                        ->select(['product_id','product.sku','product.image as product_image','product.name as product_name','qty','product_price',
                                  'subtotal','product_weight'])
                        ->joinWith('product')
                        ->where(['order_id' => 21])
                        ->all(),
        ]);
    }
    
    public function actionNewsletter(){
        $formModel = new \common\models\Newsletter();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->getSave()) {
            $formModel->refresh();
            Yii::$app->response->format = 'json';
            //set email
            return ['success' => true,'message' => Yii::t('app/message','msg thanks your email has been registered')];
        }
        else {
            Yii::$app->response->format = 'json';
            return ['success' => false,'message' => Yii::t('app/message','msg your email has been available registered')];
        }
    }
    
    public function actionError(){
        $this->layout = '404';
        return $this->render('error', [
        ]);
    }
    
    
    public function actionPage($id=1){
        $model = \common\models\Page::findOne($id);
        if(!$model) return $this->redirect(['site/error']);
        $this->layout = 'page';
        return $this->render('page',[
            'page' => $model
        ]);
    }
    
}
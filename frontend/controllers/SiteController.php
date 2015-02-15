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
        if (!\Yii::$app->user->isGuest) return $this->goHome();
        $loginModel = new LoginForm(['scenario' => 'login']);
        $registerModel = new \common\models\User(['scenario' => 'register']);
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
            Yii::$app->session->setFlash('error', Yii::t('app/message','msg welcome back'));
            return $this->goBack();
        }
        else if ($registerModel->load(Yii::$app->request->post()) && $registerModel->Register()) {
            Yii::$app->session->setFlash('error', Yii::t('app/message','msg thanks for registration'));
            $loginModel = new LoginForm();
            Yii::$app->user->login($loginModel->getUser(), 3600 * 24 * 30);
            return $this->goBack();
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
    
    public function actionReset_password($token){
        $query = \common\models\User::findOne(['auth_key11' => $token]);
        //if(!$query){
          //  Yii::$app->session->setFlash('msg', Yii::t('app/message','msg token reset password not valid'));
            //return $this->redirect(['site/forgot_password']);
        //}
        
        $this->layout = 'login-register';
        $model = new LoginForm(['scenario' => 'forgot_password']);
        return $this->render('reset_password', [
            'model' => $model,
            'query' => $query,
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
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
        Yii::$app->mail->send(['hendarsyahss@gmail.com'],'Newsletter Vileo.co.id','newsletter',['email'=>'hendarsyahss@gmail.com']);
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
}
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
    
    public function actionHome()
    {
        
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) return $this->goHome();
        $loginModel = new LoginForm();
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
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

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    public function actionNewsletter(){
        $formModel = new \common\models\Newsletter();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->getSave()) {
            $formModel->refresh();
            Yii::$app->response->format = 'json';
            return ['success' => true,'message' => Yii::t('app/message','msg thanks your email has been registered')];
        } else {
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

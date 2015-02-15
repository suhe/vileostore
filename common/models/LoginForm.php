<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $new_password;
    public $confirm_password;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['email', 'password'], 'required','on'=>'login'],
            ['password', 'validatePassword','on'=>'login'],
            [['email'], 'required','on'=>'forgot_password'],
            [['email'], 'email','on'=>['login','forgot_password']],
            [['email'], 'validateEmailRegistered','on'=>'forgot_password'],
            [['new_password','confirm_password'], 'required','on'=>'reset_password'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app/message','incorrect username or password'));
            }
        }
    }
    
    /**
     * Custom Validation
    **/
    public function validateEmailRegistered($attribute,$params){
        if (!$this->hasErrors()) {
            $email_exists = \common\models\User::findOne(['email' => $this->email]);
            if (!$email_exists) {
                $this->addError($attribute,$params?$params:Yii::t('app/message','msg email is not exists'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = \common\models\User::findByEmail($this->email);
        }

        return $this->_user;
    }
    
    public function forgotPassword(){
        if($this->validate()){
            $data =[];
            $string = Yii::$app->store->randString(25);
            \common\models\User::updateAll(['auth_key' => $string,'auth_key_expired' => date('Y-m-d')],['email'=>$this->email]);
            Yii::$app->mail->send([$this->email],Yii::$app->params['store'].' '.Yii::t('app','forgot password'),'forgot_password',['email'=>$this->email,'auth_key' => $string]);
            return true;
        }
        return false;
    }
    
    public function resetPassword($key){
        if($this->validate()){
            $query = \common\models\User::findOne(['auth_key'=>$key]);
            $password = $this->new_password;
            $password_has = Yii::$app->security->generatePasswordHash($password);
            \common\models\User::updateAll(['auth_key' => '','auth_key_expired' => date('Y-m-d'),'password' => $password_has],['auth_key'=>$key]);
            Yii::$app->mail->send([$query->email],Yii::$app->params['store'].' '.Yii::t('app','forgot password'),'reset_password',['email' => $query->email,'password' => $password]);
            return true;
        }
        return false;
    }
}

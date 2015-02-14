<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    public $created_at;
    public $updated_at;

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return '{{%user}}';
    }
    
    /**
     * Relation
     */
    public function getDiscusion(){
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors(){
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['first_name'],'required','on'=>['register']],
            [['middle_name'],'safe','on'=>['register']],
            [['last_name'],'safe','on'=>['register']],
            [['email'],'required','on'=>['register']],
            [['password'],'required','on'=>['register']],
            [['email'],'email','on'=>['register']],
            [['email'],'validateEmailRegistered','on' =>'register'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id){
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email){
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token){
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token){
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId(){
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(){
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    /**
     * Custom Validation
    **/
    public function validateEmailRegistered($attribute,$params){
        if (!$this->hasErrors()) {
            $email_exists = $this->findOne(['email' => $this->email]);
            if ($email_exists) {
                $this->addError($attribute,$params?$params:Yii::t('app/message','email is already exists'));
            }
        }
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public function Register(){
        if($this->validate()){
            $model = new User();
            $model->first_name = $this->first_name;
            $model->middle_name = $this->middle_name;
            $model->last_name = $this->last_name;
            $model->email = $this->email;
            $model->password = Yii::$app->security->generatePasswordHash($this->password);
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            return true;
        }
        return false;
    }
    
}

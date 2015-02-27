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
    public $username;
    public $new_password;
    public $confirm_password;
    public $fullName;

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
            [['id'],'safe','on'=>['register']],
            [['first_name'],'required','on'=>['register','update_profile','update','save']],
            [['middle_name'],'safe','on'=>['register','update_profile','update','save']],
            [['last_name'],'safe','on'=>['register','update_profile','update','save']],
            [['email'],'required','on'=>['register','update','save']],
            [['group_id'],'required','on'=>['update','save']],
            [['status'],'required','on'=>['update','save']],
            [['password'],'required','on'=>['register','save']],
            [['new_password'],'required','on'=>['update_password']],
            [['email'],'email','on'=>['register','update','save']],
            [['email'],'validateEmailRegistered','on' =>['register','save']],
            [['new_password','confirm_password'],'required','on'=>['update_password']],
            [['confirm_password'],'validateNewPassword','on' =>'update_password'],
            [['username','email','status'],'safe','on'=>['search']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'new_password' => Yii::t('app','new password'),
            'confirm_password' => Yii::t('app','confirm'),
            'username' => Yii::t('app','name'),
            'group_id' => Yii::t('app','group'),
            'first_name' => Yii::t('app','first name'),
            'middle_name' => Yii::t('app','middle name'),
            'last_name' => Yii::t('app','last name'),
        ];
    }
    
    public function getFullName(){
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
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
    
    public function validateNewPassword($attribute,$params){
        if (!$this->hasErrors()) {
            if ($this->new_password!=$this->confirm_password) {
                $this->addError($attribute,$params?$params:Yii::t('app/message','msg password are not same'));
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
            $model->password_hint = $this->password;
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            
            //send email
            Yii::$app->mail->send([$this->email],Yii::$app->params['store'].' '.Yii::t('app','register account'),'register',['data'=>static::findOne($model->id)]);
            return true;
        }
        return false;
    }
    
    public function getUpdateProfile($user_id){
        if($this->validate()){
            $model = new User();
            $model = $model->findOne($user_id);
            $model->first_name = $this->first_name;
            $model->middle_name = $this->middle_name;
            $model->last_name = $this->last_name;
            $model->update();
            return true;
        }
        return false;
    }
    
    public function getUpdatePassword($user_id){
        if($this->validate()){
            $model = new User();
            $model = $model->findOne($user_id);
            $model->password = Yii::$app->security->generatePasswordHash($this->new_password);
            $model->password_hint = $this->new_password;
            return true;
        }
        return false;
    }
    
     public static function TotalUser($condition = []){
       return static::find()
        ->where($condition?$condition:'')
        ->count();
    }
    
    public function getActiveDataProviderUser($group=1,$params){
        $query = static::find()
        ->where(['group_id' => $group])
        ->select(['user.id','CONCAT(first_name,\' \',middle_name,\' \',last_name) AS username','email','DATE_FORMAT(last_login,\'%d/%m/%Y %H:%i:%s\') as last_login','status']);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
            'pagination' =>[
                'pageSize' => Yii::$app->params['show_page']
            ]    
        ]);
        
        if ((!$this->load($params)) && ($this->validate()))
            return $dataProvider;
        
        $this->username?$query->andFilterWhere(['like','CONCAT(first_name,\' \',middle_name,\' \',last_name)',$this->username]):'';
        $this->email?$query->andFilterWhere(['like','slug',$this->slug]):'';
        $this->status?$query->andFilterWhere(['status'=>$this->status]):'';
        return $dataProvider;
    }
    
    public static function dropdownStatus($All=true){
       if($All) $data[0] = Yii::t('app','all');
       $data[1] = Yii::t('app','active');
       $data[2] = Yii::t('app','non active');
       return $data;
    }
    
    public static function stringStatus($status){
        switch($status){
            case 1 : $str = Yii::t('app','active');break;
            default: $str = Yii::t('app','non active');break;   
        }
        return $str;
    }
    
    public static function dropdownGroup($All=true){
       if($All) $data[0] = Yii::t('app','all');
       $data[1] = Yii::t('app','customer');
       $data[2] = Yii::t('app','administrator');
       return $data;
    }
    
    public static function stringGroup($status){
        switch($status){
            case 1 : $str = Yii::t('app','customer');break;
            default: $str = Yii::t('app','administrator');break;   
        }
        return $str;
    }
    
    public function getSave(){
        if($this->validate()){
            $model = new User();
            $model->first_name = $this->first_name;
            $model->middle_name = $this->middle_name;
            $model->last_name = $this->last_name;
            $model->email = $this->email;
            $model->group_id = $this->group_id;
            $model->password = Yii::$app->security->generatePasswordHash($this->password);
            $model->password_hint = $this->password;
            $model->status = $this->status;
            $model->created_by = Yii::$app->user->getId();
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            return true;
        }
        return false;
    }
    
    public function getUpdate($id){
        if($this->validate()){
            $model = new User();
            $model = $model->findOne($id);
            $model->first_name = $this->first_name;
            $model->middle_name = $this->middle_name;
            $model->last_name = $this->last_name;
            $model->email = $this->email;
            $model->group_id = $this->group_id;
            $model->status = $this->status;
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
}

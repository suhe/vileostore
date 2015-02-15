<?php
namespace common\models;
use Yii;

class Newsletter extends \yii\db\ActiveRecord {
    public static function tableName(){
        return 'newsletter';
    }
    
    public function rules(){
        return [
            [['email'],'required'],
            [['email'],'email'],
            [['email'],'validateEmailRegistered'],
        ];
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
    
    public function getSave(){
        if($this->validate()){
            $model = new Newsletter();
            $model->email = $this->email;
            $model->created_date = date('Y-m-d H:i:s');
            $model->insert();
            //set email
            $data['email'] = $this->email;
            Yii::$app->mail->send([$this->email],Yii::t('app','newsletter'),'newsletter',['email' => $this->email]);
            return true;
        }
        return false;
    }
    
    
}
<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ConfirmationForm extends Model
{
    public $bank_account;
    public $bank_name;
    public $total_transfer;
    public $description;
    //public $rememberMe = true;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['bank_account', 'bank_name','total_transfer','description'], 'required','on'=>['confirm_user']],
        ];
    }
    
    public function attributeLabels(){
        return [
            'bank_account' => Yii::t('app','account'),
            'bank_name' => Yii::t('app','owner'),
            'total_transfer' => Yii::t('app','total transfer'),
            'description' => Yii::t('app','description'),
        ];
    }
    
    public function getConfirmPayment($id){
        if($this->validate()){
            $model = new \common\models\Order();
            $model = $model->findOne($id);
            $model->confirm = 3;
            $model->status = 4;
            $model->confirm_account = $this->bank_account;
            $model->confirm_owner = $this->bank_name;
            $model->confirm_total =str_replace(",","",$this->total_transfer);
            $model->updated_by = Yii::$app->user->getId();
            $model->updated_date = date('Y-m-d H:i:s');
            $model->update();
            return true;
        }
        return false;
    }
    
    
}

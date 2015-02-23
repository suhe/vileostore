<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * CartForm is the model behind the shopping Cart Generate 
 */
class CartForm extends Model{
    public $qty = [];
    //public $rowid = [];
    
    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['qty'],'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'qty' => Yii::t('app','quantity'),
        ];
    }

}

<?php
namespace common\helpers;

public $assets='assets';

class Html extends \yii\web\Request {
    public function asset($file){
	return $this->baseUrl()./.$this->assets.'/'.$file;
    }
}
<?php
namespace backend\controllers;

use Yii;


/**
 * Category controller
 */
class CategoryController extends \yii\web\Controller {

    public function actionPart($id){
        $this->layout = 'category';
        return $this->render('index');
    }

}

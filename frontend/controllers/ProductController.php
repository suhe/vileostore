<?php
namespace frontend\controllers;

use Yii;


/**
 * Category controller
 */
class ProductController extends \yii\web\Controller {

    public function actionCategory($id){
        $model = new \common\models\ProductCategory();
        $this->layout = 'category';
        return $this->render('category-grid',[
            'model' => $model,
            'query' => $model->getAllQueryWithPagination($id)
        ]);
    }
    
    public function actionRead($id){
        $model = new \common\models\Product();
        $this->layout = 'single';
        return $this->render('product_detail',[
            'model' => $model,
            'data'  => $model->findOne($id),
            'images' => \common\models\ProductImage::find()->where(['product_id' => $id])->all()
        ]);
    }

}

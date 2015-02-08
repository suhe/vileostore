<?php
namespace frontend\controllers;

use Yii;


/**
 * Category controller
 */
class ProductController extends \yii\web\Controller {
    public function actionCategory($id,$view='list'){
        $model = new \common\models\ProductCategory();
        $this->layout = 'category';
        
        $query = $model->getAllQueryWithPagination($id,Yii::$app->request->QueryParams);
        $countQuery = clone $query; //coun total query
        //pagination total count and pagesize
        $pages = new \yii\data\Pagination([
            'pageSizeParam' => 'show',
            'totalCount' => $countQuery->count(),
            'pageSize' => isset(Yii::$app->request->QueryParams['show'])?Yii::$app->request->QueryParams['show']:Yii::$app->params['show_page'],
            'params' => array_merge($_GET),
            //'params' => array_merge($_GET, ['#' => 'my-hash']),
        ]);
        
        $query = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('category',[
            'model' => $model,
            'category' => \common\models\Category::findOne($id),
            'query' => $query,
            'pages' => $pages,
            'view' => $view,
            'gridView' => 'category-grid',
            'listView' => 'category-list',
        ]);
    }
    
    public function actionRead($id){
        $formModel = new \common\models\Discusion(['scenario' => 'comment']);
        
        //action request post
        if($formModel->load(Yii::$app->request->post()) && $formModel->getSave($id)){
            $formModel->refresh();
            Yii::$app->response->format = 'json';
            return ['success' => true,'name' => 'Naomi','comment' => $formModel->description,'date' => Yii::t('app','1 second ago')];
        }
        
        $this->layout = 'single';
        $category = \common\models\ProductCategory::findOne(['product_id' => $id]);
        return $this->render('product_detail',[
            'formModel' => $formModel,
            'data' => \common\models\Product::findOne($id),
            'category' => \common\models\Category::findOne($category->category_id),
            'discusion' => \common\models\Discusion::getDiscusionByProduct($id),
            'images' => \common\models\ProductImage::find()->where(['product_id' => $id])->all()
        ]);
    }

}

<?php
namespace backend\controllers;
use Yii;

/**
 * Category controller
 */
class ProductController extends \yii\web\Controller {
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Product(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderProduct(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionUpdate_information($id=0){
        $model = new \common\models\Product(['scenario' => 'save_information']);
        if($model->load(Yii::$app->request->post()) && ($id=$model->getUpdateInformation($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','save new product has been succcesffuly'));
            $this->redirect(['product/update_options','id'=>$id]);
        }
        
        //update $model
        $query = \common\models\Product::findOne($id);
        if($query){
            $model->name = $query->name;
            $model->sku = $query->sku;
            $model->short_description = $query->short_description;
            $model->long_description = $query->long_description;
            $model->weight = $query->weight;
            $model->category_id = $query->category_id;
            $model->brand_id = $query->brand_id;
        }
        //update $model
        
        return $this->render('form_main',[
            'model' => $model,
            'form'  => 'form_information',
        ]);
    }
    
    public function actionUpdate_options($id){
        $query = \common\models\Product::findOne($id);
        if(!$query) $this->redirect(['product/index']);
        
        $model = new \common\models\Product(['scenario' => 'update_options']);
        if($model->load(Yii::$app->request->post()) && ($id=$model->getUpdateOptions($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update product has been succcesffuly'));
            $this->redirect(Yii::$app->request->referrer);
        }
        
        //update $model
        $model->stock = $query->stock;
        $model->price = $query->price;
        $model->arrival_date = Yii::$app->formatter->asDate($query->arrival_date,'php:d/m/Y');
        $model->status = $query->status;
        $model->online = $query->online;
        $model->cod = $query->cod;
        $model->dropshier = $query->dropshier;
        //update $model
        
        return $this->render('form_main',[
            'model' => $model,
            'form'  => 'form_options',
        ]);
    }
    
    public function actionUpdate_image($id){
        $query = \common\models\Product::findOne($id);
        if(!$query) $this->redirect(['product/index']);
        
        $model = new \common\models\ProductImage(['scenario' => 'update_image']);
        if($model->load(Yii::$app->request->post()) && ($id=$model->getUpdateOptions($id))){
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update product has been succcesffuly'));
        }
        
        return $this->render('form_main',[
            'model' => $model,
            'form'  => 'form_images',
            'dataProvider' => $model->getActiveDataProviderImage($id)
        ]);
    }
    
    public function actionImage(){
        $ds          = DIRECTORY_SEPARATOR; 
        $storeFolder = Yii::getAlias('@webroot/assets/products');   
        $result  = array();
        $files = scandir($storeFolder);
        if ( false!==$files) {
            foreach($files as $file) {
                if ( '.'!=$file && '..'!=$file) {    
                    $obj['name'] = $file;
                    $obj['size'] = filesize($storeFolder.$ds.$file);
                    $result[] = $obj;
                }
            }
        }
        
        header('Content-type: text/json');              
        header('Content-type: application/json');
        echo json_encode($result);
    }
    
    public function actionUpdate_category($id){
        $query = \common\models\Product::findOne($id);
        if(!$query) $this->redirect(['product/index']);
        
        $model = new \common\models\ProductCategory(['scenario' => 'update_category']);
        if(Yii::$app->request->post()){
            //delete from produk
            \common\models\ProductCategory::deleteAll('product_id = :id ',[':id' => $id]);
            $category = Yii::$app->request->post('category_id');
            $count = count($category);
            for($i=0;$i<$count;$i++){
                $model = new \common\models\ProductCategory();
                $model->category_id = $category[$i];
                $model->product_id = $id;
                $model->insert();
            }
            //Output Query
            Yii::$app->session->setFlash('msg',Yii::t('app/message','update product category has been succcesffuly'));
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        return $this->render('form_main',[
            'model' => $model,
            'form'  => 'form_category',
        ]);
    }

}
<?php
namespace backend\controllers;
use Yii;

/**
 * Category controller
 */
class OrderController extends \yii\web\Controller {
    
    public function actions(){
        if(Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    
    public function actionIndex(){
        $model = new \common\models\Order(['scenario' => 'search']);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $model->getActiveDataProviderOrder(Yii::$app->request->queryParams)
        ]);
    }
    
    public function actionSummary($id){
        $model = new \common\models\Order(['scenario' => 'summary']);
        if(!$query = $model->findOne($id))
            return $this->redirect(['order/index']);
        
        return $this->render('summary',[
            'model' => $model,
            'view'  => 'summary_information',
            'data'  => $model->getSingleOrder($id)
        ]);
    }
    
    public function actionInvoice($id){
        $model = new \common\models\Order(['scenario' => 'summary']);
        if(!$query = $model->findOne($id))
            return $this->redirect(['order/index']);
        
        return $this->render('summary',[
            'model' => $model,
            'view'  => 'summary_invoice',
            'data'  => $model->getSingleOrder($id)
        ]);
    }
    
    public function actionUpdate_image($id){
        $query = \common\models\Product::findOne($id);
        if(!$query) $this->redirect(['product/index']);
        
        $model = new \common\models\Product(['scenario' => 'update_image']);
        //relational to main image
        $images = \common\models\ProductImage::findOne(['name' => $query->image]);
        $model->image = $images->id;
        return $this->render('form_main',[
            'model' => $model,
            'form'  => 'form_images'
        ]);
    }
    
    public function actionDefault_image($id){
        if(isset($_POST['id'])){
            $query = \common\models\ProductImage::findOne($_POST['id']);
            Yii::$app->response->format = 'json';
            if($query){
                $model = new \common\models\Product();
                $model = $model->findOne($id);
                $model->image = $query->name;
                $model->update();
                return [
                    'success' => true,
                    'message' => Yii::t('app/message','msg main image has been changed'),
                ];
            } else {
                return [
                    'success' => false,
                    'message' => Yii::t('app/message','msg error compile main image')
                ];
            }
        }
    }
    
    public function actionImage($id){
        $ds = DIRECTORY_SEPARATOR;
        $fileName = 'file';
        $storeFolder = Yii::getAlias('@image_product/'.$id);
        
        if (isset($_FILES[$fileName])){
            \yii\helpers\FileHelper::createDirectory($storeFolder,777,true);
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);
            if ($file->saveAs($storeFolder.'/'.$file->name)) {
                /** Insert Image to Database**/
                $model = new \common\models\ProductImage();
                $model->product_id = $id;
                $model->name = $file->name;
                $model->created_by = Yii::$app->user->getId();
                $model->created_date = date('Y-m-d H:i:s');
                $model->insert();
                echo \yii\helpers\Json::encode($file);
            }
            return true;
        }
        
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
    
    public function actionRemove_image($id){
        $storeFolder = Yii::getAlias('@image_product/'.$id);
        $image = $_POST['name'];
        $remove = unlink($storeFolder.'/'.$image);
        Yii::$app->response->format = 'json';
        if($remove){
            $deleteImage = \common\models\ProductImage::deleteAll('product_id = :id AND name = :name',[':id' => $id,':name' => $image]);
            return [
                'success' => true,
                'message' => Yii::t('app/message','data has been removed from server & database')
            ];
        }
        else {
            return [
                'success' => false,
                'message' => Yii::t('app/message','failed remove image from server & database')
            ];
        }
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
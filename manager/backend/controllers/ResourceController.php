<?php

namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use backend\components\CController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class ResourceController extends CController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $where = " and type = 2";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())  && $model->validate() ) {
            $params = Yii::$app->request->post();
            /*var_dump($params);
            exit();
            $content = $params['editorValue'];
            $model->content = $content;*/
            $model->type = 2;
            $model->pic = UploadedFile::getInstance($model, 'pic');
            if($model->pic){
                //文件上传成功
                //return;
                $filename = $model->upload();
                $model->pic = $filename;
            }
            $datetime = Yii::$app->request->post('datetime')!==null?Yii::$app->request->post('datetime'):time();
            //exit();
            $model->datetime = strtotime($datetime);
            $model->save();
            //var_dump($model->errors);
            //exit();
            return $this->redirect(['index']);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pic = $model->pic;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->pic = UploadedFile::getInstance($model, 'pic');
            if($model->pic){
                //文件上传成功
                //return;
                $filename = $model->upload();
                $model->pic = $filename;
            }else{
                $model->pic = $pic;
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model['is_delete'] = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelimg($id)
    {
        $model=$this->findModel($id);
        $base_dir = Yii::$app->basePath;
        if($model->pic && is_file($base_dir.$model->pic)){
            unlink($base_dir.$model->pic);
            $model->pic = '';
            $model->save();
            //Yii::$app->session->setFlash('msg','删除直播图片成功！');
            
        }
        //var_dump($model->getErrors());die;
        return $this->redirect(['update','id'=>$model->id]);
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\Plan;
use backend\models\PlanSearch;
use backend\models\Lession;
use backend\models\Teacher;
use backend\components\CController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use dosamigos\qrcode\QrCode;
use yii\helpers\Url;

/**
 * PlanController implements the CRUD actions for Plan model.
 */
class PlanController extends CController
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
     * Lists all Plan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tabletype=Yii::$app->params['tabletype'];
        $lessionarr=ArrayHelper::map(Lession::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        $teacherarr=ArrayHelper::map(Teacher::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tabletype' => $tabletype,
            'lession' => $lessionarr,
            'teacher' => $teacherarr,
        ]);
    }

    /**
     * Displays a single Plan model.
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
     * Creates a new Plan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Plan();
        $tabletype=Yii::$app->params['tabletype'];
        $lessionarr=ArrayHelper::map(Lession::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        $teacherarr=ArrayHelper::map(Teacher::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        //var_dump($tabletype);
        //exit();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->img = UploadedFile::getInstance($model, 'img');
            if($model->img){
                //文件上传成功
                //return;
                $filename = $model->upload();
                $model->img = $filename;
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tabletype' => $tabletype,
                'lession' => $lessionarr,
                'teacher' => $teacherarr,
            ]);
        }
    }

    /**
     * Updates an existing Plan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img = $model->img;
        $tabletype=Yii::$app->params['tabletype'];
        $lessionarr=ArrayHelper::map(Lession::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        $teacherarr=ArrayHelper::map(Teacher::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->img = UploadedFile::getInstance($model, 'img');
            if($model->img){
                //文件上传成功
                //return;
                $filename = $model->upload();
                $model->img = $filename;
            }else{
                $model->img = $img;
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tabletype' => $tabletype,
                'lession' => $lessionarr,
                'teacher' => $teacherarr,
            ]);
        }
    }

    /**
     * Deletes an existing Plan model.
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
     * Finds the Plan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Plan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelimg($id)
    {
        $model=$this->findModel($id);
        $base_dir = Yii::$app->basePath;
        if($model->img && is_file($base_dir.$model->img)){
            unlink($base_dir.$model->img);
            $model->img = '';
            $model->save();
            //Yii::$app->session->setFlash('msg','删除直播图片成功！');
            
        }
        //var_dump($model->getErrors());die;
        return $this->redirect(['update','id'=>$model->id]);
    }


    public function actionQrcode() 
    {
        //$tabletype=Yii::$app->params['tabletype'];
        //$id=Yii::$app->params['id'];
        $request = Yii::$app->request;
        $id = $request->get('id');
        $tabletype = $request->get('tabletype');
        $push_url = Url::to(['live/wap','id'=>$id,'tabletype'=>$tabletype]);
        $url = "/wap/index.php/baoming/plandetail/id/".$id."/tabletype/".$tabletype;
        $role_name = Yii::$app->user->identity->role_name;
        $zs_id = Yii::$app->user->identity->id;
        if($role_name == 'zhaosheng'){
            $url .="/userid/".$zs_id;
        }
        $push_url = Yii::$app->request->hostInfo.$url;
        //echo $push_url;
        //exit();
        return QrCode::png($push_url,false,0,10);    //调用二维码生成方法
    }

    public function actionTest(){
        exit('test');
    }
}

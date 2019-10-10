<?php

namespace backend\controllers;

use Yii;
use backend\models\ItemsPreset;
use backend\models\ItemsPresetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;

/**
 * ItemsPresetController implements the CRUD actions for ItemsPreset model.
 */
class ItemsPresetController extends CController
{
    public function init(){
        parent::init();
        $this->subject = '视频转码设置';
    }
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
     * Lists all ItemsPreset models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsPresetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemsPreset model.
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
     * Creates a new ItemsPreset model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemsPreset();
        if ($model->load(Yii::$app->request->post())){
            $data=Yii::$app->request->post();
            $arr_cen=array('sd','hd','shd');
            $arr_type=array('Mp4','Flv','Hls');
            $post_data=array('presetName'=>$data['ItemsPreset']['presetName']);
            foreach ($arr_cen as $key => $value) {
                $is=0;
                if(in_array($value,$data['format']))
                    $is=1;
                foreach ($arr_type as $key1 => $value1) {
                    $post_data[$value.$value1]=$is;
                }
            }
            $url='https://vcloud.163.com//app/vod/preset/create';
            $return=getLiveByCURL($url,$post_data);
            $msg='添加视频转码失败！';
            if(!empty($return)){
                $arr=json_decode($return,true);
                if($arr['code']==200){
                      $model->attributes=$post_data;
                      $model->presetId=$arr['ret']['presetId'];
                      $model->save();
                      Yii::$app->session->setFlash('msg','添加视频转码成功！');
                      return $this->redirect(['index']);
                }else{
                    $msg.=$arr['msg'];
                }
            }
            Yii::$app->session->setFlash('msg',$msg);      
        } 
        return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing ItemsPreset model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())){
            $data=Yii::$app->request->post();
            $arr_cen=array('sd','hd','shd');
            $arr_type=array('Mp4','Flv','Hls');
            $post_data=array('presetName'=>$data['ItemsPreset']['presetName'],'presetId'=>$model->presetId);
            foreach ($arr_cen as $key => $value) {
                $is=0;
                if(in_array($value,$data['format']))
                    $is=1;
                foreach ($arr_type as $key1 => $value1) {
                    $post_data[$value.$value1]=$is;
                }
            }
            $url='https://vcloud.163.com//app/vod/preset/update';
            $return=getLiveByCURL($url,$post_data);
            $msg='修改视频转码失败！';
            if(!empty($return)){
                $arr=json_decode($return,true);
                if($arr['code']==200){
                      $model->attributes=$post_data;
                      $model->save();
                      Yii::$app->session->setFlash('msg','修改视频转码成功！');
                      return $this->redirect(['index']);
                }else{
                    $msg.=$arr['msg'];
                }
            }
            Yii::$app->session->setFlash('msg',$msg);      
        } 
        return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing ItemsPreset model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $is_exists=1;
        $num1=0;
        $num2=0;
        $arr=array();
        if(Yii::$app->request->isGet){
            $presetId=Yii::$app->request->get('presetId');
            $model=ItemsPreset::findOne($presetId);
            if($model->is_exists)  //存在，将外网的删除
                $arr[]=$presetId;
            else{                   //不存在，将内网的删除
                $model->is_delete=1;
                $model->save();
                $is_exists=0;
            }
        }else if(Yii::$app->request->isPost){
            $arr=Yii::$app->request->post('ckbox');
        }
        if(!empty($arr)&&$is_exists){
            foreach ($arr as $key => $value) {
                $model=$this->findModel($value);
                if(!$model||!$model->is_exists)
                    continue;
                $url='https://vcloud.163.com/app/vod/preset/presetDelete';
                $post_data =array('presetId'=>$model->presetId);
                $return=getLiveByCURL($url,$post_data);
                if(!empty($return)){
                    $arr=json_decode($return,true);
                    if($arr['code']==200){
                        $model->is_exists=0;
                        $model->is_delete=1;
                        $model->save();
                        $num1=1;
                    }else{
                        $num2=1;
                    }
                }
                
            }
            $msg='删除视频转码成功！';
            if($num1&&$num2)
                $msg='部分视频转码删除成功！';
            else if($num2&&!$num1)
                $msg='删除视频转码失败！';
            Yii::$app->session->setFlash('msg',$msg);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemsPreset model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemsPreset the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemsPreset::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     //数据同步
    public function actionCommon()
    {
        $url='https://vcloud.163.com/app/vod/preset/list';
        $post_data =array('currentPage'=>0,'pageSize'=>'-1'); //不用分页
        $return=getLiveByCURL($url,$post_data);
        if(!empty($return)){
            $ret=json_decode($return,true);
            if($ret['code']==200){
                ItemsPreset::updateAll(['is_exists'=>0]);
                foreach ($ret['ret']['list'] as $key => $value) {
                    $model=ItemsPreset::findOne($value['presetId']);
                    if(!$model)
                        $model=new ItemsPreset();
                   $model->attributes=$value;
                   $model->is_exists=1;
                   $model->save();
                }

            }
        }
        Yii::$app->session->setFlash('msg','数据同步成功！');
        return $this->redirect(['index']);
    }
}

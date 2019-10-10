<?php

namespace backend\controllers;
use Yii;
use backend\models\ItemsType;
use backend\models\ItemsTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;


/**
 * ItemsTypeController implements the CRUD actions for ItemsType model.
 */
class ItemsTypeController extends CController
{
    public function init(){
        parent::init();
        $this->subject = '分类设置';
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get','post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ItemsType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemsType model.
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
     * Creates a new ItemsType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemsType();
        if ($model->load(Yii::$app->request->post())){
            $url='https://vcloud.163.com/app/vod/type/create';
            $post_data =array('typeName'=>$model->typeName,'description'=>$model->desc);
            $return=getLiveByCURL($url,$post_data);
            $msg='添加视频分类失败！';
            if(!empty($return)){
                $arr=json_decode($return,true);
                if($arr['code']==200){
                      $ret=$arr['ret'];
                      $model->typeId=$ret['typeId'];
                      $model->save();
                      Yii::$app->session->setFlash('msg','添加视频分类成功！');
                      //再查询一遍，因创建时只返回了typeId,其它字段为空
                      $url='https://vcloud.163.com/app/vod/type/get';
                      $post_data =array('typeId'=>$ret['typeId']);
                      $return=getLiveByCURL($url,$post_data);
                      $arr=json_decode($return,true);
                      if($arr['code']==200){
                          $ret=$arr['ret'];
                          $model->attributes=$ret;
                          $model->save();
                      }
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
     * Updates an existing ItemsType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())){
            $url='https://vcloud.163.com/app/vod/type/update';
            $post_data =array('typeName'=>$model->typeName,'description'=>$model->desc,'typeId'=>$model->typeId);
            $return=getLiveByCURL($url,$post_data);
            $msg='更新视频分类失败！';
            if(!empty($return)){
                $arr=json_decode($return,true);
                if($arr['code']==200){
                      $model->save();
                      Yii::$app->session->setFlash('msg','更新视频分类成功！');
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
     * Deletes an existing ItemsType model.
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
            $typeId=Yii::$app->request->get('typeId');
            $model=$this->findModel($typeId);
            if($model->is_exists)  //存在，将外网的删除
                $arr[]=$typeId;
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
                $model=ItemsType::findOne($value);
                if(!$model||!$model->is_exists)
                    continue;
                $url='https://vcloud.163.com/app/vod/type/typeDelete';
                $post_data =array('typeId'=>$model->typeId);
                $return=getLiveByCURL($url,$post_data);
                $msg='';
                if(!empty($return)){
                    $arr=json_decode($return,true);
                    if($arr['code']==200){
                        $model->is_exists=0;
                        $model->is_delete=1;
                        $model->save();
                        $num1=1;
                    }else{
                        $num2=1;
                        $msg.=$arr['msg'];
                    }
                }  
            }
            if($num1&&$num2)
                $msg='部分视频分类删除成功！';
            else if($num1&&!$num2){
                $msg='删除视频分类成功！';
            }
            Yii::$app->session->setFlash('msg',$msg);
        }
        return $this->redirect(['index']);
      }

    /**
     * Finds the ItemsType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemsType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemsType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     //数据同步
    public function actionCommon()
    {
        $url='https://vcloud.163.com/app/vod/type/list';
        $post_data =array('currentPage'=>0,'pageSize'=>'-1'); //不用分页
        $return=getLiveByCURL($url,$post_data);
        if(!empty($return)){
            $ret=json_decode($return,true);
            if($ret['code']==200){
                ItemsType::updateAll(['is_exists'=>0]);
                foreach ($ret['ret']['list'] as $key => $value) {
                    $model=ItemsType::findOne($value['typeId']);
                    if(!$model)    //无则添加
                        $model=new ItemsType();
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

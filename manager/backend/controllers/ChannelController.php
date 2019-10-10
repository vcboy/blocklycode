<?php

namespace backend\controllers;

use Yii;
use backend\models\channel;
use backend\models\ChannelSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;

/**
 * ChannelController implements the CRUD actions for channel model.
 */
class ChannelController extends CController
{
    public function init(){
        parent::init();
        $this->subject = '频道管理';
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'   => ['*'],
                        'allow'     => true,
                        'roles'     => ['@'],   //其中？代表游客，@代表已登录的用户。
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get','post'],
                ],
            ],
        ];
    }

    /**
     * Lists all channel models.
     * @return mixed
     * 查询频道列表
     */
    public function actionIndex()
    {
        $searchModel = new ChannelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new channel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new channel();
        if ($model->load(Yii::$app->request->post())) {
            $url='https://vcloud.163.com/app/channel/create';
            $post_data =array('name'=>$model->name,'type'=>0);
            $return=getLiveByCURL($url,$post_data);
            $msg='添加频道失败！';
            if(!empty($return)){
                $arr=json_decode($return,true);
                if($arr['code']==200){
                      $ret=$arr['ret'];
                      $model->cid=$ret['cid'];
                      $model->ctime=$ret['ctime'];
                      $model->push_url=$ret['pushUrl'];
                      $model->http_pull_url=$ret['httpPullUrl'];
                      $model->hls_pull_url=$ret['hlsPullUrl'];
                      $model->rtmp_pull_url=$ret['rtmpPullUrl'];
                      $model->save();
                      Yii::$app->session->setFlash('msg','添加频道成功！');
                      return $this->redirect(['index']);
                }else{
                    $msg.=$arr['msg'];
                }
            }
            Yii::$app->session->setFlash('msg',$msg);  
        } 
        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing channel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $url='https://vcloud.163.com/app/channel/update';
            $post_data =array('name'=>$model->name,'cid'=>$model->cid,'type'=>0);
            $return=getLiveByCURL($url,$post_data);
            $msg='修改频道名称失败！';
            if(!empty($return)){
                $arr=json_decode($return,true);
                if($arr['code']==200){
                      $model->save();
                      Yii::$app->session->setFlash('msg','修改频道名称成功！');
                      return $this->redirect(['index']);
                }else
                    $msg='修改失败！'.$arr['msg'];
            }
            Yii::$app->session->setFlash('msg',$msg);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing channel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        $is_exists=1;
        $num1=0;
        $num2=0;
        $arr=array();
        if(Yii::$app->request->isGet){
            $cid=Yii::$app->request->get('cid');
            $model=$this->findModel($cid);
            if($model->is_exists)  //存在，将外网的删除
                $arr[]=$cid;
            else{                   //不存在，将内网的删除
                $courses=$model->getCourse()->all();
                if(!empty($courses)){
                    $model->is_delete=1;
                    $model->save();
                    $is_exists=0;
                }else{
                   Yii::$app->session->setFlash('msg','删除失败，该频道下有课程！');
                }
                
            }
        }else if(Yii::$app->request->isPost){
            $arr=Yii::$app->request->post('ckbox');
        }
        if(!empty($arr)&&$is_exists){
            $has_course=0;
            foreach ($arr as $key => $value) {
                $model=$this->findModel($value);
                if(!$model->is_exists)
                    continue;
                $courses=$model->getCourse()->all();
                if(!empty($courses)){
                    Yii::$app->session->setFlash('msg','删除失败，该频道下有课程！');
                    $has_course=1;
                    break;
                }
                $url='https://vcloud.163.com/app/channel/delete';
                $post_data =array('cid'=>$model->cid);
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
            if(!$has_course){
                 $msg='删除频道成功！';
                if($num1&&$num2)
                    $msg='部分频道执行删除成功！';
                else if($num2&&!$num1)
                    $msg='删除频道失败！';
                Yii::$app->session->setFlash('msg',$msg);
            }
           
        }
        return $this->redirect(['index']);
    }

    /**
     * Displays a single channel model.
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
     * Finds the channel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return channel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
       
        if (($model = channel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     //数据同步
    public function actionCommon()
    {
        $url='https://vcloud.163.com/app/channellist';
        $post_data =array('records'=>100);
        $return=getLiveByCURL($url,$post_data);
        if(!empty($return)){
            $ret=json_decode($return,true);
            if($ret['code']==200){
                Channel::updateAll(['is_exists'=>0]);
                foreach ($ret['ret']['list'] as $key => $value) {
                    $model=Channel::findOne($value['cid']);
                    if($model){    //有则更新
                           $model['ctime']=$value['ctime'];
                           $model['name']=$value['name'];
                           $model['status']=$value['status'];
                           $model['type']=$value['type'];
                           $model['uid']=$value['uid'];
                           $model['need_record']=$value['needRecord'];
                           $model['format']=$value['format'];
                           $model['duration']=$value['duration'];
                           $model['filename']=$value['filename'];
                           $model['is_exists']=1;
                           $model->save();
                    }else{         //无则添加
                           $model=new Channel();
                           //获取地址
                           $url='https://vcloud.163.com/app/address';
                           $post_data =array('cid'=>$value['cid']);
                           $return=getLiveByCURL($url,$post_data);
                           if(!empty($return)){
                                $ret=json_decode($return,true);
                                if($ret['code']==200){
                                    $cont=$ret['ret'];
                                    $model->push_url=$cont['pushUrl'];
                                    $model->http_pull_url=$cont['httpPullUrl'];
                                    $model->hls_pull_url=$cont['hlsPullUrl'];
                                    $model->rtmp_pull_url=$cont['rtmpPullUrl'];
                                }
                            }
                           $model['cid']=$value['cid'];
                           $model['ctime']=$value['ctime'];
                           $model['name']=$value['name'];
                           $model['status']=$value['status'];
                           $model['type']=$value['type'];
                           $model['uid']=$value['uid'];
                           $model['need_record']=$value['needRecord'];
                           $model['format']=$value['format'];
                           $model['duration']=$value['duration'];
                           $model['filename']=$value['filename'];
                           $model['is_exists']=1;
                           $model->save();
                    }
                }

            }
        }
        Yii::$app->session->setFlash('msg','数据同步成功！');
        return $this->redirect(['index']);
    }

    public function actionAddress($id)
    {
       $model=$this->findModel($id);
       if($model->is_exists){ //
            //获取地址
           $url='https://vcloud.163.com/app/address';
           $post_data =array('cid'=>$model['cid']);
           $return=getLiveByCURL($url,$post_data);
           if(!empty($return)){
                $ret=json_decode($return,true);
                if($ret['code']==200){
                    $cont=$ret['ret'];
                    $model->push_url=$cont['pushUrl'];
                    $model->http_pull_url=$cont['httpPullUrl'];
                    $model->hls_pull_url=$cont['hlsPullUrl'];
                    $model->rtmp_pull_url=$cont['rtmpPullUrl'];
                    $model->save();
                }
            }
       }
        return $this->render('address',[
            'model' => $model,
        ]);
    }

    //禁用与恢复
    public function actionDisabled(){
        $title='禁用';
        $add='pause';
        $status=2;
        $status=Yii::$app->request->get('status');
        $num1=0;
        $num2=0;
        if(empty($status)){
            $add='resume';
            $title='恢复';
            $status=0;
        }
        $arr=array();
        if(Yii::$app->request->isGet){
            $cid=Yii::$app->request->get('cid');
            $arr[]=$cid;
        }else if(Yii::$app->request->isPost){
            $arr=Yii::$app->request->post('ckbox');
        }
        if(!empty($arr)){
            foreach ($arr as $key => $value) {
                $model = $this->findModel($value);
                if($model->status==$status)
                    continue;
                $url='https://vcloud.163.com/app/channel/'.$add;
                $post_data =array('cid'=>$model->cid);
                $return=getLiveByCURL($url,$post_data);
                if(!empty($return)){
                    $arr=json_decode($return,true);
                    if($arr['code']==200){
                          $model->status=$status;
                          $model->update();
                          $num1=1;
                    }else{
                        $num2=1;
                    }
                }
            }
            $msg=$title.'频道成功！';
            if($num1&&$num2)
                $msg='部分频道'.$title.'执行成功！';
            else if($num2&&!$num1)
                $msg=$title.'频道失败！';
             Yii::$app->session->setFlash('msg',$msg);
        }
        else
            Yii::$app->session->setFlash('msg',$title.'频道失败！');
        return $this->redirect(['index']);
    }

    //直播
    public function actionLive($cid){
        return $this->render('live',array('model'=>$this->findModel($cid)));

    }

    //录制
    public function actionRecord($cid){
        $model=$this->findModel($cid);
        if(Yii::$app->request->isPost){
            $data=Yii::$app->request->post('Channel');
            $url='https://vcloud.163.com/app/channel/setAlwaysRecord';
            $post_data =array('cid'=>$model['cid'],'needRecord'=>$data['need_record'],'format'=>$data['format']);
            //if($data['need_record']){
                 if(trim($data['filename'])){
                    $post_data=array_merge($post_data,array('filename'=>trim($data['filename'])));
                    $model['filename']=trim($data['filename']);
                 }else{
                    $post_data=array_merge($post_data,array('filename'=>trim($model['name'])));
                    $model['filename']=trim($model['name']);
                 }
                 if(trim($data['duration'])){
                    $post_data=array_merge($post_data,array('duration'=>trim($data['duration'])));
                    $model['duration']=trim($data['duration']);
                 }else{
                    $post_data=array_merge($post_data,array('duration'=>120));
                 }   
           
           //}
            $return=getLiveByCURL($url,$post_data);
            $msg='录制设置失败！';
            if(!empty($return)){
                $ret=json_decode($return,true);
                if($ret['code']==200){
                    $model->need_record=$data['need_record'];
                    $model->format=$data['format'];
                    $model->save();
                    Yii::$app->session->setFlash('msg','录制设置成功！');
                    return $this->redirect(['index']);
                }else{
                    $msg.=','.$ret['msg'];
                }
            }
            Yii::$app->session->setFlash('msg',$msg);
           return $this->redirect(['index']);

        }
        return $this->render('record',array('model'=>$model));

    }



    
}

<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\Course;
use backend\models\CourseSearch;
use yii\web\Controller;
use backend\models\Platform;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\components\CController;
use dosamigos\qrcode\QrCode;
use yii\helpers\Url;
/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends CController
{
    public function init(){
        parent::init();
        $this->subject = '直播管理';
    }
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'   => ['apicreate', 'apiprohibit'],
                        'allow'     => true,
                    ],
                    [
                        'actions'   => ['view', 'index','create'],
                        'allow'     => true,
                        'roles'     => ['@'],   //其中？代表游客，@代表已登录的用户。
                    ],
                ],
            ],*/
            'access' => [
                'class' => AccessControl::className(),
                //'except' =>['apicreate','apiprohibit'],
                'rules' => [
                    [
                        'actions' => ['apicreate','apiprohibit'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions'   => ['view', 'index','create','update','qrcode','delete','delimg','apiprohibit'],
                        'allow'     => true,
                        'roles'     => ['@'],   //其中？代表游客，@代表已登录的用户。
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $arr=ArrayHelper::map(Platform::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'channel_list' =>$arr,
        ]);
    }

    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $is=1;
        $arr=ArrayHelper::map(Platform::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        $model = new Course();
        if ($model->load(Yii::$app->request->post())&&$model->validate()) {
            $type_list = array('jpg','jpeg','gif','png');
            sort($type_list);
            $multi_info=$_FILES; //接收$_FILES的全部上传信息
            $up_info=array(
                'name'=>$multi_info['Course']['name']['img'],
                'type'=>$multi_info['Course']['type']['img'],
                'tmp_name'=>$multi_info['Course']['tmp_name']['img'],
                'size'=>$multi_info['Course']['size']['img'],
                'error'=>$multi_info['Course']['error']['img']
            );
            $base_dir = Yii::$app->basePath;
            $add_dir="/upload_files/course_resource";
            $to_path = $base_dir.$add_dir;
            if(!is_dir($to_path))
                $this->createDir($to_path,$to_path);
            $error = array();
            //函数使用方法如下
            $flag=true;
            if(empty($up_info['name'])){
                $model->addError('img','上传文件不能为空');
                $flag = false;
                $is=0;
            }
            if($flag) {
                $results= $this->upload_fun($up_info,$to_path,$type_list); //调用单文件上传函数
                if($results['flag']=="right"){
                    $etime = $model->live_end_time;
                    $starttime = strtotime($model->live_start_time);
                    $endtime = strtotime($model->live_end_time);
                    $model->img=$add_dir.'/'.$results['info'];
                    $model->create_time=time();
                    $model->live_start_time=$starttime;
                    $model->live_end_time=$endtime;
                    /*Yii::$app->request->post('live_end_time');*/
                    /*echo $etime;
                    exit();*/
                    //从$char中获取字符，随机生成字符串$streamID
                    //$endtime = strtotime($endtime);
                    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
                    $streamId = '';
                    for ($i = 0; $i < 21; $i++) {
                        $streamId .= $chars[mt_rand(0, strlen($chars) - 1)];
                    }
                    $bizId = Yii::$app->params['bizId'];    //腾讯云bizId
                    $pushkey = Yii::$app->params['pushkey'];    //推流防盗链Key
                    $push_params = $this->getPushUrl($bizId, $streamId, $pushkey, $starttime, $etime);

                    /*echo $push_params['livecode'];
                    exit();*/
                    //$get_url = $this->getPlayUrl($bizId, $streamId);
                    $model->streamId = $push_params['streamId'];
                    $model->upstream_url_params = $push_params['upstream_url_params'];
                    //$model->status = 0;
                    $model->save();
                    //var_dump($model->getErrors());die;
                    /* $bizId = '7947';                                 
                    $pushkey = 'cd1ccbfcd9fcbcb7616b8c8bc26d20b8';    */    
                    //'7947'是腾讯云视频直播后台的一个bizid参数
                    //$push_url 推流地址(主播推流给服务器的地址),存入live_channel_detail表中
                    //$get_url   观众的观看地址(服务器拉流给观众的地址)

                    
                    

                    Yii::$app->session->setFlash('msg','添加直播成功！');
                    return $this->redirect(['index']);   
                } else {
                    //$error['resource'] = $results['info'];
                    Yii::$app->session->setFlash('msg','添加直播失败！');
                    $model->addError('img', $results['info']);
                     $is=0;
                }
            }
            
        }else{
            $is=0;
        }
        if($is){
            if($model->live_start_time)
                $model->live_start_time=date('Y-m-d H:i:s',$model->live_start_time);
            if($model->live_end_time)
                $model->live_end_time=date('Y-m-d H:i:s',$model->live_end_time);
        }
        return $this->render('create', [
            'model' => $model,
            'channel_list'=>$arr,
        ]);
        
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $is=1;
        $arr=ArrayHelper::map(Platform::find()->where(['is_delete'=>0])->orderBy('id desc')->all(),'id','name');
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) { 
            if($model->load(Yii::$app->request->post())&&$model->validate()){
                if($_FILES){
                    $type_list = array('jpg','jpeg','gif','png');
                    sort($type_list);
                    $multi_info=$_FILES; //接收$_FILES的全部上传信息
                    $up_info=array('name'=>$multi_info['Course']['name']['img'],'type'=>$multi_info['Course']['type']['img'],'tmp_name'=>$multi_info['Course']['tmp_name']['img'],'size'=>$multi_info['Course']['size']['img'],'error'=>$multi_info['Course']['error']['img']);
                    $base_dir = Yii::$app->basePath;
                    $add_dir="/upload_files/course_resource";
                    $to_path = $base_dir.$add_dir;
                    if(!is_dir($to_path))
                        $this->createDir($to_path,$to_path);
                    $error = array();
                    //函数使用方法如下
                    $flag=true;
                    if(empty($up_info['name'])){
                        $model->addError('img','上传文件不能为空');
                        $flag = false;
                        $is=0;
                    }
                    if($flag) {
                        $results= $this->upload_fun($up_info,$to_path,$type_list); //调用单文件上传函数
                        if($results['flag']=="right"){
                            $model->img=$add_dir.'/'.$results['info'];
                            $model->create_time=time();
                            $model->live_start_time=strtotime($model->live_start_time);
                            $model->live_end_time=strtotime($model->live_end_time);
                            $model->save();
                            Yii::$app->session->setFlash('msg','更新直播成功！');
                            return $this->redirect(['index']);   
                        } else {
                            //$error['resource'] = $results['info'];
                            Yii::$app->session->setFlash('msg','更新直播失败！');
                            $is=0;
                            $model->addError('img', $results['info']);
                        }
                    }
                }else{
                    $model->live_start_time=strtotime($model->live_start_time);
                    $model->live_end_time=strtotime($model->live_end_time);
                    $model->save();
                    Yii::$app->session->setFlash('msg','更新直播成功！');
                    return $this->redirect(['index']);   
                }
            }else{
                $is=0;
            }

        }
        if($is){
             if($model->live_start_time)
                $model->live_start_time=date('Y-m-d H:i:s',$model->live_start_time);
            if($model->live_end_time)
                $model->live_end_time=date('Y-m-d H:i:s',$model->live_end_time);
        }
        return $this->render('create', [
            'model' => $model,
            'channel_list'=>$arr,
        ]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        //$items=$model->getItems()->all();
        if($model->status == 1){
            Yii::$app->session->setFlash('msg','删除失败，直播进行中！');
        }else{
            $model->is_delete=1;
            $model->save(); 
        }

        return $this->redirect(['index']);
    }

    public function actionDelimg($id)
    {
        $model=$this->findModel($id);
        $base_dir = Yii::$app->basePath;
        if($model->img && is_file($base_dir.$model->img)){
            unlink($base_dir.$model->img);
            $model->img = '';
            $model->save();
            Yii::$app->session->setFlash('msg','删除直播图片成功！');
            
        }
        //var_dump($model->getErrors());die;
        return $this->redirect(['update','id'=>$model->id]);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //生成目录
    public function createDir($dir,$old){
        if(!is_dir($dir)){
            $new=dirname($dir);
            $this->createDir($new,$old);
        }else{
            mkdir(iconv("UTF-8", "GBK", $old),0777,true);
        }
    }

    function dealSize($size) {
        $unit = array('0'=>'B','1'=>'KB','2'=>'MB','3'=>'GB');
        for($i=0; $i<count($unit); $i++) {
            if($size / 1024 >1)
                $size = $size / 1024;
            else {
                $size = round($size, 2) . $unit[$i];
                return $size;
            }
        }
        return $size;
    }

    function upload_fun($up_info,$to_path,$typelist,$file_size=10485760){
        $result_arr = array();  //返回结果 flag是否成功  info 提示信息
        //1.判断文件上传是否错误
        if($up_info['error']>0){
            switch($up_info['error']){
                case 1:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
                    break;
                case 2:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
                    break;
                case 3:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="文件只有部分被上传";
                    break;
                case 4:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="没有文件被上传";
                    break;
                case 6:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="找不到临时文件夹";
                    break;
                case 7:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="文件写入失败";
                    break;
                default:
                    $result_arr['flag'] = "false";
                    $result_arr['info']="未知的上传错误";
                    break;
            }
            return $result_arr;
            //die();
        }
        //2.判断上传文件类型是否合法
        if(count($typelist)>0){
            $tmp_type = explode(".", $up_info['name']);
            if(count($tmp_type)>1&&(!in_array($tmp_type[count($tmp_type)-1],$typelist)||!isset($tmp_type[count($tmp_type)-1]))){
                $result_arr['flag'] = "false";
                $result_arr['info']='文件类型不合法！目前支持格式为：'.implode("、", $typelist);
                return $result_arr;
                //die();
            }
        }
        //4.判断上传文件大小是否超出允许值
        if($up_info['size']>$file_size){
            $result_arr['flag'] = "false";
            $result_arr['info']='文件大小超过10M';
            return $result_arr;
            //die();
        }
     
        //5.上传文件重命名
        $exten_name=pathinfo($up_info['name'],PATHINFO_EXTENSION);
        do{
            $main_name=date('YmHis'.'-'.rand(100,999));
            $new_name=$main_name.'.'.$exten_name;
        }while(file_exists($to_path.'/'.$new_name));
     
        //6.判断是否是上传的文件，并移动文件
        if(is_uploaded_file($up_info['tmp_name'])){
            if(move_uploaded_file($up_info['tmp_name'],$to_path.'/'.$new_name)){
                $result_arr['flag'] = "right";
                $result_arr['info']=$new_name;
                return $result_arr;
                //die();
            }else{
                $result_arr['flag'] = "false";
                $result_arr['info']='上传文件移动失败！';
                return $result_arr;
                //die();
            }
        }else{
            $result_arr['flag'] = "false";
            $result_arr['info']='这个文件不是上传文件！';
            return $result_arr;
            //die();
        }
     
    }

    /**
     * 获取推流地址
     * 如果不传key和过期时间，将返回不含防盗链的url
     * @param bizId 您在腾讯云分配到的bizid
     * streamId 您用来区别不通推流地址的唯一id
     * key 安全密钥
     * time 过期时间 sample 2016-11-12 12:00:00
     * @return String url
     */

    function getPushUrl($bizId, $streamId, $key = null, $starttime = null, $endtime = null)
    {
        if ($key && $endtime) {
            $txTime = strtoupper(base_convert(strtotime($endtime), 10, 16));
            /*echo $txTime.'<br>';
            $txTime = '59776AFF';*/
            //txSecret = MD5( KEY + livecode + txTime )
            //livecode = bizid+"_"+stream_id  如 8888_test123456
            $livecode = $bizId . "_" . $streamId; //直播码
            $txSecret = md5($key . $livecode . $txTime);
            $ext_str = "?" . http_build_query(array(
                    "bizid" => $bizId,
                    "txSecret" => $txSecret,
                    "txTime" => $txTime
                ));
        }
        $live_server = Yii::$app->params['live_server_play'];
        $pushParams = [
            'streamId' => $bizId . '_' . $streamId,
            'upstream_url_params' => $livecode . (isset($ext_str) ? $ext_str : ""),
            'rtmp_address' => "rtmp://" . $bizId . $live_server . $livecode,
            'flv_address' => "http://" . $bizId . $live_server . $livecode . ".flv",
            'hls_address' => "http://" . $bizId . $live_server . $livecode . ".m3u8",
            "livecode" => $key . $livecode . $txTime
        ];
        //return "rtmp://" . $bizId . ".livepush.myqcloud.com/live/" . $livecode . (isset($ext_str) ? $ext_str : "");
        return $pushParams;
    }

    /**
     * 获取播放地址
     * @param bizId 您在腾讯云分配到的bizid
     * $streamId 您用来区别不通推流地址的唯一id
     * @return String url
     */

    function getPlayUrl($bizId, $streamId)
    {
        $livecode = $bizId . "_" . $streamId; //直播码
        $live_server = Yii::$app->params['live_server_play'];
        return array(
            "rtmp://" . $bizId . $live_server . $livecode,
            "http://" . $bizId . $live_server . $livecode . ".flv",
            "http://" . $bizId . $live_server . $livecode . ".m3u8"
        );
    }

    public function actionQrcode($id) 
    {
        $push_url = Url::to(['live/wap','id'=>$id]);
        $push_url = Yii::$app->request->hostInfo.$push_url;
        //echo Yii::$app->request->hostInfo;
        //exit();

        return QrCode::png($push_url,false,0,10);    //调用二维码生成方法
    }

    /**
     * 创建直播
     * @param  [type] $publickey [公钥]
     * @param  [type] $mdhash    [加密key]
     * @param  [type] $etime     [结束时间]
     * @param  [type] $pid       [相应平台直播id]
     * @return [type]            [json数据返回]
     */
    public function actionApicreate(){
    //public function actionApicreate($publickey,$mdhash,$etime,$pid){
        //频道相应参数
        $starttime = time();
        $channel_name = Yii::$app->request->get('pid');
        $publickey = Yii::$app->request->get('publickey');
        $mdhash = Yii::$app->request->get('mdhash');
        $endtime = Yii::$app->request->get('etime');
        $etime = date("Y-m-d H:i:s",$endtime);
        $pic_path = null;
        $time = date('Y-m-d',time());
        $platform = Platform::find()->where(['is_delete'=>0,'public_key'=>$publickey])->asArray()->one();
        $str = md5('333zjnep2017-07-24zjnep20170718');

        if($platform)
        {
            $bool = md5($channel_name.$publickey.$time.$platform['private_key']);
            if($bool!==$mdhash)
            {
                $restr = json_encode(['cparam'=>'','msgcode'=>'1','curl'=>'','lurl'=>'','pid'=>$channel_name]);
               
            }
        }else
        {
            $restr = json_encode(['cparam'=>'','msgcode'=>'3','curl'=>'','lurl'=>'','pid'=>$channel_name]);      
        }
        $model = new Course();
        //从$char中获取字符，随机生成字符串$streamID
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $streamId = '';
        for ($i = 0; $i < 21; $i++) {
            $streamId .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        $bizId = Yii::$app->params['bizId'];    //腾讯云bizId
        $pushkey = Yii::$app->params['pushkey'];    //推流防盗链Key
        $push_params = $this->getPushUrl($bizId, $streamId, $pushkey, $starttime, $etime);
        //$get_url = $this->getPlayUrl($bizId, $streamId);
        $model->streamId = $push_params['streamId'];
        $model->upstream_url_params = $push_params['upstream_url_params'];
        $model->name = $channel_name;
        $model->channel_id = $platform['id'];
        $model->teacher_name = $platform['name'];
        $model->live_start_time = $starttime;
        $model->live_end_time = $endtime;
        $model->status = 0;
        $res = $model->save();
        //var_dump($model->getErrors());
        $live_server = Yii::$app->params['live_server_push'];
        $push_url = $bizId.$live_server;
        $upstream_url = 'rtmp://'.$push_url;
        $upstream_url_params = $push_params['upstream_url_params'];
        $lurl = "http://live.mynep.com/frontend/web/new/qcloud?room_id=".$model->id;
        if($model->id){
            $restr = json_encode(['roomid'=>$model->id,'streamId'=>$push_params['streamId'],'cparam'=>$upstream_url,'msgcode'=>'0','curl'=>$upstream_url_params,'lurl'=>$lurl,'pid'=>$channel_name]);
        }else{
            $restr = json_encode(['cparam'=>'','msgcode'=>'2','curl'=>'','lurl'=>'','pid'=>$channel_name]);
        }
        echo $restr;
        exit;
    }

    /**
     * 开启关闭直播状态
     * @param  [type] $id        [直播平台room_id]
     * @param  [type] $publickey [公钥]
     * @param  [type] $mdhash    [hash加密key]
     * @param  [type] $status    [1表示允许推流；2表示断流]
     * @return [type]            [json数据返回]
     */
    public function actionApiprohibit()
    //public function actionApiprohibit($id,$publickey,$mdhash,$status)
    {
        //$id = Yii::$app->request->queryParams['id'];
        $id = Yii::$app->request->get('id');
        $publickey = Yii::$app->request->get('publickey');
        $mdhash = Yii::$app->request->get('mdhash');
        $status = Yii::$app->request->get('status');    //0表示禁用； 1表示允许推流；2表示断流
        $channel_name = $id;
        $time = date('Y-m-d',time());
        //$key = Yii::$app->db->createCommand('SELECT private_key FROM live_secret_key WHERE public_key="'.$publickey.'"')->queryOne();
        $platform = Platform::find()->where(['is_delete'=>0,'public_key'=>$publickey])->asArray()->one();
        if($platform)
        {
            $bool = md5($channel_name.$publickey.$time.$platform['private_key']);
            if($bool!==$mdhash)
            {
                $restr = json_encode(['cparam'=>'','msgcode'=>'1','curl'=>'','lurl'=>'','pid'=>$channel_name]);             
            }
        }else
        {
            $restr = json_encode(['cparam'=>'','msgcode'=>'3','curl'=>'','lurl'=>'','pid'=>$channel_name]);                
        }
        
        $model = Course::findOne($id);
        if($model)
        {
            $appid = Yii::$app->params['appid'];
            $channel_id = $model->streamId;
            $interface = "Live_Channel_SetStatus";  //api接口
            $key = Yii::$app->params['pushkey'];    //推流防盗链Key
            $t = time()+60;
            $sign = md5($key.$t);
            $URL = "http://fcgi.video.qcloud.com/common_access?".
                "appid=" .$appid.
                "&interface=".$interface.
                "&Param.s.channel_id=".$channel_id.
                "&Param.n.status=".$status.
                "&t=".$t.
                "&sign=".$sign;
            $res = json_decode(file_get_contents($URL),true);
            if($res['ret'] == 0)
            {
                $restr = json_encode(['msgcode'=>'0']);
            }else{
                $restr = json_encode(['msgcode'=>'1']);
            }
        }
        echo $restr;
        exit;
    }

    public function actionTestaa(){
        $publickey = Yii::$app->request->get('id');
        echo  $publickey;
        exit;
    }

}

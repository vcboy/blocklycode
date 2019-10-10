<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\channel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .channel-view{width:900px;margin:50px auto;}
    .sdiv{height:50px;}
    .son{display:inline-block;margin-right:100px;}
    .son label{width:80px;}
    .btndiv{text-align:center;margin-bottom:20px;}
    .btndiv .btn{width:150px;border-radius:2px;}
    .btndiv .btn-pink{margin-right:50px;}
    #my-publisher{background: black;}
</style>
<script src="http://nos.netease.com/vod163/nePublisher.js"></script>
<div class="page-header">
    <h1>频道直播</h1>
</div>
<div class="channel-view">
    <div class="controldiv">
        <div class="sdiv">
            <span class="son"><label>摄像头</label><select id="camera"></select></span>
            <span class="son"><label>麦克风</label><select id="microPhone"></select></span>
        </div>
        <!--div class="sdiv">
            <span class="son"><label>清晰度</label><select id="clean"></select></span>
        </div-->
        <div class="btndiv">
            <span  id="start" onclick="video_start();" class="btn btn-pink">开始直播</span>
            <span id="view" onclick="video_view();" class="btn  btn-success">预览</span>
            
        </div>
    </div>
    <div id="my-publisher"></div>
</div>
<script>
    var on=false;
    var url='<?=$model["push_url"];?>';
   /* 
    var viewOptions={
        videoWidth: ,   //Number (可选) 视频宽度
        videoHeight:,  //Number (可选) 视频高度
        fps: , //Number (可选) 帧率 default 15  设置推流器的帧率
        bitrate: ,//Number (可选) 码率 default 600 设置推流器的码率
    }
    var flashOptions={
        previewWindowWidth: , //Number (可选) default 862 设置推流器的宽
        preViewWindowHeight: , //Number (可选) default 446 设置推流器的宽
        wmode: ,//String (可选) 'window','transparent','opaque',default:'opaque'
    }*/
    //var myPublisher = new nePublisher('my-publisher', [url], [viewOptions], [flashOptions], [initSuccessCallbackFun],[initErrorCallbackFun]);
    var myPublisher = new nePublisher('my-publisher',url,function(){
        var cameraList=this.getCameraList();   //获取摄像头列表　
        var microPhoneList=this.getMicroPhoneList();  //获取麦克风列表 
        /*// 获取参数和状态
        this.getCameraList();   //获取摄像头列表　
        this.getMicroPhoneList();  //获取麦克风列表 */
        this.getDefinedErrors();    //获取错误对象信息
        this.getSDKVersion();    //获取版本号
            
        // 设置/修改参数
        this.setCamera(0);//设置摄像头
        this.setMicroPhone(0);//设置麦克风
        this.alterDefinedErrors();//修改错误对象信息　
            
        // 设置和动作
        //this.startPreview();//开始预览
        //this .startPublish();//开始推流　
        //this.stopPublish();//停止推流
        if(cameraList){
            var options='';
           for(var i in cameraList){
                options+='<option value="'+i+'">'+cameraList[i]+'</option>';
           }
           $('#camera').append(options);
           $("#camera").chosen({ width : "250px", });
        }
        if(microPhoneList){
           var options='';
           for(var i in microPhoneList){
                options+='<option value="'+i+'">'+microPhoneList[i]+'</option>';
           }
           $('#microPhone').append(options);
           $("#microPhone").chosen({ width : "250px", });
        }
    });
    function video_start(){
        if(!on){
            myPublisher.startPublish();
            $('#start').text('停止直播');
            on=true;
        }else{
            myPublisher.stopPublish();
            myPublisher.startPreview();
            $('#start').text('开始直播');
            on=false;
        }
        
        
    }
    function video_view(){
        myPublisher.startPreview();
        
    }
   /* $("#camera").chosen({
        width : "150px",
    });
       $("#microPhone").chosen({
        width : "150px",
    });
          $("#clean").chosen({
        width : "150px",
    });*/
    
</script>


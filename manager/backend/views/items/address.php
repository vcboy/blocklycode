<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\items */
$this->title = $model->videoName;
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    if(Yii::$app->session->hasFlash('msg'))
       echo "<script>sweetAlert('".Yii::$app->session->getFlash('msg')."');</script>";
?>
<style>
    .sdiv{margin-bottom:10px;color:#333;line-height:24px;width:950px;padding-left:20px;}
    .labeldiv,.valdiv{display: inline-block;}
    .labeldiv{width:100px;}
    .fw{font-weight:bold;}
    .graydiv{background:#f7f8fa;padding:20px;word-break:break-all; word-wrap:break-word;font-size:14px;width:600px;display:inline-block;}
    .btndiv{display:inline-block;vertical-align:text-top;margin-left:20px;}
    .btn-sm2{width:30px;height:25px;text-align:center;line-height:25px;padding:0;}
    .blockdiv{display: block;}
</style>
<div class="page-header">
    <h1>视频地址</h1>
</div>
<div class="items-view">
	<div class="sdiv"><div class="labeldiv fw">视频名称</div><div class="valdiv"><?=$model->videoName?></div></div>
    <div class="sdiv">
        <div class="labeldiv fw">转码格式</div>
        <div class="valdiv">标清<?php
            $arr=array();
            if($model->sdMp4Url)
                $arr[]='Mp4';
            if($model->sdFlvUrl)
                $arr[]='Flv';
            if($model->sdHlsUrl)
                $arr[]='Hls';
            echo implode('、', $arr);
            ?> <span>|</span>
            高清 <?php
            $arr=array();
            if($model->hdMp4Url)
                $arr[]='Mp4';
            if($model->hdFlvUrl)
                $arr[]='Flv';
            if($model->hdHlsUrl)
                $arr[]='Hls';
            echo implode('、', $arr);
            ?> <span>|</span> 
            超清 <?php
            $arr=array();
            if($model->shdMp4Url)
                $arr[]='Mp4';
            if($model->shdFlvUrl)
                $arr[]='Flv';
            if($model->shdHlsUrl)
                $arr[]='Hls';
            echo implode('、', $arr);
            ?>
        </div>
    </div>
    <div class="sdiv">
        <div class="labeldiv fw">源地址</div>
        <div class="valdiv"><?=($model['initialSize']/1024/1024)>20?round($model['initialSize']/1024/1024/1024,2).'GB':round($model['initialSize']/1024/1024,2).'MB'?></div>
        <div class="blockdiv"></div>
        <div class="graydiv"><?=$model->origUrl?></div>
        <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->origUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>",$model->downloadOrigUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
          </div>
    </div>
    <?php if($model->sdMp4Url){?>
        <div class="sdiv">
            <div class="labeldiv fw">标清MP4</div><div class="valdiv"><?=($model['sdMp4Size']/1024/1024)>20?round($model['sdMp4Size']/1024/1024/1024,2).'GB':round($model['sdMp4Size']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->sdMp4Url?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->sdMp4Url, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadSdMp4Url, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
                <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>1,'typeName'=>'Mp4','ceng'=>'sd','ceng1'=>'Sd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->hdMp4Url){?>
        <div class="sdiv">
            <div class="labeldiv fw">高清MP4</div><div class="valdiv"><?=($model['hdMp4Size']/1024/1024)>20?round($model['hdMp4Size']/1024/1024/1024,2).'GB':round($model['hdMp4Size']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->hdMp4Url?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->hdMp4Url, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadHdMp4Url, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
                <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>2,'typeName'=>'Mp4','ceng'=>'hd','ceng1'=>'Hd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->shdMp4Url){?>
        <div class="sdiv">
            <div class="labeldiv fw">超清MP4</div><div class="valdiv"><?=($model['shdMp4Size']/1024/1024)>20?round($model['shdMp4Size']/1024/1024/1024,2).'GB':round($model['shdMp4Size']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->shdMp4Url?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->shdMp4Url, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadShdMp4Url, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
                <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>3,'typeName'=>'Mp4','ceng'=>'shd','ceng1'=>'Shd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>

    <?php if($model->sdFlvUrl){?>
        <div class="sdiv">
            <div class="labeldiv fw">标清Flv</div><div class="valdiv"><?=($model['sdFlvSize']/1024/1024)>20?round($model['sdFlvSize']/1024/1024/1024,2).'GB':round($model['sdFlvSize']/1024/1024,2).'MB'?></div>
           <div class="blockdiv"></div>
           <div class="graydiv"><?=$model->sdFlvUrl?></div>
           <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                 <?= Html::a("<i class='icon-eye-open'></i>", $model->sdFlvUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadSdFlvUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
             <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>4,'typeName'=>'Flv','ceng'=>'sd','ceng1'=>'Sd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->hdFlvUrl){?>
        <div class="sdiv">
            <div class="labeldiv fw">高清Flv</div><div class="valdiv"><?=($model['hdFlvSize']/1024/1024)>20?round($model['hdFlvSize']/1024/1024/1024,2).'GB':round($model['hdFlvSize']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->hdFlvUrl?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->hdFlvUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadHdFlvUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
            <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>5,'typeName'=>'Flv','ceng'=>'hd','ceng1'=>'Hd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->shdFlvUrl){?>
        <div class="sdiv">
            <div class="labeldiv fw">超清Flv</div><div class="valdiv"><?=($model['shdFlvSize']/1024/1024)>20?round($model['shdFlvSize']/1024/1024/1024,2).'GB':round($model['shdFlvSize']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->shdFlvUrl?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->shdFlvUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadShdFlvUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
               <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>6,'typeName'=>'Flv','ceng'=>'shd','ceng1'=>'Shd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->sdHlsUrl){?>
        <div class="sdiv">
            <div class="labeldiv fw">标清Hls</div><div class="valdiv"><?=($model['sdHlsSize']/1024/1024)>20?round($model['sdHlsSize']/1024/1024/1024,2).'GB':round($model['sdHlsSize']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->sdHlsUrl?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->sdHlsUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadSdHlsUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
            <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>7,'typeName'=>'Hls','ceng'=>'sd','ceng1'=>'Sd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->hdHlsUrl){?>
        <div class="sdiv">
            <div class="labeldiv fw">高清Hls</div><div class="valdiv"><?=($model['hdHlsSize']/1024/1024)>20?round($model['hdHlsSize']/1024/1024/1024,2).'GB':round($model['hdHlsSize']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->hdHlsUrl?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                <?= Html::a("<i class='icon-eye-open'></i>", $model->hdHlsUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadHdHlsUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
                <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>8,'typeName'=>'Hls','ceng'=>'hd','ceng1'=>'Hd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <?php if($model->shdHlsUrl){?>
        <div class="sdiv">
            <div class="labeldiv fw">超清Hls</div><div class="valdiv"><?=($model['shdHlsSize']/1024/1024)>20?round($model['shdHlsSize']/1024/1024/1024,2).'GB':round($model['shdHlsSize']/1024/1024,2).'MB'?></div>
            <div class="blockdiv"></div>
            <div class="graydiv"><?=$model->shdHlsUrl?></div>
            <div class="btndiv">
                <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
                 <?= Html::a("<i class='icon-eye-open'></i>", $model->shdHlsUrl, ["class" =>"btn-sm2 badge badge-info",'title'=>'播放','target'=>'_blank'])?>
                <?= Html::a("<i class='icon-download-alt'></i>", $model->downloadShdHlsUrl, ["class" =>"btn-sm2 badge badge-success",'title'=>'下载'])?>
                 <?= Html::a("<i class='icon-exclamation-sign'></i>", ['delete-video','type'=>9,'typeName'=>'Hls','ceng'=>'shd','ceng1'=>'Shd','vid'=>$model->vid], ["class" =>"btn-sm2 badge badge-danger",'title'=>'删除'])?>
            </div>
        </div>
    <?php }?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
   </div>

</div>
<script type="text/javascript" language="javascript">
    //复制到剪切板js代码
    $(document).ready(function(){  
        if ( window.clipboardData ) {  
            $('.copybtn').click(function() {  
                window.clipboardData.setData("Text",$(this).parent().siblings('.graydiv').text());  
                sweetAlert('复制成功！');  
            });  
        } else {  
            $(".copybtn").zclip({  
                path:'http://img3.job1001.com/js/ZeroClipboard/ZeroClipboard.swf',  
                copy:function(){
                    return $(this).parent().siblings('.graydiv').text();
                },  
                afterCopy:function(){sweetAlert('复制成功！');}
            });  
        }  
    });   
</script>


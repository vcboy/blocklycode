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
    .sdiv{margin-bottom:10px;color:#333;line-height:24px;width:950px;padding-left:20px;}
    .labeldiv,.valdiv{display: inline-block;}
    .labeldiv{width:150px;}
    .fw{font-weight:bold;}
    .graydiv{background:#f7f8fa;padding:20px;word-break:break-all; word-wrap:break-word;font-size:14px;width:600px;display:inline-block;}
    .btndiv{display:inline-block;vertical-align:text-top;margin-left:20px;}
</style>
<div class="page-header">
    <h1>直播地址</h1>
</div>
<div class="channel-view">
	<div class="sdiv"><div class="labeldiv fw">频道名称</div><div class="valdiv"><?=$model->name?></div></div>
	<div class="sdiv">
        <div class="fw">推流地址</div>
        <div class="graydiv"><?=$model->push_url?></div>
        <div class="btndiv">
            <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
        </div>
    </div>
	<div class="sdiv">
        <div class="fw">拉流地址（HTTP）</div>
        <div class="graydiv"><?=$model->http_pull_url?></div>
        <div class="btndiv">
           <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
        </div> 
    </div>
	<div class="sdiv">
        <div class="fw">拉流地址（HLS）</div>
        <div class="graydiv"><?=$model->hls_pull_url?></div>
         <div class="btndiv">
           <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
        </div> 
    </div>
	<div class="sdiv">
        <div class="fw">拉流地址（RTMP）</div>
        <div class="graydiv"><?=$model->rtmp_pull_url?></div>
         <div class="btndiv">
           <?= Html::a("<i class='icon-book'></i>", ['#'], ["class" =>"btn-sm2 badge badge-grey copybtn",'title'=>'复制'])?>
        </div> 
    </div>
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
                window.clipboardData.setData("Text", $(this).parent().siblings('.graydiv').text());  
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

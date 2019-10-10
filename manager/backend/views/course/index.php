<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use job\lib\JobGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
$bizId = Yii::$app->params['bizId'];    //腾讯云bizId
$live_server = Yii::$app->params['live_server_push'];
$push_url = $bizId.$live_server;
/*echo $push_url;
exit;*/
?>
<style>
.red{color:red;}
.pdiv{margin:10px 0;}
.pdiv .btn{margin-right:5px;}
</style>
<?php $status_list=Yii::$app->params['course_status'];?>
<?php  echo $this->render('_search', ['model' => $searchModel,'channel_list' =>$channel_list,'status_list'=>$status_list]); ?>
<span id="flashMsg" class="top-alert-icon-done fade-out" style="display: none; width: 160px; margin: 0 auto; text-align: center;/*background-color: #00A6C7;*/"></span>

<form action="" method="post" id="gridview_form">
    <div class="table-responsive">
        <div class="pdiv">
       <?php
            $common_url = Url::to(['items-preset/common']);
            $delete_url = Url::to(['items-preset/delete']);
            //判断权限需要用到的参数
            $auth = Yii::$app->authManager;
            //$userid = Yii::$app->user->identity->id;
            //if($auth->checkAccess($userid,'menu_taxis')) {
            //echo Html::input("button", "", "数据同步", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:common('$common_url')"]);
            //}
            //echo Html::input("button", "", "删除", ["class" => "btn btn-sm btn-danger", "onclick" => "javascript:update_record('$delete_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
        ?>
    </div>
    <?= JobGridView::widget([
        'dataProvider'  => $dataProvider,
        'summary'       => '',
        'id'            => "waitforcheck",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '序号'],
            [
                'header' => "全选  ". Html::checkbox('',false,["onclick"=>"checkall(this.checked,'waitforcheck','ckbox')"]),
                'format' => 'raw',
                'value' => function($model){
                    return Html::checkbox("ckbox[]", false, ["value"=>$model['id']]);
                }
            ],
            'name',
            [
                'attribute' => "channel_id",
                'format' => 'raw',
                'value' => function($model){
                        return $model->channel_id?$model->getChannel()->one()->name:'';
                },
            ],
            [
                'attribute' => "live_start_time",
                'format' => 'raw',
                'value' => function($model){
                        return $model->live_start_time?date('Y-m-d H:i:s',$model->live_start_time):'';
                },
            ],
            [
                'attribute' => "live_end_time",
                'format' => 'raw',
                'value' => function($model){
                        return $model->live_end_time?date('Y-m-d H:i:s',$model->live_end_time):'';
                },
            ],
            [
            'format' => 'raw',
                'attribute'=>'status',
                'value' => function($model,$status_list){
                    //$color=$model['status']==1?'red':'';
                    $status = $model->getStatus($model->live_end_time,$model->streamId);
                    $color=$status==1?'red':'';
                    $status_list=Yii::$app->params['course_status'];
                    //return '<span class="'.$color.'">'.$status_list[$model['status']].'</span>';
                    return '<span class="'.$color.'">'.$status_list[$status].'</span>';
                    
                },
            ],
            /*[
            'format' => 'raw',
                'attribute'=>'is_home',
                'value' => function($model,$status_list){
                    $arr=array('1'=>'是',0=>'否');
                    return $arr[$model['is_home']];
                    
                },
            ],*/
            [
                'header' => '推流地址',
                'format' => 'raw',
                //'attribute'=>'is_home',
                'value' => function($model){
                    //$arr=array('1'=>'是',0=>'否');
                    //return $arr[$model['is_home']];
                    $bizId = Yii::$app->params['bizId'];    //腾讯云bizId
                    $live_server = Yii::$app->params['live_server_push'];
                    $push_url = $bizId.$live_server;
                    //var_dump($bizId);
                    //exit();
                    $url = '#';
                    $options = [
                        'title' => '点击复制推送地址',
                        'aria-label' => Yii::t('yii', 'View'),
                        'data-pjax' => '0',
                        'class' =>'btn-xs btn  btn-success copy2',
                        'data-clipboard-text' => 'rtmp://'.$push_url.$model['upstream_url_params'],
                        //'data-clipboard-text' => 'rtmp://7949.liveplay.myqcloud.com/live/7949_t5l0hfvtp6xdki5g01fwv?bizid=7949&txSecret=a047404585b3d0728cd20e84b717b9ae&txTime=0',
                    ];
                    return Html::a('<i class="icon-copy bigger-120"></i>', $url, $options);
                    //return "<a style='float: right;' title='点击复制推送地址'  class='m110 copy2' data-clipboard-text='rtmp://".$push_url.$model['upstream_url_params']."' ><span class='icon-copy bigger-120' ></span></a>";
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {share} {delete}',
                'buttons' => [
                    'view' => function($url,$model){
                        $options = [
                            'title' => '查看',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'btn-xs btn btn-warning',
                        ];
                        return Html::a('<i class="icon-zoom-in bigger-120"></i>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options =[
                            'title' => '编辑',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-success',
                        ];
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        //$userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_update')) {
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        //}
                    },
                    'share' => function ($url, $model, $key) {
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        //$userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['course/delete','id'=>$model['id']]);
                            return Html::a('<lable class="btn btn-xs btn-success" title="分享"><i class="icon-share bigger-120"></i></lable>', '#', ['onclick'=>"javascript:liveshare({$model['id']})"]);
                        //}
                    },
                    'delete' => function ($url, $model, $key) {
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        //$userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['course/delete','id'=>$model['id']]);
                            return Html::a('<lable class="btn btn-xs btn-danger" title="删除"><i class="icon-trash bigger-120"></i></lable>', '#', ['onclick'=>'javascript:sweetConfirmChange(\'你确定要删除吗?\',\''.$url.'\')']);
                        //}
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
</form>
<?php 
    if(Yii::$app->session->hasFlash('msg'))
       echo "<script>sweetAlert('".Yii::$app->session->getFlash('msg')."');</script>";
?>
<script>
    function common($url){
        //alert($url);
        $('#gridview_form').attr('action',$url);
        $('#gridview_form').submit();
    }

    var clip = new ZeroClipboard( document.getElementsByClassName("copy2") );
    $('.copy2').click(function () {
        //alert('copy'); 
        $("#flashMsg").css('display','block');
        $("#flashMsg").css('background-color','#CDBE70');
        $("#flashMsg").html('<font style="color: #ff0000" >复制成功</font>');
        $(function () {
            setTimeout(function () {
                //$("#live_list").css('float','none');
               // $("#topAlert").css('display','none');
                $("#flashMsg").css('display','none');
                $("#flashMsg").html('');
            }, 3000);
        })
    })

    function liveshare(id){
        $('#myModal').modal('show');
        var qrcode_url = "<?php echo Url::to(['course/qrcode'])?>";
        qrcode_url+="/"+id;

        var push_url = "<?php echo Yii::$app->request->hostInfo.Url::to(['live/web']) ?>"+'/'+id;
        $("#push_url").val(push_url);

        $("#qrcodeimg").attr('src',qrcode_url);
        console.log(qrcode_url);
    }
</script>


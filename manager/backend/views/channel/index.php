<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use job\lib\JobGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.red{color:red;}
.pdiv{margin:10px 0;}
.pdiv .btn{margin-right:5px;}
</style>
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<form action="" method="post" id="gridview_form">
    <div class="table-responsive">

    <div class="pdiv">
       <?php
            $common_url = Url::to(['channel/common']);
            $disabled_url = Url::to(['channel/disabled','status'=>'2']);
            $resume_url = Url::to(['channel/disabled','status'=>'0']);
            $delete_url = Url::to(['channel/delete']);
            //判断权限需要用到的参数
            $auth = Yii::$app->authManager;
            $userid = Yii::$app->user->identity->id;
            //if($auth->checkAccess($userid,'menu_taxis')) {
            echo Html::input("button", "", "数据同步", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:common('$common_url')"]);
            //}
            echo Html::input("button", "", "禁用", ["class" => "btn btn-sm btn-gray", "onclick" => "javascript:update_record('$disabled_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
            echo Html::input("button", "", "恢复", ["class" => "btn btn-sm btn-success", "onclick" => "javascript:update_record('$resume_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
            echo Html::input("button", "", "删除", ["class" => "btn btn-sm btn-danger", "onclick" => "javascript:update_record('$delete_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
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
                    if($model->is_exists)
                        return Html::checkbox("ckbox[]", false, ["value"=>$model['cid']]);
                    else
                         return Html::checkbox("ckbox[]", false, ["value"=>$model['cid'],'disabled'=>'disabled']);
                }
            ],
            'name',
            'cid',
            [
                'attribute'=>'ctime',
                'value' => function($model){
                    //$str=substr($model['ctime'],0,10);
                    return $model['ctime']?date('Y-m-d H:i',substr($model['ctime'],0,10)):'';
                },
            ],
            [
                'format' => 'raw',
                'attribute'=>'status',
                'value' => function($model){
                    $arr=Yii::$app->params['channel_status'];
                    $color=$model['status']==2?'red':'';
                    return '<span class="'.$color.'">'.$arr[$model['status']].'</span>';
                },
            ],
            [
                'format' => 'raw',
                'attribute'=>'need_record',
                'value' => function($model){
                    $arr=array(0=>'否',1=>'是');
                    return $arr[$model['need_record']];
                },
            ],
            [
                'format' => 'raw',
                'attribute'=>'is_exists',
                'value' => function($model){
                    $arr=array(0=>'否',1=>'是');
                    $color=$model['is_exists']==0?'red':'';
                    return '<span class="'.$color.'">'.$arr[$model['is_exists']].'</span>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {address} {record} {live} {disabled} {delete} {weblive} {mobilelive}',
                'buttons' => [
                    'view' => function($url,$model){
                        $options = [
                            'title' => '查看',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' =>'btn-xs btn btn-warning',
                        ];
                        return Html::a('<i class="icon-zoom-in bigger-120"></i>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => '编辑',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-success',
                        ];
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_update')) {
                        if($model->is_exists)
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        //}
                    },
                    'address' => function($url,$model){
                        $options = [
                            'title' => '地址',
                            'aria-label' => Yii::t('yii', 'address'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-purple',
                        ];
                        if($model->is_exists)
                         return Html::a('<i class="icon-asterisk  bigger-120"></i>', $url, $options);
                    },
                    'record' => function($url,$model){
                        $url = Url::to(['channel/record','cid'=>$model['cid']]);
                        $options = [
                            'title' => '录制',
                            'aria-label' => Yii::t('yii', 'address'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-yellow',
                        ];
                        if($model->is_exists)
                            return Html::a('<i class="icon-bar-chart  bigger-120"></i>', $url, $options);
                    },
                    
                    'live' => function($url,$model){
                        $url = Url::to(['channel/live','cid'=>$model['cid']]);
                        $options = [
                            'title' => '直播',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-pink',
                        ];
                        if($model->is_exists)
                            return Html::a('<i class="icon-facetime-video  bigger-120"></i>', $url, $options);
                    },
                    'disabled' => function($url,$model){
                        $url = Url::to(['channel/disabled','cid'=>$model['cid'],'status'=>'2']);
                        $title='禁用';
                        $class='icon-lock';
                        if($model->status==2){
                            $title='恢复';
                            $class='icon-unlock';
                            $url = Url::to(['channel/disabled','cid'=>$model['cid'],'status'=>'0']);
                        }
                        $options = [
                            'title' => $title,
                            'aria-label' => Yii::t('yii', 'disabled'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-gray',
                        ];
                        if($model->is_exists)
                            return Html::a('<i class="'.$class.'  bigger-120"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['channel/delete','cid'=>$model['cid']]);
                            return Html::a('<lable class="btn btn-xs btn-danger" title="删除"><i class="icon-trash bigger-120"></i></lable>', '#', ['onclick'=>'javascript:sweetConfirmChange(\'你确定要删除吗?\',\''.$url.'\')']);
                        //}
                    },
                    'weblive' => function($url,$model){
                        $host_url = Yii::$app->request->hostInfo;
                        $php_dir =  $_SERVER['PHP_SELF'];
                        $php_arr = explode('/', $php_dir);
                        $url_dir = $host_url.'/'.$php_arr[1].'/';
                        $url = Url::to($url_dir.'client/frontend/web/web?cid='.$model['cid']);
                        $options = [
                            'title' => '网页直播地址',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-pink',
                            'target'=>'_blank'
                        ];
                        if($model->is_exists)
                            return Html::a('<i class="icon-facetime-video  bigger-120"></i>', $url, $options);
                    },
                    'mobilelive' => function($url,$model){
                        $host_url = Yii::$app->request->hostInfo;
                        $php_dir =  $_SERVER['PHP_SELF'];
                        $php_arr = explode('/', $php_dir);
                        $url_dir = $host_url.'/'.$php_arr[1].'/';
                        $url = Url::to($url_dir.'client/frontend/web/web?cid='.$model['cid']);
                        $options = [
                            'title' => '移动直播地址',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-pink',
                            'target'=>'_blank'
                        ];
                        if($model->is_exists)
                            return Html::a('<i class="icon-facetime-video  bigger-120"></i>', $url, $options);
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
</script>


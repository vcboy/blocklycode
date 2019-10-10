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
            $common_url = Url::to(['items-preset/common']);
            $delete_url = Url::to(['items-preset/delete']);
            //判断权限需要用到的参数
            $auth = Yii::$app->authManager;
            $userid = Yii::$app->user->identity->id;
            //if($auth->checkAccess($userid,'menu_taxis')) {
            echo Html::input("button", "", "数据同步", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:common('$common_url')"]);
            //}
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
                    if($model->is_exists&&$model->isDel)
                        return Html::checkbox("ckbox[]", false, ["value"=>$model['presetId']]);
                    else
                         return Html::checkbox("ckbox[]", false, ["value"=>$model['presetId'],'disabled'=>'disabled']);
                }
            ],
            'presetName',
            [
                'header' => "转码格式",
                'format' => 'raw',
                'value' => function($model){
                    $arr=array();
                    if($model['sdMp4'])
                        $arr[]='标清MP4';
                    if($model['hdMp4'])
                        $arr[]='高清MP4';
                    if($model['shdMp4'])
                        $arr[]='超清MP4';
                    if($model['sdFlv'])
                        $arr[]='标清FLV';
                    if($model['hdFlv'])
                        $arr[]='高清FLV';
                    if($model['shdFlv'])
                        $arr[]='超清FLV';
                    if($model['sdHls'])
                        $arr[]='标清HLS';
                    if($model['hdHls'])
                        $arr[]='高清HLS';
                    if($model['shdHls'])
                        $arr[]='超清HLS';
                    if(!empty($arr))
                        return implode('、',$arr);
                    else
                        return '';
                  
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
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options =[
                            'title' => '编辑',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-success',
                        ];
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_update')) {
                        if($model->is_exists&&$model->isDel)
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        //}
                    },
                    'delete' => function ($url, $model, $key) {
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['items-preset/delete','presetId'=>$model['presetId']]);
                            if($model->isDel)
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
</script>


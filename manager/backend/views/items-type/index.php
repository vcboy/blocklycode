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
            $common_url = Url::to(['items-type/common']);
            $delete_url = Url::to(['items-type/delete']);
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
                        return Html::checkbox("ckbox[]", false, ["value"=>$model['typeId']]);
                    else
                        return Html::checkbox("ckbox[]", false, ["value"=>$model['typeId'],'disabled'=>'disabled']);
                }
            ],
            'typeName',
            'desc',
            'number',
            [
                'attribute'=>'createTime',
                'value' => function($model){
                    //$str=substr($model['ctime'],0,10);
                    return $model['createTime']?date('Y-m-d H:i',substr($model['createTime'],0,10)):'';
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
            [
                'format' => 'raw',
                'attribute'=>'isDel',
                'value' => function($model){
                    $arr=array(0=>'否',1=>'是');
                    $color=!$model['isDel']?'red':'';
                    return '<span class="'.$color.'">'.$arr[$model['isDel']].'</span>';
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
                            $url = Url::to(['items-type/delete','typeId'=>$model['typeId']]);
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


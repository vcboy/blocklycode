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
    <?php  echo $this->render('_search', ['model' => $searchModel,'menuList' => $menuList]); ?>
<form action="" method="post" id="gridview_form">
    <div class="table-responsive">
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
            [

                'header' => '菜单名称',
                'value' => function($model){return $model['name'];},
            ],
            [
                'header' => '菜单下的权限',
                'value' => function($model){return implode(',',$model['permission']);}
            ],
            [
                'header' => '链接地址',
                'value' => function($model){return $model['url'];}
            ],
            [
                'header' => "排序(<font color=red>数字越大越靠前</font>)",
                'format' => 'raw',
                'value' => function($model){
                    return Html::input('text','taxis_'.$model['id'], $model['taxis'],['id'=>'taxis_'.$model['id'],'size'=>5]);
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => '修改',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-info',
                        ];
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'menu_update')) {
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            //'title' => Yii::t('yii', 'Delete'),
                            //'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', '你确定要删除吗?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                        ];
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'menu_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['menu/dodelete','id'=>$model['id']]);
                            return Html::a('<lable class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></lable>', '#', ['onclick'=>'javascript:sweetConfirmChange(\'你确定要删除吗?\',\''.$url.'\')']);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
    <?php
    $taxis_url = Url::to(['menu/update-taxis']);
    //判断权限需要用到的参数
    $auth = Yii::$app->authManager;
    $userid = Yii::$app->user->identity->id;
    if($auth->checkAccess($userid,'menu_taxis')) {
        echo Html::input("button", "", "更新排序", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:update_record('$taxis_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
    }
    ?>
</form>


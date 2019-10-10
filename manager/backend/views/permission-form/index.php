<?php

use yii\helpers\Html;
use job\lib\JobGridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PermissionFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permission Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php  echo $this->render('_search', ['model' => $searchModel,'menuList' => $menuList]); ?>
<?= JobGridView::widget([
    'dataProvider' => $dataProvider,
    'summary'=>'',
    //'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn','header' => '序号'],

        'name',
       // 'type',
        'description:ntext',
       // 'rule_name',
       // 'data:ntext',
        // 'created_at',
        // 'updated_at',
        [
            'value' => function($model){return $model->getMenuName();},
            'header' => '所属菜单',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key)
                {
                    $options = [
                        'title' => '修改',
                        'aria-label' => Yii::t('yii', 'Update'),
                        'data-pjax' => '0',
                        'class' => 'btn btn-xs btn-info',
                    ];
                    //判断权限需要用到的参数
                    $auth = Yii::$app->authManager;
                    $userid = Yii::$app->user->identity->id;
                    if($auth->checkAccess($userid,'permission_update')) {
                        return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                    }
                },
                //*
                'delete' => function ($url, $model, $key)
                {
                    $options = [
                        'title' => Yii::t('yii', 'Delete'),
                        'aria-label' => Yii::t('yii', 'Delete'),
                        //'data-confirm' => "sweetConfirmChange('你确定要删除吗?','".$url."')",//Yii::t('yii', '你确定要删除吗?'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ];
                    //判断权限需要用到的参数
                    $auth = Yii::$app->authManager;
                    $userid = Yii::$app->user->identity->id;
                    if($auth->checkAccess($userid,'permission_delete')) {
                        $url = Url::to(['permission-form/dodelete','id'=>$model->name]);
                        return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', '#', ['onclick'=>'javascript:sweetConfirmChange(\'你确定要删除吗?\',\''.$url.'\')']);
                    }
                },
                /*/
                'delete' => function ($url, $model, $key) {
                    $options = [
                        'title' => Yii::t('yii', 'Delete'),
                        'aria-label' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii', '你确定要删除吗?'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ];
                    //判断权限需要用到的参数
                    $auth = Yii::$app->authManager;
                    $userid = Yii::$app->user->identity->id;
                    if($auth->checkAccess($userid,'courseNature_delete')) {
                        return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                    }
                },*/
            ]
        ],
    ],
]); ?>
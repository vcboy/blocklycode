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
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<form action="" method="post" id="gridview_form">
    <div class="table-responsive">
    <?= JobGridView::widget([
        'dataProvider'  => $dataProvider,
        'id'            => "waitforcheck",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '序号'],
            [
                'header' => '模板名称',
                'value' => function($model){return $model['name'];},
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model){
                        $options = [
                            'title' => '查看',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-success',
                        ];
                        return Html::a('<i class="icon-zoom-in bigger-120"></i>', $url, $options);
                    },
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
                        if($auth->checkAccess($userid,'template_update')) {
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'template_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['template/delete','id'=>$model['id']]);
                            return Html::a('<lable class="btn btn-xs btn-danger" title="删除"><i class="icon-trash bigger-120"></i></lable>', '#', ['onclick'=>'javascript:sweetConfirmChange(\'你确定要删除吗?\',\''.$url.'\')']);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
</form>
<?php 
    if(Yii::$app->session->hasFlash('error'))
       echo "<script>sweetAlert('".Yii::$app->session->getFlash('error')."');</script>";
?>


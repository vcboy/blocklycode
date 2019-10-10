<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JiandingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jiandings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jianding-index">
<div class="widget-box">
		<div class="widget-header">
			<h4>查询条件</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
			                <?php echo $this->render('_importsearch', ['model' => $model,'planlist' => $planlist]); ?>
            			</div>
		</div>
</div>
<form action="<?=Url::to(['jianding/importdata'])?>" method="post" id="gridview_form">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'id'            => "waitforcheck",
        'columns' =>  [
            ['class' => 'yii\grid\SerialColumn','header' => '序号','headerOptions' => ['width' => '80']], 
            //'id',
            [
                'attribute' => "name",
                'header' => '姓名',
                'headerOptions' => ['width' => '180'],
            ],
            [
                'attribute' => "sfz",
                'header' => '身份证',
                'headerOptions' => ['width' => '60%'],
            ],
            //'sex',
            [
                'header' => "分数",
                'format' => 'raw',
                'value' => function($model){
                    return $model['score'].Html::input('hidden','score[]', $model['score'].'-'.$model['sfz'],['id'=>'taxis_'.$model['sfz'],'size'=>5]);
                }
            ],
         ],
    ]); ?>
<?php
    $taxis_url = Url::to(['jianding/importdata']);
    //判断权限需要用到的参数
    $auth = Yii::$app->authManager;
    $userid = Yii::$app->user->identity->id;
    //if($auth->checkAccess($userid,'menu_taxis')) {
        //echo Html::input("button", "", "确定导入", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:update_record('$taxis_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
        echo Html::submitButton("确定导入", ["class" =>"btn btn-sm btn-primary"]);
    //}
    ?>
    <input type="hidden" value="<?=$plan_id?>" name="plan_id">
</form>
<div class="importerror">以下数据错误</div>
<?= GridView::widget([
        'dataProvider' => $dataProvidererror,
        'summary' => '',
        'id'            => "waitforcheck",
        'columns' =>  [
            ['class' => 'yii\grid\SerialColumn','header' => '序号','headerOptions' => ['width' => '80']], 
            //'id',
            [
                'attribute' => "name",
                'header' => '姓名',
                'headerOptions' => ['width' => '180'],
            ],
            [
                'attribute' => "sfz",
                'header' => '身份证',
                'headerOptions' => ['width' => '60%'],
            ],
            //'sex',
            [
                'header' => "分数",
                'format' => 'raw',
                'value' => function($model){
                    return $model['score'].Html::input('hidden','score[]', $model['score'].'-'.$model['sfz'],['id'=>'taxis_'.$model['sfz'],'size'=>5]);
                }
            ],
         ],
    ]); ?>
</div>
    
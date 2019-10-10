<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaxrecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Taxrecords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxrecord-index">
<div class="widget-box">
		<div class="widget-header">
			<h4>查询条件</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
			                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            			</div>
		</div>
	</div>
<form action="" method="post" id="gridview_form">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'id'      => "waitforcheck",
        'columns' =>  [
        ['class' => 'yii\grid\SerialColumn','header' => '序号'],
            [
                'header' => "全选  ". Html::checkbox('',false,["onclick"=>"checkall(this.checked,'waitforcheck','ckbox')"]),
                'format' => 'raw',
                'headerOptions' => ['width' => '80'],
                'value' => function($model){
                    return Html::checkbox("ckbox[]", false, ["value"=>$model['id']]);
                }
            ],
            //'id',
            'taitou',
            'taxno',
            [
                'attribute' => 'taxnum',
                'header' => '开票金额（元）'
            ],
            'tax_time:datetime',
            //'mid',
            [
                'attribute' => "mid",
                'format' => 'raw',
                'value' => function($model){
                        return $model->mid?$model->getMember()->one()->name:'';
                },
            ],
            [
                'attribute' => "isdone",
                //'header' => "支付状态",
                'format' => 'raw',
                'headerOptions' => ['width' => '100'],
                'value' => function($model){
                    return $model->isdone?'<span class="red">已开票</span>':'未开票';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => '修改',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
							'class' => 'btn btn-xs btn-info',
                        ];
                        return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => '删除',
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', '确认删除？'),
                            'data-pjax' => '0',
							'class' => 'btn btn-xs btn-danger',
                            'onclick' => 'sweetConfirmChange("确定要删除么","'.$url.'")',
                        ];
                        return Html::button('<i class="icon-trash bigger-120"></i>', $options);
                    },
                ]
            ],
         ],
    ]); ?>

    <?php
    $taxis_url = Url::to(['taxrecord/taxdone']);
    /*$onecun_url = Url::to(['jianding/onecun']);
    $twocun_url = Url::to(['jianding/twocun']);
    $sfz_url = Url::to(['jianding/sfz']);*/
    //判断权限需要用到的参数
    $auth = Yii::$app->authManager;
    $userid = Yii::$app->user->identity->id;
    //if($auth->checkAccess($userid,'menu_taxis')) {
    echo Html::input("button", "", "开票", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:update_record('$taxis_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"])."&nbsp";
    //echo Html::input("button", "", "打印身份证", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:update_record('$sfz_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"])."&nbsp";
    //echo Html::input("button", "", "打印1寸照", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:update_record('$onecun_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"])."&nbsp";
    //echo Html::input("button", "", "打印2寸照", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:update_record('$twocun_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"])."&nbsp";
    //}
    ?>
</form>
</div>

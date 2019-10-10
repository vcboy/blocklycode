<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' =>  [
        ['class' => 'yii\grid\SerialColumn','header' => '序号'],

            //'id',
            'order_no',
            'price',
            'order_time:datetime',

            //'state',
            
            [
                'attribute' => "mid",
                'format' => 'raw',
                'value' => function($model){
                        return $model->mid?$model->getMember()->one()->name:'';
                },
            ],
            [
                'attribute' => "state",
                //'header' => "支付状态",
                'format' => 'raw',
                'headerOptions' => ['width' => '80'],
                'value' => function($model){
                    return $model->state?'已支付':'未支付';
                }
            ],
            [
                'attribute' => "plan_id",
                'format' => 'raw',
                'value' => function($model){
                        return $model->plan_id?$model->getPlan()->one()->name:'';
                },
            ],
            // 'mid',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $options = [
                            'title' => '查看',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'btn-xs btn btn-info',
                        ];
                        return Html::a('<i class="icon-zoom-in bigger-120"></i>', $url, $options);
                    },
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

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">
    <div class="widget-box1">
		<!-- <div class="widget-header">
            <h4>查询条件</h4>
        </div> -->
		<div class="widget-body1">
			<div class="widget-main">
			    <?php echo $model->name; ?>
                积分情况
            </div>
		</div>
	</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' =>  [
        ['class' => 'yii\grid\SerialColumn','header' => '序号'],

            //'id',
            // 'pass',
             'jf',
             'way',
            // 'source',
            // 'sid',
            [
                'attribute'=>'datetime',
                'value' => function($model){
                    //$str=substr($model['ctime'],0,10);
                    return $model['datetime']?date('Y-m-d H:i:s',$model['datetime']):'';
                },
            ], 
            /*[
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{delete}',
                'buttons' => [
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
            ],*/
         ],
    ]); ?>

</div>

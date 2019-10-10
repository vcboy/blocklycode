<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\Mark;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lession-index">
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
            'name',
            [
                'attribute' => "average",
                'format' => 'raw',
                'value' => function($model){
                        $mark = new Mark();
                        $average = $mark->getAverage('lession',$model->id);
                        $average = sprintf("%1\$.2f",$average);
                        return $average;
                        //return $model->course_id?$model->getLession()->one()->name:'';
                },
            ],
            //'img',
            //'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{mark} {update} {delete}',
                'buttons' => [
                    'mark' => function ($url, $model, $key) {
                        $options = [
                            'title' => '评分',
                            'aria-label' => Yii::t('yii', 'Mark'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-xs btn-info',
                        ];
                        $url = Url::to(['lession/mark','id'=>$model->id]);
                        return Html::a('<i class="icon-list bigger-120"></i>', $url, $options);
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

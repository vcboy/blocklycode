<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->order_no;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h3>订单号：<?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'price',
            'order_time:datetime',
            //'state',
            //'mid',
            [
                'attribute' => "mid",
                'value' => function($model){
                        return $model->mid?$model->getMember()->one()->name:'';
                },
            ],
            [
                'attribute' => "state",
                //'header' => "支付状态",
                'headerOptions' => ['width' => '80'],
                'value' => function($model){
                    return $model->state?'已支付':'未支付';
                }
            ],
            [
                'attribute' => "plan_id",
                'value' => function($model){
                    return $model->plan_id?$model->getPlan()->one()->name:'';
                },
            ],
            [
                'attribute'=>'source',
                'value' => function($model,$tabletype){
                    $tabletype=Yii::$app->params['tabletype'];
                    return $tabletype[$model->source];
                },
            ],
        ],
    ]) ?>

</div>

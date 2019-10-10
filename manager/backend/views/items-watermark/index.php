<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsWatermarkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items Watermarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-watermark-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Items Watermark', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'watermarkId',
            'watermarkName',
            'description',
            'coordinate',
            'scale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

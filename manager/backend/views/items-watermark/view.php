<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemsWatermark */

$this->title = $model->watermarkId;
$this->params['breadcrumbs'][] = ['label' => 'Items Watermarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-watermark-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->watermarkId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->watermarkId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'watermarkId',
            'watermarkName',
            'description',
            'coordinate',
            'scale',
        ],
    ]) ?>

</div>

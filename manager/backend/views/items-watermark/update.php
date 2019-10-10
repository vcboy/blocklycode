<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemsWatermark */

$this->title = 'Update Items Watermark: ' . ' ' . $model->watermarkId;
$this->params['breadcrumbs'][] = ['label' => 'Items Watermarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->watermarkId, 'url' => ['view', 'id' => $model->watermarkId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="items-watermark-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ItemsWatermark */

$this->title = 'Create Items Watermark';
$this->params['breadcrumbs'][] = ['label' => 'Items Watermarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-watermark-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

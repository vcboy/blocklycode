<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Zsinfo */

$this->title = 'Update Zsinfo: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Zsinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zsinfo-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

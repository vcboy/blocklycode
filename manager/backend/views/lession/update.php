<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lession */

$this->title = 'Update Lession: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lession-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

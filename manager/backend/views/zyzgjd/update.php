<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Zyzgjd */

$this->title = 'Update Zyzgjd: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Zyzgjds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zyzgjd-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

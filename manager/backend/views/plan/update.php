<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plan */

$this->title = '修改活动' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plan-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'tabletype' => $tabletype,
        'lession' => $lession,
        'teacher' => $teacher,
    ]) ?>
    </div>
</div>

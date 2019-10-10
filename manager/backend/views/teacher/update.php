<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = '教师修改: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'lession' => $lession,
    ]) ?>
    </div>
</div>

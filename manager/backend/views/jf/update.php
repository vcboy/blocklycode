<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jf */

$this->title = 'Update Jf: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jf-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

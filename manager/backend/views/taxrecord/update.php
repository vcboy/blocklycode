<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxrecord */

$this->title = '开票记录: ' . ' ' . $model->taitou;
$this->params['breadcrumbs'][] = ['label' => 'Taxrecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="taxrecord-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

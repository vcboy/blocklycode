<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jianding */

$this->title = '报名修改: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Jiandings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jianding-update">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'planlist' => $planlist,
        'eduarr' => $eduarr,
        'jobarr' => $jobarr,
        'edit' => 1,
    ]) ?>
    </div>
</div>

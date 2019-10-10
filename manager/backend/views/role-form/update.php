<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RoleForm */

$this->title = 'Update Role Form: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Role Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

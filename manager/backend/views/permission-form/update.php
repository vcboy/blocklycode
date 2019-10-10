<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PermissionForm */

$this->title = 'Update Permission Form: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Permission Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
    <?= $this->render('_form', [
        'model' => $model,
        'menuList' => $menuList,
    ]) ?>



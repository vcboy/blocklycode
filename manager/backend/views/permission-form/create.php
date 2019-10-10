<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\PermissionForm */

$this->title = 'Create Permission Form';
$this->params['breadcrumbs'][] = ['label' => 'Permission Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
        'model' => $model,
        'menuList' => $menuList,
    ]) ?>


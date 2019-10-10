<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\RoleForm */

$this->title = 'Create Role Form';
$this->params['breadcrumbs'][] = ['label' => 'Role Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platform-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
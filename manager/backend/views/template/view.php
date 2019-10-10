<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Template */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-view">
    <?= $this->render('_form', [
        'model' => $model,
        'action'=> 'view',
        'menulist'=>$menulist,
    ]) ?>
</div>

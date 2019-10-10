<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Jianding */

$this->title = '鉴定报名';
$this->params['breadcrumbs'][] = ['label' => 'Jiandings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jianding-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'planlist' => $planlist,
    ]) ?>
    </div>
</div>

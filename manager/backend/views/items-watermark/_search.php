<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemsWatermarkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-watermark-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'watermarkId') ?>

    <?= $form->field($model, 'watermarkName') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'coordinate') ?>

    <?= $form->field($model, 'scale') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

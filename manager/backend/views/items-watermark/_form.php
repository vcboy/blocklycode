<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemsWatermark */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-watermark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'watermarkId')->textInput() ?>

    <?= $form->field($model, 'watermarkName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coordinate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scale')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

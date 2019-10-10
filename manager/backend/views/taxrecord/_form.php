<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxrecord */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-header">
    <h1><?=$this->title?></h1>
</div>
<div class="taxrecord-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taitou')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxnum')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'tax_time')->textInput(['maxlength' => true,'value' => date("Y-m-d H:i:s",$model->tax_time),'readonly' => true]) ?>

    <?//= $form->field($model, 'mid')->textInput() ?>
    <div class="form-group field-taxrecord-mid">
    <label class="control-label" for="taxrecord-mid">申请人</label>
    <?php
    echo $model->getMember()->one()->name;
    ?>
    <div class="help-block"></div>
    </div>

    <div class="form-group">
    <?=  Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?=  Html::a('返回',Url::toRoute("index"),['class'=>'btn btn-primary'])?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

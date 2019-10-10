<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaxrecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxrecord-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="tabfield">
    <?//= $form->field($model, 'id') ?>

    <?= $form->field($model, 'taitou') ?>

    <?= $form->field($model, 'taxno') ?>

    <?= $form->field($model, 'taxnum') ?>

    <?//= $form->field($model, 'tax_time') ?>
    <div class="form-group field-taxrecordsearch-tax_time">
    <label class="control-label" for="taxrecordsearch-tax_time">申请时间</label>
    <?=Html::textInput('tax_time',isset($_GET['tax_time'])?$_GET['tax_time']:'',['onfocus' => 'WdatePicker({dateFmt:"yyyy-MM-dd"})','readonly' => 'false','class' => 'form-control','style' => 'width:120px']);?>
    <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'isdone')->dropDownList(array(''=>'--请选择--',0=>'未开票',1=>'已开票'),['class'=>'input-big form-control','id'=>'isdone']) ?>


    <?php // echo $form->field($model, 'mid') ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?//= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

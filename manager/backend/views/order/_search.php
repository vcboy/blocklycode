<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="tabfield">

    <?= $form->field($model, 'order_no') ?>

    <?= $form->field($model, 'price') ?>

    <?//= $form->field($model, 'order_time') ?>
    
    <div class="form-group field-ordersearch-order_time">
    <label class="control-label" for="ordersearch-order_time">订单时间</label>
    <?=Html::textInput('order_time',isset($_GET['order_time'])?$_GET['order_time']:'',['onfocus' => 'WdatePicker({dateFmt:"yyyy-MM-dd"})','readonly' => 'false','class' => 'form-control','style' => 'width:120px']);?>
    <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'state')->dropDownList(array(''=>'--请选择--',0=>'未支付',1=>'已支付'),['class'=>'input-big form-control','id'=>'state']) ?>

    <?php // echo $form->field($model, 'mid') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?//= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

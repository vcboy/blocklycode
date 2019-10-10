<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="tabfield">

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'tel') ?>

    <?//= $form->field($model, 'username') ?>
    <?= $form->field($model, 'getway')->dropDownList(array(''=>'--请选择--','1'=>'自取','2'=>'快递'),['class'=>'input-big form-control','style'=>'width:100px','id'=>'getway']) ?>
    <?= $form->field($model, 'source')->dropDownList(array(''=>'--请选择--')+$tabletype,['class'=>'input-big form-control','id'=>'source']) ?>

    <?php // echo $form->field($model, 'pass') ?>

    <?php // echo $form->field($model, 'jf') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'sid') ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

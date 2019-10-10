<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JiandingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jianding-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <? //= $form->field($model, 'id') ?>
    <div class="tabfield">
    <?= $form->field($model, 'plan_id')->dropDownList(array(''=>'--请选择--')+$planlist,['class'=>'input-big form-control','id'=>'plan_id']) ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'name') ?>

    <? //= $form->field($model, 'sex') ?>
    <?= $form->field($model, 'sex')->dropDownList(array(''=>'--请选择--','1'=>'男','0'=>'女'),['class'=>'input-big form-control','id'=>'sex']) ?>

    <?= $form->field($model, 'nation') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'sfz') ?>

    <?php // echo $form->field($model, 'bkzs') ?>

    <?php // echo $form->field($model, 'bkfx') ?>

    <?php // echo $form->field($model, 'zsdj') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'job') ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <? echo Html::a('导出', ['statistics'], ['class' => 'btn btn-sm btn-success']); ?>
        <? echo Html::a('成绩导入', ['import'], ['class' => 'btn btn-sm btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

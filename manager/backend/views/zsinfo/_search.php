<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZsinfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zsinfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="tabfield">

    <?= $form->field($model, 'plan_id') ?>

    <?= $form->field($model, 'source')->dropDownList(array(''=>'--请选择--')+$tabletype,['class'=>'input-big form-control','id'=>'source']) ?>

    <?= $form->field($model, 'zs_id') ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?//= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

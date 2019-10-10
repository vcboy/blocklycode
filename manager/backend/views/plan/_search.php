<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="tabfield">
    <? //= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'tabletype')->dropDownList(array(''=>'--请选择--')+$tabletype,['class'=>'input-big form-control','id'=>'tabletype']) ?>

    <?= $form->field($model, 'jf') ?>

    <? //= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'enddate') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?php
                    //判断权限需要用到的参数
                    $auth = Yii::$app->authManager;
                    $userid = Yii::$app->user->identity->id;
                    if($auth->checkAccess($userid,'plan_index')){
                        echo Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']);
                    }
        ?>
        <?//= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

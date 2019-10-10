<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZyzgjdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zyzgjd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="tabfield">
    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'plan_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'edu_level') ?>

    <?php // echo $form->field($model, 'card_type') ?>

    <?php // echo $form->field($model, 'sfz') ?>

    <?php // echo $form->field($model, 'nation') ?>

    <?php // echo $form->field($model, 'hukou_type') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'zipcode') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'zhiye_type') ?>

    <?php // echo $form->field($model, 'zhicheng_type') ?>

    <?php // echo $form->field($model, 'sbzy') ?>

    <?php // echo $form->field($model, 'sbjb') ?>

    <?php // echo $form->field($model, 'examtype') ?>

    <?php // echo $form->field($model, 'khkm') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton("查询", ["class" =>"btn btn-sm btn-primary"]) ?>
        <?= Html::a('重置', ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

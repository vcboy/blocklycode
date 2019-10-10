<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Zyzgjd */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-header">
    <h1><?=$this->title?></h1>
</div>
<div class="zyzgjd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edu_level')->textInput() ?>

    <?= $form->field($model, 'card_type')->textInput() ?>

    <?= $form->field($model, 'sfz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hukou_type')->textInput() ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zhiye_type')->textInput() ?>

    <?= $form->field($model, 'zhicheng_type')->textInput() ?>

    <?= $form->field($model, 'sbzy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sbjb')->textInput() ?>

    <?= $form->field($model, 'examtype')->textInput() ?>

    <?= $form->field($model, 'khkm')->textInput() ?>

    <?= $form->field($model, 'is_delete')->textInput() ?>


    <div class="form-group">
    <?=  Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?=  Html::a('返回',Url::toRoute("index"),['class'=>'btn btn-primary'])?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

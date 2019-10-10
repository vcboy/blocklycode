<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\JiandingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jianding-search">

    <?php $form = ActiveForm::begin([
        //'action' => ['import'],
        //'method' => 'post',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <? //= $form->field($model, 'id') ?>
    <div class="tabfield">
    <?= $form->field($model, 'plan_id')->dropDownList(array(''=>'--请选择--')+$planlist,['class'=>'input-big form-control','id'=>'plan_id']) ?>
    <?= $form->field($model, 'file')->fileInput() ?>
    <div><?=Html::a('模板文件下载',Url::to(['jianding/download'])) ?></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton("导入预览", ["class" =>"btn btn-sm btn-primary"]) ?>      
    </div>

    <?php ActiveForm::end(); ?>

</div>

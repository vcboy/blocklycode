<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-header">
    <h1><?=$this->title?></h1>
</div>
<div class="plan-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tabletype')->dropDownList(array(''=>'--请选择--')+$tabletype,['class'=>'input-big form-control','id'=>'tabletype']) ?>

    <?= $form->field($model, 'company')->textInput() ?>
    <?= $form->field($model, 'bkfx')->textInput() ?>
    <?= $form->field($model, 'bkzs')->textInput() ?>
    <?= $form->field($model, 'zsdj')->textInput() ?>

    <?= $form->field($model, 'course_id')->dropDownList(array(''=>'--请选择--')+$lession,['class'=>'input-big form-control','id'=>'course_id']) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(array(''=>'--请选择--')+$teacher,['class'=>'input-big form-control','id'=>'teacher_id']) ?>

    <?php if(!$model->img){?>
        <?=$form->field($model,'img')->fileInput(['class'=>'form-control','id'=>'img']);?>
    <?php }else{?>
         <div class="form-group field-channel-type required" style="height: 160px">
            <label class="col-lg-1 control-label" for="channel-name">图片</label>
            <div class="col-lg-3" style="display: inline-block;padding: 0px;"><img src="<?=Yii::$app -> request -> baseUrl.'/..'.str_replace('\\', '/',$model->img);?>" style="vertical-align:text-top;margin-right:20px" height="150px;">
            <a href="<?=Url::to(['plan/delimg','id'=>$model['id']])?>">删除</a>    
            </div>       
        </div>
    <?}?>

    <?= $form->field($model, 'jf')->textInput() ?>  

    <?= $form->field($model, 'fee')->textInput() ?> 

    <?= $form->field($model, 'enddate')->textInput(['maxlength' => true,'onfocus' => 'WdatePicker({skin:"whyGreen",dateFmt:"yyyy/MM/dd"})']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
    <?=  Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?=  Html::a('返回',Url::toRoute("index"),['class'=>'btn btn-primary'])?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(function(){
        var tabletype = $("#tabletype").val();
        if(tabletype != 2){
            $(".field-plan-company").hide();
            $(".field-plan-bkfx").hide();
            $(".field-plan-bkzs").hide();
            $(".field-plan-zsdj").hide(); 
        }
       
        $("#tabletype").change(function () {
            var ss = $(this).val();
            if(ss== 2) {
                $(".field-plan-company").show();
                $(".field-plan-bkfx").show();
                $(".field-plan-bkzs").show();
                $(".field-plan-zsdj").show();
            } else{
                $(".field-plan-company").hide();
                $(".field-plan-bkfx").hide();
                $(".field-plan-bkzs").hide();
                $(".field-plan-zsdj").hide();
            } 
        })
    })
</script>

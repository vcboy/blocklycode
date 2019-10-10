<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $status_list=Yii::$app->params['course_status'];?>
<style>
 .note{clear:both;color:#b4bcc3;padding-top:5px;}
 .rmar{margin-right:18px;}
 .wrap{padding:0 12px;float:left;}
 .sdiv{float:left;width:105px;border:1px solid #e4eaec;padding-bottom:10px;}
 .sdiv .titlediv{border-bottom:1px solid #e4eaec;padding-bottom:10px;}
</style>
<div class="page-header">
    <h1><?=isset($action)?'查看直播':(($model ->isNewRecord)?'添加直播':'编辑直播');?></h1>
</div>
<div class="col-xs-12">
    <?php $form = ActiveForm::begin([
        'id' => 'my_form',
        'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); 
    ?>
    <?=$form->field($model,'name')->textInput();?>
    <?= $form->field($model, 'channel_id')->dropDownList(array(''=>'--请选择--')+$channel_list,['class'=>'input-big form-control','id'=>'course-channel']) ?>
    <?php if(!$model->img){?>
        <?=$form->field($model,'img')->fileInput(['class'=>'form-control']);?>
    <?php }else{?>
         <div class="form-group field-channel-type required">
            <label class="col-lg-1 control-label" for="channel-name">图片</label>
            <div class="col-lg-3"><img src="<?=Yii::$app -> request -> baseUrl.'/..'.str_replace('\\', '/',$model->img);?>" style="vertical-align:text-top;margin-right:20px" width="150px;">
            <a href="<?=Url::to(['course/delimg','id'=>$model['id']])?>">删除</a>
     
            </div>
        
        </div>
        <?}?>
    <?=$form->field($model,'teacher_name')->textInput();?>
    <?=$form->field($model,'live_start_time')->textInput(['class'=>'form-control','onfocus' => 'WdatePicker({skin:"whyGreen",dateFmt:"yyyy-MM-dd HH:mm:ss"})','readonly' => true]);?>
    <?=$form->field($model,'live_end_time')->textInput(['onfocus' => 'WdatePicker({skin:"whyGreen",dateFmt:"yyyy-MM-dd HH:mm:ss"})','readonly' => true]);?>
    <?//=$form->field($model, 'status')->dropDownList($status_list,['class'=>'input-big form-control','id'=>'course-status']) ?>
    <?=$form->field($model, 'is_home')->dropDownList(array('1'=>'是','0'=>'否'),['class'=>'input-big form-control','id'=>'course-home']) ?>
    <?=$form->field($model,'desc')->textarea(['id'=>'course-desc']);?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?= Html::submitButton($model->isNewRecord ? '　添加　' : '　修改　', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success']) ?>
            &nbsp;&nbsp;<?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
   </div>
   <?php ActiveForm::end(); ?>
</div>
<?php 
    if(Yii::$app->session->hasFlash('msg'))
       echo "<script>sweetAlert('".Yii::$app->session->getFlash('msg')."');</script>";
?>
<script type="text/javascript" src="<?php echo Yii::$app ->request -> baseUrl?>/ckeditor/ckeditor.js"></script>
<script>
    $("#course-channel").chosen();
    $("#course-status").chosen();
    $("#course-home").chosen();
    CKEDITOR.replace("course-desc");
</script>

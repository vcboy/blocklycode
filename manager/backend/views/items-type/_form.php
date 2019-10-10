<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Template;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Template */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
 .btn.disabled{font-size:14px;color:#333;letter-spacing: 1px;}
 .lmar{margin-left:13%;}
</style>
<div class="page-header">
    <h1><?=isset($action)?'查看视频分类':(($model ->isNewRecord)?'添加视频分类':'编辑视频分类');?></h1>
</div>
<div class="col-xs-12">
    <?php $form = ActiveForm::begin([
        'id' => 'my_form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); 
    ?>
    <?=$form->field($model,'typeName')->textInput();?>
    <?=$form->field($model,'desc')->textInput();?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?= Html::submitButton($model->isNewRecord ? '　添加　' : '　修改　', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success']) ?>
            &nbsp;&nbsp;<?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        
        </div>
   </div>
</div>
<?php 
    if(Yii::$app->session->hasFlash('msg'))
       echo "<script>sweetAlert('".Yii::$app->session->getFlash('msg')."');</script>";
?>
<script>
    $(function(){
            $('#my_form').submit(function(){
                if(!$.trim($('#itemstype-typename').val())){
                    sweetAlert('请输入分类名称！');
                    $('#itemstype-typename').focus(); 
                    return false;
                }
                    
            })
             
        })
</script>

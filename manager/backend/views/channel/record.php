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
     .note{clear:both;color:#b4bcc3;padding-top:5px;}
</style>
<div class="page-header">
    <h1>开启/关闭录制</h1>
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
    <?=$form->field($model,'name')->textInput(['readonly'=>'readonly'])?>
    <div class="form-group field-channel-need_record">
            <label class="col-lg-1 control-label" for="channel-need_record">开启录制</label>
            <div class="col-lg-3">
                <label>
                   <input name="Channel[need_record]" type="radio" class="ace" value="1" <?=$model->need_record?'checked':'';?> onchange="isOrNo(this.value);">
                   <span class="lbl"> 是</span>
                </label>
                &nbsp;&nbsp;
                <label>
                    <input name="Channel[need_record]" type="radio" class="ace"  value="0" <?=!$model->need_record?'checked':'';?> onchange="isOrNo(this.value);">
                    <span class="lbl"> 否</span>
                </label>
                <div class="note">*开启录制后，该频道每次直播都将自动开启录制！</div>
            </div>
    </div>
    <?//=$form->field($model,'filename')->textInput(['value'=>($model->need_record?$model->filename:$model->name),(!$model->need_record?'readonly':'0')]);?>
    <div class="form-group field-filename">
            <label class="col-lg-1 control-label" for="channel-filename">视频名称</label>
            <div class="col-lg-3">
            <?=Html::textInput('Channel[filename]',$model->need_record?$model->filename:$model->name,['class'=>'form-control','readonly'=>(!$model->need_record?'readonly':false),'id'=>'channel-filename'])?>
            <div class="note">录制后文件名，格式为filename_YYYYMMDD-HHmmssYYYYMMDD-HHmmss, 文件名录制起始时间（年月日时分秒) -录制结束时间（年月日时分秒)</div>
            </div>
            
    </div>
    <?=$form->field($model,'format')->dropDownList(array(1=>'FLV',0=>'MP4'));?>
    <div class="form-group field-duration">
            <label class="col-lg-1 control-label" for="channel-duration">切片长度</label>
            <div class="col-lg-3">
            <?=Html::textInput('Channel[duration]',$model->duration?$model->duration:'120',['id'=>'channel-duration','class'=>'form-control'])?>
            <div class="note">*切片长度设置最短5分钟，最长120分钟</div>
            </div>
            
    </div>
    <div class="form-group field-duration">
            <label class="col-lg-1 control-label" for="channel-duration">存放路径</label>
            <div class="col-lg-3" style="margin-top:5px;">点播--分类--直播录制
            </div>    
    </div>
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
    function isOrNo(vals){
        if(vals==0){
            $('#channel-filename').val('<?=$model->name?>');
            $('#channel-filename').attr('readonly','readonly');
            $('#channel-duration').val('120');
            $('#channel-duration').attr('readonly','readonly');
        }else{
            $('#channel-filename').val('<?=$model->name?>');
            $('#channel-filename').attr('readonly',false);
            $('#channel-duration').attr('readonly',false);
        }
    }
$("#channel-format").chosen();
    $(function(){
        $('#my_form').submit(function(){
            if($.trim($('#channel-duration').val())!=''&&$.trim($('#channel-duration').val())<5){
                sweetAlert('切片长度最短5分钟！');
                $('#channel-duration').focus(); 
                return false;
            }
                
        })
         
    })
</script>

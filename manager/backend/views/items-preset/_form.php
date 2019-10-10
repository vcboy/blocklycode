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
 .note{clear:both;color:#b4bcc3;padding-top:5px;}
 .rmar{margin-right:18px;}
 .wrap{padding:0 12px;float:left;}
 .sdiv{float:left;width:105px;border:1px solid #e4eaec;padding-bottom:10px;}
 .sdiv .titlediv{border-bottom:1px solid #e4eaec;padding-bottom:10px;}
</style>
<div class="page-header">
    <h1><?=isset($action)?'查看课程':(($model ->isNewRecord)?'添加课程':'编辑课程');?></h1>
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
    <?=$form->field($model,'presetName')->textInput(['style'=>'width:350px']);?>
    <div class="form-group field-channel-type">
            <label class="col-lg-1 control-label" for="channel-name">转码格式选择</label>
            <div class="wrap">
                <div class="sdiv rmar" id="sddiv"> 
                    <div class="checkbox titlediv" >
                        <label>
                            <input type="checkbox" class="ace" onclick="checkall(this.checked,'sddiv','sd');" name="format[]" value="sd" <?=$model->sdMp4||$model->sdFlv||$model->sdHls?'checked':'';?>>
                            <span class="lbl"> 标清</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="sd[]" value='Mp4' onclick="checkParent(this.checked,'sddiv','format','sd');" <?=$model->sdMp4?'checked':'';?>>
                            <span class="lbl"> MP4</span>
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="sd[]" value='Flv' onclick="checkParent(this.checked,'sddiv','format','sd');" <?=$model->sdFlv?'checked':'';?>>
                            <span class="lbl"> FLV</span>
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="sd[]" value='Hls' onclick="checkParent(this.checked,'sddiv','format','sd');" <?=$model->sdHls?'checked':'';?>>
                            <span class="lbl"> HLS</span>
                        </label>
                    </div>
                </div>
                <div class="sdiv rmar" id="hddiv">
                    <div class="checkbox titlediv">
                        <label>
                            <input  type="checkbox" class="ace" onclick="checkall(this.checked,'hddiv','hd');" name="format[]" value="hd" <?=$model->hdMp4||$model->hdFlv||$model->hdHls?'checked':'';?>>
                            <span class="lbl"> 高清</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="hd[]" value='Mp4' onclick="checkParent(this.checked,'hddiv','format','hd');" <?=$model->hdMp4?'checked':'';?>>
                            <span class="lbl"> MP4</span>
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="hd[]" value='Flv' onclick="checkParent(this.checked,'hddiv','format','hd');" <?=$model->hdFlv?'checked':'';?>>
                            <span class="lbl"> FLV</span>
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="hd[]" value='Hls' onclick="checkParent(this.checked,'hddiv','format','hd');" <?=$model->hdHls?'checked':'';?>>
                            <span class="lbl"> HLS</span>
                        </label>
                    </div>
                </div>
                <div class="sdiv" id="shddiv">
                    <div class="checkbox titlediv">
                        <label>
                            <input  type="checkbox" class="ace" onclick="checkall(this.checked,'shddiv','shd');" name="format[]" value="shd" <?=$model->shdMp4||$model->shdFlv||$model->shdHls?'checked':'';?>>
                            <span class="lbl"> 超高清</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" class="ace" name="shd[]" value='Mp4' onclick="checkParent(this.checked,'shddiv','format','shd');" <?=$model->shdMp4?'checked':'';?>>
                            <span class="lbl"> MP4</span>
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="shd[]" value='Flv' onclick="checkParent(this.checked,'shddiv','format','shd');" <?=$model->shdFlv?'checked':'';?>>
                            <span class="lbl"> FLV</span>
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            <input  type="checkbox" class="ace" name="shd[]" value='Hls' onclick="checkParent(this.checked,'shddiv','format','shd');" <?=$model->shdHls?'checked':'';?>>
                            <span class="lbl"> HLS</span>
                        </label>
                    </div>
                </div>
                <div class="note">注:请至少选择一种转码格式</div>
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
    $(function(){
        var is=0;
        $('#my_form').submit(function(){
            if(!$.trim($('#itemspreset-presetname').val())){
                sweetAlert('请输入模板名称！');
                $('#itemspreset-presetname').focus(); 
                return false;
            }
            $(':checkbox[name="format[]"]').each(function(){
                if($(this).prop('checked')){
                    is=1;
                }
            })
            if(!is){
                sweetAlert('请至少选择一种转码格式！');
                return false;
            }      
        })
             
    })
    function checkParent(checked,p,name,selfs){
        var is=0;
        if(!checked){
            $('#'+p+' :checkbox[name="'+name+'[]"]').prop('checked', checked);
            return;
        }
        $(':checkbox[name="'+selfs+'[]"]').each(function(){
            if(!$(this).prop('checked')){
                is=1;
                return false;
            }
        })
        if(!is)
            $('#'+p+' :checkbox[name="'+name+'[]"]').prop('checked', checked);

    }
</script>

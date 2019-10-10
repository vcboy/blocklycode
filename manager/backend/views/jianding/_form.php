    <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Jianding */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-header">
    <h1><?=$this->title?></h1>
</div>
<div class="jianding-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'plan_id')->dropDownList(array(''=>'--请选择--')+$planlist,['class'=>'input-big form-control','id'=>'plan_id']) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <? //= $form->field($model, 'sex')->textInput() ?>
    <?= $form->field($model, 'sex')->dropDownList(array(''=>'--请选择--','1'=>'男','0'=>'女'),['class'=>'input-big form-control','id'=>'sex']) ?>


    <?= $form->field($model, 'nation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true,'onfocus' => 'WdatePicker({skin:"whyGreen",dateFmt:"yyyy/MM/dd"})']) ?>

    <?= $form->field($model, 'sfz')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'bkzs')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'bkfx')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'zsdj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'score')->textInput() ?> 
    <?//= $form->field($model, 'education')->textarea(['rows' => 6]) ?>
    <div class="form-group field-jianding-education" >
        <div style="float: left;width:10%"><label class="control-label" style="width:100%" for="jianding-education">教育经历</label></div>
        <div id="j-education" style="float: left;">
        <?php
        if(empty($eduarr) || empty($edit)){
        ?>
            <div id="educationtemplate"  class="edute"  style="margin: 0px 0px 15px 0px;">
            时间:<input type="text" id="jianding-education_time" class="form-control" name="educationsj[]"  size="20" style="width: 150px;">
            学校:<input type="text" id="jianding-education_school" class="form-control" name="educationxx[]"  style="width: 150px;" >
            专业:<input type="text" id="jianding-education_zy" class="form-control" name="educationzy[]"  style="width: 150px;" >
            学历学位:<input type="text" id="jianding-education_xlxw" class="form-control" name="educationxl[]"  style="width: 150px;" >
            </div>
        <?
        }else{
            foreach ($eduarr as $key => $value) {
                //echo $key;
        ?>
            <div id="educationtemplate"  class="edute"  style="margin: 0px 0px 15px 0px;">
            时间:<input type="text" id="jianding-education_time" class="form-control" name="educationsj[]" value="<?=$value[0]?>"  size="20" style="width: 150px;">
            学校:<input type="text" id="jianding-education_school" class="form-control" name="educationxx[]" value="<?=$value[1]?>"  style="width: 150px;" >
            专业:<input type="text" id="jianding-education_zy" class="form-control" name="educationzy[]" value="<?=$value[2]?>"  style="width: 150px;" >
            学历学位:<input type="text" id="jianding-education_xlxw" class="form-control" name="educationxl[]" value="<?=$value[3]?>"  style="width: 150px;" >
            </div>       
        <?
            }
        }
        ?>
        </div>  
        <div style="float: left;">
            <div class="btn btn-xs btn-danger" href="#"  id="addEdu"> + </div>
            <div class="btn btn-xs btn-danger" href="#"  id="rmEdu"> - </div>
        </div>

    </div>
    <div style="clear: both"></div>
    <div class="form-group field-jianding-job" >
        <div style="float: left;width:10%"><label class="control-label" style="width:100%" for="jianding-job">工作经历</label></div>
        <div id="j-job" style="float: left;">
        <?php
        if(empty($jobarr) || empty($edit)){
        ?>    
            <div id="jobtemplate" class="jobte" style="margin: 0px 0px 15px 0px;">
            时间:<input type="text" id="jianding-job_time" class="form-control" name="jobsj[]"  size="20" style="width: 150px;">
            学校:<input type="text" id="jianding-job_school" class="form-control" name="jobxx[]"  style="width: 150px;" >
            专业:<input type="text" id="jianding-job_zy" class="form-control" name="jobzy[]"  style="width: 150px;" >
            </div>
         <?
        }else{
            foreach ($jobarr as $key => $value) {
        ?>
            <div id="jobtemplate" class="jobte" style="margin: 0px 0px 15px 0px;">
            时间:<input type="text" id="jianding-job_time" class="form-control" name="jobsj[]" value="<?=$value[0]?>" size="20" style="width: 150px;">
            学校:<input type="text" id="jianding-job_school" class="form-control" name="jobxx[]" value="<?=$value[1]?>" style="width: 150px;" >
            专业:<input type="text" id="jianding-job_zy" class="form-control" name="jobzy[]" value="<?=$value[2]?>" style="width: 150px;" >
            </div>
        <?
            }
        }
        ?>    
        </div>
        <div style="float: left;">
            <div class="btn btn-xs btn-danger"   id="addJob"> + </div>
            <div class="btn btn-xs btn-danger" href="#"  id="rmJob"> - </div>
        </div>

    </div>

    <?//= $form->field($model, 'job')->textarea(['rows' => 6]) ?>
    
    <div style="clear: both"></div>

    <div class="form-group">
    <?=  Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?=  Html::a('返回',Url::toRoute("index"),['class'=>'btn btn-primary'])?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(function(){
        $("#addEdu").click(function(){
            var len;
            var educontent = $("#educationtemplate").clone();
            $("#j-education").append(educontent);
            $('#rmEdu').attr('disabled', false);
            len = $(".edute").length;
            if(len == 5) {
                $("#addEdu").attr('disabled',true);
            }
            console.log(len);
        })

        $("#rmEdu").click(function(){
            var len = $(".edute").length;
            if(len-1 == 1)
                $('#rmEdu').attr('disabled', true);
            $(".edute").eq(-1).remove();
            $("#addEdu").attr('disabled',false);
        })
        var len = $(".edute").length;
        if(len == 1)
            $("#rmEdu").attr('disabled',true);


        $("#addJob").click(function(){
            var len;
            var educontent = $("#jobtemplate").clone();
            $("#j-job").append(educontent);
            $('#rmJob').attr('disabled', false);
            len = $(".jobte").length;
            if(len == 5) {
                $("#addJob").attr('disabled',true);
            }
            console.log(len);
        })

        $("#rmJob").click(function(){
            var len = $(".jobte").length;
            if(len-1 == 1)
                $('#rmJob').attr('disabled', true);
            $(".jobte").eq(-1).remove();
            $("#addJob").attr('disabled',false);
        })
        var len = $(".jobte").length;
        if(len == 1)
            $("#rmJob").attr('disabled',true);
    })
    function addEducation(){
        var educontent = $(".educationtemplate").clone();
        $("#j-education").append(educontent);
    }
</script>
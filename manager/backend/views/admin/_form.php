<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Userbc;
use backend\models\RoleForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-header">
    <h1><?=($model -> isNewRecord)?'添加用户':'修改用户';?></h1>
</div>
<div class="col-xs-12">

    <?php $form = ActiveForm::begin([
        'id' => 'my_form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'value'=>'']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(Yii::$app->params['gender']) ?>
    <?php
        $roleList = RoleForm::getRoleList();
        unset($roleList[0]);
        echo $form->field($model, 'role_name')->dropDownList($roleList);
    ?>
    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $("#admin-courseids").chosen({
        width:"100%"
    });
    $("#admin-disciplineids").chosen({
        width:"100%"
    });
    $("#admin-role_name").change(function(){
        if($(this).val() == 'teacher'){
            $("#coursedisdiv").show();
        }else{
            $("#coursedisdiv").hide();
        }
    });
    if($("#admin-role_name").val() == 'teacher'){
        $("#coursedisdiv").show();
        var userid = '<?php echo $model -> id;?>';
        $.ajax({
            url:'<?php echo Url::to(['show-course']);?>',
            type:'post',
            data:{userid:userid},
            dataType:'json',
            success:function(res){
                $("#admin-courseids").chosen("destroy");
                if(res.course){
                    var courseids = res.course.split(',');
                    $("#admin-courseids").prev().val(res.course);
                    $('#admin-courseids option').each(function(i){
                        if(courseids[i] == $(this).val()){
                            $(this).prop("selected",true);
                        }
                    });
                }
                $("#admin-courseids").chosen();

                $("#admin-disciplineids").chosen("destroy");
                if(res.discipline){
                    var discids = res.discipline.split(',');
                    $("#admin-disciplineids").prev().val(res.discipline);
                    $('#admin-disciplineids option').each(function(i){
                        if(discids[i] == $(this).val()){
                            $(this).prop("selected",true);
                        }
                    });
                }
                $("#admin-disciplineids").chosen();
            }
        });
        $("#admin-courseids").val();
    }
</script>

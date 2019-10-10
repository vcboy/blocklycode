<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="page-header">
    <h1>修改密码</h1>
</div>
<div class="col-xs-12">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?=$form->field($model, 'username')-> textInput(['maxlength' => true,'readonly' => true]) ?>
    <?=$form->field($model, 'oldpassword')-> passwordInput(['maxlength' => true,'value' => '']) ?>
    <?=$form->field($model, 'password')-> passwordInput(['maxlength' => true,'value' => '']) -> label('新密码') ?>
    <?=$form->field($model, 'checkpassword')-> passwordInput(['maxlength' => true,'value' => ''])?>

    <?= Html::submitButton('修改', ['class' => 'btn btn-primary','id' => 'editpassword']) ?>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    $("#editpassword").click(function(){
        if($("#admin-password").val() != $("#admin-checkpassword").val()){
            sweetAlert('确认密码不一致，请重新输入！');
            $("#admin-password").val('');
            $("#admin-checkpassword").val('');
            return false;
        }
        if($("#admin-oldpassword").val() == ''){
            sweetAlert('请输入原密码！');
            return false;
        }

        if($("#admin-password").val() == ''){
            sweetAlert('请输入新密码！');
            return false;
        }
    });
    <?php if(Yii::$app -> session -> getFlash('message')){?>
        sweetAlert('<?php echo Yii::$app -> session -> getFlash('message');?>');
    <?php }?>

</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="widget-box widget_tableDiv">
    <div class="widget-header widget-header-small"><h5 class="lighter">查询条件</h5></div>
    <div id="filter_show" class="widget-body">
        <div class="widget-main">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'fieldConfig' => [
                    'template' => "<div class='form-group' style='float: left;width:400px;'>{label} {input}</div>",
                    'labelOptions' => ['style' => 'width:60px;'],
                ],
            ]);
            ?>
                <?= $form->field($model, 'name')->input('text',['class'=>'input-small']) ?>
                <?= $form->field($model, 'parent')->dropDownList($menuList) ?>
            <table style="width: 100%;">
                <tr><td>
                    <div class="form-group">
                    <?= Html::submitButton("查询", ["class" =>"btn btn-primary btn-sm"])?>
                    <?= Html::a("重置", ['index'], ["class" =>"btn btn-primary btn-sm"])?>
                    <?php
                    //判断权限需要用到的参数
                    $auth = Yii::$app->authManager;
                    $userid = Yii::$app->user->identity->id;
                    if($auth->checkAccess($userid,'menu_create')) {
                        echo Html::a('添加', ['create'], ['class' => 'btn btn-sm btn-success']);
                    }
                    ?>
                    </div>
                </td></tr>
            </table>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#menusearch-parent").chosen({
        width : "180px",
    });
</script>
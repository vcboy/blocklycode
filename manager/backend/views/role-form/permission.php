<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RoleFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<form action="" method="post" id="gridview_form">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">相关信息</h3>
        </div>
        <div class="panel-body">
            <label for="name"><b>继承以下角色的权限</b></label>
            <div>
            <?php
            foreach($otherRoleData as $k => $v){
                $checked = false;
                if(array_key_exists($v->name,$children)){
                    $checked = true;
                }
                //echo $v->description.':'.Html::checkbox("rolebox[]", $checked, ['value'=>$v->name]);
                echo '<label class="checkbox-inline">'.Html::checkbox("rolebox[]", $checked, ['value'=>$v->name]).$v->description.'</label>';
            }
            ?>
            </div>
            <label for="name"><b>角色信息</b></label>
            <div>
                <label class="checkbox-inline">角色名称：<?php echo $roleData->description;?></label>
                <label class="checkbox-inline">角色编码：<?php echo $roleData->name;?></label>
            </div>
            <div><?= Html::submitButton("更新权限", ["class" =>"btn btn-primary btn-sm"])?></div>
        </div>
    </div>
    <div class="table-responsive">
    <table  class="table table-striped table-bordered table-hover" class="list_table" id="waitforcheck" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th>序号</th>
            <th>菜单</th>
            <th>权限  <?php echo  "全选  ". Html::checkbox('',false,["onclick"=>"checkall(this.checked,'waitforcheck','ckbox')"]);?></th>
        </tr>
        <?php
        $i = 0;
        foreach($menuList as $k => $v){
            $i ++;
        ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $v['name'];?></td>
                <td>
                   <?php
                    //print_r($children);
                    //print_r($v['permission']);
                    foreach($v['permission'] as $k => $v){
                        $checked = false;
                        if(array_key_exists($k,$children)){
                            $checked = true;
                        }
                        echo $v.':'.Html::checkbox("ckbox[]", $checked, ['value'=>$k]);
                    }
                   ?>
                </td>
            </tr>
        <?php } ?>
    </table>
        </div>
</form>
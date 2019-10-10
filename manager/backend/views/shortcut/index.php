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
            <h3 class="panel-title">角色信息</h3>
        </div>
        <div class="panel-body" style="height: 100px;">
            <label for="name"><b>用户名称：</b><?php echo $adminData->name;?></label>
            <div><?= Html::submitButton("更新快捷入口", ["class" =>"btn btn-primary btn-sm"])?></div>
        </div>
    </div>
    <table  class="table table-striped table-bordered table-hover" class="list_table" id="waitforcheck" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th>序号</th>
            <th>菜单</th>
            <th>选择  <?php echo  "全选  ". Html::checkbox('',false,["onclick"=>"checkall(this.checked,'waitforcheck','ckbox')"]);?></th>
        </tr>
        <?php
        $i = 0;
        $my_quickentry = [];
        if(!empty($adminData->my_quickentry)){
            $my_quickentry = json_decode($adminData->my_quickentry);
            $my_quickentry = objectToArray($my_quickentry);
        }
        foreach($menuList as $k => $v){
            $i ++;
            if(!empty($v['url'])) {
                $checked = false;
                if(array_key_exists($v['id'],$my_quickentry)){
                    $checked = true;
                }
                echo '<tr><td>'.$i.'</td><td>'.$v['name'].'</td><td>'.Html::checkbox("ckbox[]", $checked, ['value' => $v['id']]).'</td></tr>';
            }else{
                echo '<tr><td>'.$i.'</td><td>'.$v['name'].'</td><td>&nbsp;</td></tr>';
            }
            if(!empty($v['sons'])){
                foreach($v['sons'] as $k_1 => $v_1){
                    $i ++;
                    if(!empty($v_1['url'])) {
                        $checked = false;
                        if(array_key_exists($v_1['id'],$my_quickentry)){
                            $checked = true;
                        }
                        echo '<tr><td>'.$i.'</td><td>&nbsp;&nbsp;┕━'.$v_1['name'].'</td><td>'.Html::checkbox("ckbox[]", $checked, ['value' => $v_1['id']]).'</td></tr>';
                    }else{
                        echo '<tr><td>'.$i.'</td><td>&nbsp;&nbsp;┕━'.$v_1['name'].'</td><td>&nbsp;</td></tr>';
                    }
                    if(!empty($v_1['sons'])){
                        foreach($v_1['sons'] as $k_2 => $v_2){
                            $i ++;
                            if(!empty($v_2['url'])) {
                                $checked = false;
                                if(array_key_exists($v_2['id'],$my_quickentry)){
                                    $checked = true;
                                }
                                echo '<tr><td>'.$i.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;┕━'.$v_2['name'].'</td><td>'.Html::checkbox("ckbox[]", $checked, ['value' => $v_2['id']]).'</td></tr>';
                            }else{
                                echo '<tr><td>'.$i.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;┕━'.$v_2['name'].'</td><td>&nbsp;</td></tr>';
                            }
                        }
                    }
                }
            }
        }
        ?>
    </table>
</form>
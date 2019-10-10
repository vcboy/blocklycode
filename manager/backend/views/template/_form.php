<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Template;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Template */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-header">
    <h1><?=isset($action)?'查看模板':(($model ->isNewRecord)?'添加模板':'修改模板');?></h1>
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
    <div class="space-4"></div>
    <div class="form-group field-permissionform-name required">
        <label class="col-lg-2 control-label">模板名称</label>
        <div class="col-lg-3"><?=Html::textInput('name',$model['name'],['class'=>'form-control','onchange'=>'changeName(this.value);']);?></div>
    </div>
    <div class="space-4"></div>
    <div class="form-group field-permissionform-name required remove">
        <label class="col-lg-2 control-label">学习系统导航菜单</label>
        <div class="col-lg-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="checkAll1" onclick="checkall(this.checked,'waitforcheck1','lms_nav')" class="ace ace-checkbox-2">
                    <span class="lbl">　全选</span>
                </label>
                <span  class="shou shou1" title="展开或伸缩"><i class="orange icon-folder-open" ></i></span>
            </div>
            <div id="waitforcheck1">
            <?php
                $arr=Template::getLmsnav();
                $my_arr=array();
                if(!$model->isNewRecord){
                    $my_arr=$model->getMylmsnav();
                    if($my_arr&&count($my_arr)>0)
                        $my_arr=array_keys($my_arr);
                }
                foreach ($arr as $key => $value){
                    echo '<div class="checkbox">';
                    echo '<label>';
                    echo Html::checkbox('lms_nav[]',$my_arr&&in_array($key,$my_arr,true)?'true':'',['class'=>'ace','value'=>$key]);
                    echo '<span class="lbl">　'.$value.'</span>';
                    echo '</label>';
                    echo '</div>';
                }?>
            </div>
        </div>    
    </div>
    <div class="space-4"></div>
    <div class="form-group field-permissionform-name required remove">
        <label class="col-lg-2 control-label">管理系统导航菜单</label>
        <div class="col-lg-3" style="width:40%;">
             <div class="checkbox">
                <label>
                    <input type="checkbox" name="checkAll1" onclick="checkall2(this.checked)" class="ace ace-checkbox-2">
                    <span class="lbl">　全选</span>
                </label>
                <span onclick="showhidd2()" class="shou shou2" title="展开或伸缩"><i class="orange icon-folder-open" ></i></span>
            </div>
            <div style="height:20px;clear:both;"></div>
            <table id="table_auth" class="table  table-bordered" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <th colspan="2" width="20%" height="30px;">菜单</th>
                    <th width="60%" colspan="">权限</th>
                </tr>
                <?
                $backend_template=json_decode($model->backend_template,true);
                $perms=array();
                if($backend_template&&!empty($backend_template['perms']))
                    $perms=$backend_template['perms'];
                foreach ($menulist as $k => $v) {
                    ?>
                    <tr>
                        <td  class="authlbl" colspan="2" >
                            <label>
                                <!--<?php if(count($v['permission'])>0){?><input type="checkbox" name="checkAll1" class="ace ace-checkbox-2" onclick="check_gauth(this)"><?php }?>-->
                                 <span class="lbl" style="font-size:12px;"> <?php echo $v['name'];?></span>
                            </label>
                        </td>
                        <td style="text-align: left;padding-left: 10px;" height="30px;">
                            <?php
                            foreach($v['permission'] as $k1 => $v1){
                                    $checked ='';
                                    if(array_key_exists($k1,$perms)){
                                        $checked = "checked";
                                    }
                                ?>
                                <label style="padding-right:10px;"> 
                                    <input type="checkbox" name="perms[<?=$k?>][]" id="perms[<?=$k1?>]" value="<?=$k1?>"  <?php echo $checked;?> class="ace sonbox">
                                <span class="lbl" style="font-size:12px;"> <?php echo $v1;?> </span>
                                </label>
                            <?php }?>
                        </td>
                    </tr>
                <? }?>
        </table><br>
        </div>    
    </div>
    <?php if(!$model->isNewRecord){?>
         <div class="form-group  required">
            <label class="col-lg-2 control-label">是否应用到所有站点中</label>
            <div class="col-lg-3"><?=Html::dropDownList('is_save',0,array('0'=>'否','1'=>'是'));?></div>
            </div>
        <div class="space-4"></div>
    <?php }?>
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <?php if(!isset($action)){?>
            <?= Html::submitButton($model->isNewRecord ? '　添加　' : '　修改　', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success']) ?>
            <?php }?>
            &nbsp;&nbsp;<?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        
        </div>
   </div>
    <div class="space-4"></div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    table th{text-align: center;height:35px;background: #f9f9f9;color:#669fc7;font-size: 14px;}
    table .atabl td{text-align: left;height:35px;color:#669fc7;font-weight:bold;}
    .remove .col-lg-3 label:after{content: '';}
    .shou{display: inline-block;font-size:22px;position:absolute;left:180px;top:5px;}
</style>
<script>
    $(function(){
        <?php if(isset($action)){?>
            $('input').prop('disabled','disabled');
        <?php }?>
        //表单提交
        var index=0;
        $('#my_form').submit(function(){
             if(!$.trim($('[name="name"]').val())){
                sweetAlert('请填写模板名称！');
                return false;
             }else{
                changeName($.trim($('[name="name"]').val()));
             }
             /*if(!$.trim($('[name="lms_css_file"]').val())){
                sweetAlert('请填写学习系统css地址！');
                return false;
             }*/
             if(!$('#waitforcheck1 :checkbox:checked').size()){
                sweetAlert('请选择学习系统导航菜单！');
                return false;
             }
             /*if(!$.trim($('[name="backend_css_file"]').val())){
                sweetAlert('请填写管理系统css地址！');
                return false;
             }*/
             if($('table .sonbox:checked').size()<1){
                sweetAlert('请选择管理系统权限！');
                return false;
             }
             
        })
        //展开或伸缩
        $('.shou1').click(function(){
            $('#waitforcheck1').toggle();
        })
        $('.shou2').click(function(){
            $('#table_auth tbody').toggle();
        })
       
    })
    //检查模块名称重名
    function changeName(vals){
        if($.trim(vals)){
            $.ajax({
                type: "post",
                url:'<?php echo Url::to(["checkname"]);?>',
                dataType: "json",
                data: {'name': $.trim(vals),'id':"<?=$model->isNewRecord?'':$model->id;?>"},
                success: function(data){
                    if(data.is_name){
                        sweetAlert('模板名称"'+$.trim(vals)+'"重名！');
                        return false;
                    }else
                        return true;
                }
            });

        }
    }
    //模块全选功能
    function check_gauth(t) {
        $(t).parent().parent().parent().nextUntil('.atabl').find(':checkbox').prop('checked', t.checked);
    }
    function checkall2(vals){
        $('#table_auth :checkbox').attr('checked',vals);
    } 
</script>

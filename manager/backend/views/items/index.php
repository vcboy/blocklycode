<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use job\lib\JobGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.red{color:red;}
.pdiv{margin:10px 0;}
.pdiv .btn{margin-right:5px;}
</style>
<?php  echo $this->render('_search', ['model' => $searchModel,'type_list'=>$type_list]); ?>
<form action="" method="post" id="gridview_form">
    <div class="table-responsive">
    <div class="pdiv">
       <?php
            $common_url = Url::to(['items/common']);
            $disabled_url = Url::to(['items/disabled','status'=>'50']);
            $resume_url = Url::to(['items/disabled','status'=>'40']);
            $delete_url = Url::to(['items/delete']);
            $preset_url = Url::to(['items/preset']);
            //判断权限需要用到的参数
            $auth = Yii::$app->authManager;
            $userid = Yii::$app->user->identity->id;
            //if($auth->checkAccess($userid,'menu_taxis')) {
            echo Html::input("button", "", "数据同步", ["class" => "btn btn-sm btn-primary", "onclick" => "javascript:common('$common_url')"]);
            //}
            echo Html::input("button", "", "屏蔽", ["class" => "btn btn-sm btn-gray", "onclick" => "javascript:if(checkStatus(50)) update_record('$disabled_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
            echo Html::input("button", "", "恢复", ["class" => "btn btn-sm btn-success", "onclick" => "javascript:if(checkStatus(40)) update_record('$resume_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
            echo Html::input("button", "", "删除", ["class" => "btn btn-sm btn-danger", "onclick" => "javascript:update_record('$delete_url', 'gridview_form', '您还未选择内容，请勾选后再进行操作')"]);
            echo Html::input("button", "", "转码", ["class" => "btn btn-sm btn-warning", "onclick" => "javascript:getPreset(30,'您还未选择内容，请勾选后再进行操作')"]);
        ?>
    </div>
    <?= JobGridView::widget([
        'dataProvider'  => $dataProvider,
         'summary'       => '',
        'id'            => "waitforcheck",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '序号'],
            [
                'header' => "全选  ". Html::checkbox('',false,["onclick"=>"checkall(this.checked,'waitforcheck','ckbox')"]),
                'format' => 'raw',
                'value' => function($model){
                    if($model->is_exists)
                        return Html::checkbox("ckbox[]", false, ["value"=>$model['vid'],'data-status'=>$model['status']]);
                    else
                         return Html::checkbox("ckbox[]", false, ["value"=>$model['vid'],'data-status'=>$model['status'],'disabled'=>'disabled']);
                }
            ],
            [
                'attribute'=>'snapshotUrl',
                'format' => 'raw',
                'value' => function($model){
                    return '<img width="89" height="50" alt="视频封面" src="'.($model['snapshotUrl']?$model['snapshotUrl']:'http://vcloud.163.com/static/admin/style/img/face-default-2918995f22.jpg ').'"/>';             
                },
            ],
            'videoName',
            'vid',
            [
                'attribute'=>'initialSize',
                'value' => function($model){
                    //$str=substr($model['ctime'],0,10);
                    return ($model['initialSize']/1024/1024)>20?round($model['initialSize']/1024/1024/1024,2).'GB':round($model['initialSize']/1024/1024,2).'MB';
                },
            ],
            [
                'attribute'=>'duration',
                'value' => function($model){
                    $h=sprintf('%02d',intval($model['duration']/(60*60)));
                    $i=sprintf('%02d',intval($model['duration']%(60*60)/60));
                    $s=sprintf('%02d',intval($model['duration']%(60*60)%60));
                    return $h.':'.$i.':'.$s;
                },
            ],
               [
                'format' => 'raw',
                'attribute'=>'typeId',
                'value' => function($model){
                     return $model->typeId?$model->getItemsType()->one()->typeName:'';
                },
            ],
            
            [
                'format' => 'raw',
                'attribute'=>'status',
                'value' => function($model){
                    $arr=Yii::$app->params['video_status'];
                    $color=$model['status']==2?'red':'';
                    return '<span class="'.$color.'">'.$arr[$model['status']].'</span>';
                },
            ],
            [
                'format' => 'raw',
                'attribute'=>'is_exists',
                'value' => function($model){
                    $arr=array(0=>'否',1=>'是');
                    $color=$model['is_exists']==0?'red':'';
                    return '<span class="'.$color.'">'.$arr[$model['is_exists']].'</span>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {address} {delete}',
                'buttons' => [
                    'view' => function($url,$model){
                        $options = [
                            'title' => '查看',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' =>'btn-xs btn btn-warning',
                        ];
                        return Html::a('<i class="icon-zoom-in bigger-120"></i>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => '编辑',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-success',
                        ];
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_update')) {
                        if($model->is_exists&&$model->status!=30)
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        //}
                    },
                    'address' => function($url,$model){
                        $options = [
                            'title' => '地址',
                            'aria-label' => Yii::t('yii', 'address'),
                            'data-pjax' => '0',
                            'class' =>'btn btn-xs btn-purple',
                        ];
                        if($model->is_exists&&$model->status!=30&&$model->status!=50)
                         return Html::a('<i class="icon-asterisk  bigger-120"></i>', $url, $options);
                    },
                   
                    'delete' => function ($url, $model, $key) {
                        //判断权限需要用到的参数
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        //if($auth->checkAccess($userid,'template_delete')) {
                            //return Html::a('<button class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>', $url, $options);
                            $url = Url::to(['items/delete','vid'=>$model['vid']]);
                            return Html::a('<lable class="btn btn-xs btn-danger" title="删除"><i class="icon-trash bigger-120"></i></lable>', '#', ['onclick'=>'javascript:sweetConfirmChange(\'你确定要删除吗?\',\''.$url.'\')']);
                        //}
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
    <!--转码-->
    <div id='presetdiv' style="display:none;" >
        <div style="margin-top:20px;">视频转码模板<?=Html::dropDownList('presetId','',$preset_list,['class'=>'input-big form-control','id'=>'presetId']) ?></div>
        <div style="color:green;font-size:12px;margin:10px 0 10px 0;">温馨提示：不在此模板中的原模板视频格式将继续保留，与原模板重复的格式不重新转码，只对新的格式进行转码</div>
        <div style="text-align:right;"><?=Html::a("确定",'#',["class" =>"btn btn-sm btn-primary","onclick"=>"setPreset();"])?>
                        <?=Html::a("取消",'#', ["class" =>"btn btn-sm btn-success","onclick"=>"javascript:top.$.unblockUI();"])?></div>
    </div>
</form>

<?php 
    if(Yii::$app->session->hasFlash('msg'))
       echo "<script>sweetAlert('".Yii::$app->session->getFlash('msg')."');</script>";
?>
<script>
    function common($url){
        //alert($url);
        $('#gridview_form').attr('action',$url);
        $('#gridview_form').submit();
    }
    function checkStatus(status){
        var i=0;
        var title='';
        $("[name='ckbox[]']:checked").each(function(){
            if((status==40||status==50)&&$(this).attr('data-status')==30){
                title='执行屏蔽或恢复操作时不能选中转码中状态的视频！';
                i=1;
            }  
            if(status==30&&($(this).attr('data-status')==30||$(this).attr('data-status')==50)){
                title='执行转码操作时不能选中转码中或屏蔽状态的视频！';
                i=1;
            }
        })
        if(i){
            sweetAlert(title);
            return false;
        }
        return true;
    }
    function getPreset(status,msg){
        var list = $("[name='ckbox[]']:checked");
        if(list.length<1){
            sweetAlert(msg);
            return false;
        }
        if(checkStatus(30)){
            $.get('', function(txt){
                    top.$.blockUI({
                        theme: true,
                        draggable: true,
                        title: '选择模板',
                        message: $('#presetdiv'),
                        themedCSS:{
                            width:"400px",
                            top:"160px",
                            left:"470px",
                            display: 'none',
                        }
                    });
                });
        }

    }
    function setPreset(){
        var presetId=$('#presetId').val();
        var data=$('#gridview_form').serialize()+'&presetId='+presetId;
        $.ajax({
            type : "post",
            method : "post",
            dataType : "json",
            data : data,
            url : "<?=Url::to(['set-preset'])?>",
            success : function(data) {
                sweetAlert(data.return.msg);
                if(data.return.code==200){
                    top.$.unblockUI();
                    window.location.reload();
                }
                   
            }
        });
    }
</script>


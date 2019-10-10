<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-index">
<div class="widget-box">
		<div class="widget-header">
			<h4>查询条件</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
			                <?php echo $this->render('_search', ['model' => $searchModel,'tabletype' => $tabletype]); ?>
            			</div>
		</div>
	</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' =>  [
        ['class' => 'yii\grid\SerialColumn','header' => '序号'],

            //'id',
            'name',
            //'tabletype',
            [
                'attribute' => "tabletype",
                'format' => 'raw',
                'value' => function($model,$tabletype){
                    $tabletype=Yii::$app->params['tabletype'];
                    return $tabletype[$model->tabletype];
                },
            ],
            'jf',
            //'description:ntext',
            // 'enddate',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {share} {delete}',
                'buttons' => [
                    'view' => function($url,$model){
                        $options = [
                            'title' => '打印报名表',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'btn-xs btn btn-info',
                            'target' => '_blank',
                        ];
                        /**
                         * 1: 职业资格鉴定
                         * 2: 商务委电子商务专业人才鉴定申请
                         * 3: 商务委电子商务培训报名
                         * 4: 教育局企业职工报名
                         */
                        switch ($model->tabletype) {
                            case '1':
                                $tabletype = 'zyzgjd';
                                break;
                            case '2':
                                $tabletype = 'jianding';
                                break;
                            case '3':
                                $tabletype = 'swwbm';
                                break;
                            case '4':
                                $tabletype = 'swwbm';
                                break;
                            default:
                                $tabletype = 'jianding';
                                break;
                        }
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'plan_index')) {
                            $url = Url::to([$tabletype.'/planprint','id'=>$model->id]);
                            return Html::a('<i class="icon-print bigger-120"></i>', $url, $options);
                        }
                    },
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => '修改',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
							'class' => 'btn btn-xs btn-info',
                        ];
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'plan_index')) {
                            return Html::a('<i class="icon-edit bigger-120"></i>', $url, $options);
                        }
                    },
                    'share' => function ($url, $model, $key) {
                        $options = [
                            'title' => '推广',
                            'aria-label' => Yii::t('yii', 'Share'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-xs btn-info',
                        ];
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'plan_share')) {
                            $url = Url::to(['plan/share','id'=>$model->id]);
                            //return Html::a('<i class="icon-share bigger-120"></i>', $url, $options);
                            return Html::a('<lable class="btn btn-xs btn-success" title="分享"><i class="icon-share bigger-120"></i></lable>', '#', ['onclick'=>"javascript:liveshare({$model['id']},{$model['tabletype']})"]);
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => '删除',
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', '确认删除？'),
                            'data-pjax' => '0',
							'class' => 'btn btn-xs btn-danger',
                            'onclick' => 'sweetConfirmChange("确定要删除么","'.$url.'")',
                        ];
                        $auth = Yii::$app->authManager;
                        $userid = Yii::$app->user->identity->id;
                        if($auth->checkAccess($userid,'plan_del')) {
                            return Html::button('<i class="icon-trash bigger-120"></i>', $options);
                        }
                    },
                ]
            ],
         ],
    ]); ?>

</div>
<script>
    function common($url){
        //alert($url);
        $('#gridview_form').attr('action',$url);
        $('#gridview_form').submit();
    }

    var clip = new ZeroClipboard( document.getElementsByClassName("copy2") );
    $('.copy2').click(function () {
        //alert('copy'); 
        $("#flashMsg").css('display','block');
        $("#flashMsg").css('background-color','#CDBE70');
        $("#flashMsg").html('<font style="color: #ff0000" >复制成功</font>');
        $(function () {
            setTimeout(function () {
                //$("#live_list").css('float','none');
               // $("#topAlert").css('display','none');
                $("#flashMsg").css('display','none');
                $("#flashMsg").html('');
            }, 3000);
        })
    })

    function liveshare(id,tabletype){
        var url = "/wap/index.php/baoming/plandetail/id/"+id+"/tabletype/"+tabletype;
        <?php
        $role_name = Yii::$app->user->identity->role_name;
        $zs_id = Yii::$app->user->identity->id;
        if($role_name == 'zhaosheng'){
            echo "url = url +'/userid/".$zs_id."';\n";
        }
        ?>
        $('#myModal').modal('show');
        var qrcode_url = "<?php echo Url::to(['plan/qrcode'])?>";
        qrcode_url+="?id="+id+"&tabletype="+tabletype;
        //var qrcode_url = "/wechatbaoming/wap/index.php/baoming/signup/id/"+id+"/tabletype/"+tabletype;
        var push_url = "<?php echo Yii::$app->request->hostInfo ?>"+url;
        $("#push_url").val(push_url);

        $("#qrcodeimg").attr('src',qrcode_url);
        console.log(qrcode_url);
    }
</script>
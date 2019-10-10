<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<script language="JavaScript">
    function clearcache(){
        $.ajax({
            type : "get",
            dataType : "json",
            url : "<?=Url::to(['default/clearcache'])?>",
            success : function(data) {
                if(data.ok == 1){
                    sweetalertChange('缓存已清空！');
                    window.setTimeout(page_reload,100);
                }
            }
        });
    }
</script>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>
                <i class="icon-ok green"></i>
                欢迎使用
                <strong class="green">
                    <?=Yii::$app->params['appname']?>
                </strong>
                ,祝您工作愉快！
            </div>
            <div class="row" style="display: none">
                <div class="col-xs-12">
                    <h3 class="header smaller lighter green"> 快速入口 </h3>
                    <p>
                        <?php
                            $user = Yii::$app->user->identity;
                            $my_quickentry = $user ->my_quickentry;
                            if(!empty($my_quickentry)){
                                $my_quickentry = objectToArray(json_decode($my_quickentry));
                                foreach($my_quickentry as $k => $v){
                                    echo Html::a('<i class="icon-edit bigger-230"></i>'.$v['name'], Url::to([$v['url']]), ['class'=>'btn btn-app btn-primary no-radius']);
                                }
                            }
                        ?>
                        <?=Html::a('<i class="icon-edit bigger-230"></i>清空缓存1', 'javascript:void(0);', ['onclick'=>'javascript:clearcache();','class'=>'btn btn-app btn-primary no-radius'])?>
                    </p>
                    
                </div>
            </div>

            <div class="row" style="display: none">
                <div class="col-xs-12 infobox-container">
                    <div class="infobox infobox-green infobox-small infobox-dark">
                        <div class="infobox-progress">
                            <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
                                <span class="percent">61</span>%
                            </div>
                        </div>

                        <div class="infobox-data">
                            <div class="infobox-content">Task</div>
                            <div class="infobox-content">Completion</div>
                        </div>
                    </div>
                    <div class="infobox infobox-blue infobox-small infobox-dark">
                        <div class="infobox-chart">
                            <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                        </div>

                        <div class="infobox-data">
                            <div class="infobox-content">Earnings</div>
                            <div class="infobox-content">$32,000</div>
                        </div>
                    </div>

                    <div class="infobox infobox-grey infobox-small infobox-dark">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-download"></i>
                        </div>

                        <div class="infobox-data">
                            <div class="infobox-content">Downloads</div>
                            <div class="infobox-content">1,205</div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="hr hr32 hr-dotted"></div>

            <div class="row">
                <!-- <div class="col-xs-12 widget-container-span">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h5>通知公告</h5>
                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="icon-chevron-up"></i>
                                </a>
                
                                <a href="javascript:;" data-action="close">
                                    <i class="icon-remove"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <ul class="list-group">
                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --><!-- /span -->
                <!--
                <div class="col-xs-12 widget-container-span">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h5>待办事宜</h5>
                            <div class="widget-toolbar">
                                <a href="javascript:;" data-action="collapse">
                                    <i class="icon-chevron-up"></i>
                                </a>

                                <a href="javascript:;" data-action="close">
                                    <i class="icon-remove"></i>
                                </a>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <ul class="list-group">
                                    <li class="list-group-item" style="border:0px;"><span style="margin-right:10px;">日资金审核</span><a href="javascript:;">高新校区2015-08-19</a></li>
                                    <li class="list-group-item" style="border:0px;"><span style="margin-right:10px;">日资金审核</span><a href="javascript:;">天一校区2015-08-19</a></li>
                                    <li class="list-group-item" style="border:0px;"><span style="margin-right:10px;">日资金审核</span><a href="javascript:;">江东校区2015-08-18</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div><!-- /.row -->
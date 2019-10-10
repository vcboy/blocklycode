<?php
use backend\assets\AppAsset;

use backend\components\TopWidget;
use backend\components\LeftWidget;
use yii\helpers\Url;
use backend\models\Menu;

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
if(!isset($this -> context -> subject)){
    $this -> context -> subject = '欢迎页面';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=Yii::$app->params['appname']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- 基本样式 -->
    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/font-awesome.min.css" />

    <!-- 只有IE7可见-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!-- page specific plugin styles 页面插件基本样式-->
    <!-- 字体 -->

    <!-- ace styles -->
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace.min.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace-skins.min.css" />

    <!-- IE8以下版本可见-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace-ie.min.css" />
    <![endif]-->
    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/ace-extra.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/html5shiv.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/respond.min.js"></script>
    <![endif]-->
    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/pagination.css" rel="stylesheet" type="text/css" />

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-2.0.3.min.js'>"+"<"+"script>");
    </script>
    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-1.10.2.min.js'>"+"<"+"script>");
    </script>
    <![endif]-->

    <script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
    </script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/bootstrap.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/typeahead-bs2.min.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/excanvas.min.js"></script>
    <![endif]-->

    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.slimscroll.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.easy-pie-chart.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.sparkline.min.js"></script>

    <!-- ace scripts -->
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/ace-elements.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/ace.min.js"></script>

    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/chosen.jquery.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/fuelux/fuelux.spinner.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/date-time/moment.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/date-time/daterangepicker.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.knob.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.autosize.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.maskedinput.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/bootstrap-tag.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.PrintArea.js"></script>

    <!--上传图片插件-->
    <script type="text/javascript" src="<?=Yii::$app -> request -> baseUrl;?>/uploadify/swfobject.js"></script>
	<script type="text/javascript" src="<?=Yii::$app -> request -> baseUrl;?>/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
	<link href="<?=Yii::$app -> request -> baseUrl;?>/uploadify/uploadify.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/chosen.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/datepicker.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/daterangepicker.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/colorpicker.css" />
    <!--项目公共js-->
	<script src="<?=Yii::$app -> request -> baseUrl;?>/js/common.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/js/exam.js"></script>
	<!--弹出框-->
	<script src="<?=Yii::$app -> request -> baseUrl;?>/js/sweetalert-master/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=Yii::$app -> request -> baseUrl;?>/js/sweetalert-master/lib/sweet-alert.css">
	<!-- 弹出框 sweetalert End-->

    <!-- <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/bootstrap.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/typeahead-bs2.min.js"></script> -->
    <!--日历-->
    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app -> request -> baseUrl;?>/resource/DatePicker/WdatePicker.js"></script>
    <!--弹出框 BlockUI-->
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/jquery-ui-theme.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/block.css" />
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.blockUI.js"></script>
    <!--弹出框 BlockUI-->
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/common.css" />
    <!--yii自带js 支持data-confrim -->
    <script src="<?=Yii::$app -> request -> baseUrl;?>/js/yii.js"></script>
    <!--Jquery cookie 插件 Start-->
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.cookie.js"></script>
    <!--Jquery cookie 插件 End-->
    <!--Jquery 复制代码到剪贴板-->
    <script src="<?=Yii::$app -> request -> baseUrl;?>/js/jquery.zclip.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/js/ZeroClipboard.js"></script>

    <!-- 框架自定义css-->
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/css/default.css" />
<?php //头部数据块
if (isset($this->blocks['head'])) {
    echo $this->blocks['head'];
}?>

    <script language="javascript">
        //新弹出框
        function sweetalertChange(alertMsg,timer){
            if(timer == null){
               timer = 2000;
            }
            //swal({   title: alertMsg,   timer,   showConfirmButton: false });
        }
        //新弹出框，有确定按钮
        function sweetalertButton(alertMsg){
            swal(alertMsg);
        }
        //新确认框
        function sweetConfirmChange(msg, url){
            swal({
                    title: msg,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                },
                function(){
                    if(url.length) {
                        //window.open(url,'_self');
                        //alert(url);
                        window.location.href = url;
                    }
                });
        }
        //重新加载本页面
        function page_reload(){
            location.reload();
        }
        //去一个新的页面
        function go_to(new_url){
            location.href = new_url;
        }
    </script>
<style>
.required label::after{content:'*';color:red}
</style>
</head>
<body>
<?php //顶部组件 ?>
<?= TopWidget::widget();?>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
    <div class="main-container-inner">
        <?php //左侧组件 ?>
        <?=LeftWidget::widget();?>
			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?=Url::to(['default/index'])?>">首页</a>
							</li>
                            <?php
                            //START-得到左侧菜单
                            $menu = new Menu();
                            /****判断登录用户拥有的菜单 START******************************************************************************/
                            $auth = Yii::$app->authManager;
                            $userid = Yii::$app->user->identity->id;
                            $leftMenu = $menu ->getUserLeftMenu($userid);
                            /****判断登录用户拥有的菜单 END******************************************************************************/
                            //END-得到左侧菜单
                            /****菜单定位 Start ******************************************************************/
                            $controller     = Yii::$app->controller->id;            //得到当前控制器名称
                            $action         = Yii::$app->controller->action->id;    //得到当前action名称
                            $current_url    = $controller.'/'.$action;
                            //定位数组
                            $current_key = array(
                                'k1' => '',
                                'k2' => '',
                                'k3' => '',
                            );
                            $top_menu_name = '';
                            //print_r($leftMenu);
                            foreach($leftMenu as $k => $v){
                                if(!empty($v['sons'])){
                                    foreach($v['sons'] as $k1 => $v1){
                                        if($current_url == $v1['url']){
                                            $current_key['k1']  = $k;
                                            $current_key['k2']  = $k1;
                                        }
                                        if(!empty($v1['sons'])){
                                            foreach($v1['sons'] as $k2 => $v2){
                                                if($current_url == $v2['url']){
                                                    $current_key['k1']  = $k;
                                                    $current_key['k2']  = $k1;
                                                    $current_key['k3']  = $k2;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            //print_r($current_key);
                            $session = Yii::$app->session;
                            //print_r($session['current_key']);
                            if(empty($current_key['k1']) && empty($current_key['k2']) && empty($current_key['k3'])){
                                if($session['current_key']){
                                    $current_key = $session['current_key'];
                                }
                            }else{
                                $session['current_key']  = $current_key;
                            }
                            if(empty($current_key)){
                                $current_key = array(
                                    'k1' => '',
                                    'k2' => '',
                                    'k3' => '',
                                );
                            }
                            if($current_key['k1']){
                                if(array_key_exists($current_key['k1'],$leftMenu)){
                                    $top_menu_name = $leftMenu[$current_key['k1']]['name'];
                                }
                            }
                            if(!$this -> context -> is_welcome) {
                                if ($top_menu_name) {
                                    echo '<li class="active">' . $top_menu_name . '</li> ';
                                }
                            }
                            if($this -> context -> childSubject){
                                if ($this->context->subject) {
                                    echo '<li class="active">' . $this->context->childSubject . '</li>';
                                }
                            }else {
                                if ($this->context->subject) {
                                    echo '<li class="active">' . $this->context->subject . '</li>';
                                }
                            }
                            //print_r($current_url);
                            //echo '<br />';
                            //print_r($current_key);
                            //echo '<br />';
                            //echo $top_menu_name;
                            //print_r($leftMenu);
                            /****菜单定位 End ******************************************************************/
                            ?>
                            <?php
                            //if($this -> context -> childSubject && 0){
                            ?>
                            <!--
							<li>
                                <a href="javascript:;"><?=$this -> context -> subject;?></a>
                            </li>
                            <li class="active">
                               <?php //echo $this -> context -> childSubject;?>
                            </li>
                            <?php //}else{ ?>
                                <li class="active">
                                    <?php //echo $this -> context -> subject;?>
                                </li>
                                -->
                            <?php //}?>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
						<a href="#" class="btn btn-minier btn-primary" onclick="history.back();">
							<i class="icon-arrow-left"></i>
							返回
						</a>
							<!--
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
							-->
						</div><!-- #nav-search -->
					</div>
                <div class="ace-settings-container" id="ace-settings-container" style="display: none">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="icon-cog bigger-150"></i>
                    </div>

                    <div class="ace-settings-box" id="ace-settings-box" style="display: none">
                        <div>
                            <div class="pull-left" id="change_skin">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="default" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; 选择皮肤</span>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl">切换到左边</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                切换窄屏
                                <b></b>
                            </label>
                        </div>
                    </div>
                </div><!-- /#ace-settings-container -->
				<div class="page-content">
				<!--内容页面-->
				<?= $content ?>
				</div>
		    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">分享</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">链接</label>
            <div>
            <input type="text" class="form-control" id="push_url" style="width: 85%;float: left;"> 
            <button type="button" class="btn btn-primary" style="height: 34px;padding-top: 3px;float: right;" onclick="javascript:tolink()">打开</button>
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label" style="    padding-top: 15px;">二维码</label>
            <!-- <textarea class="form-control" id="message-text"></textarea> -->
            <div style="text-align: center;">
            <img src="http://www.local/joblive/manager/backend/web/course/qrcode/3" id="qrcodeimg">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
        $('.easy-pie-chart.percentage').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size/10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
        });

        var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
        var data = [
            { label: "social networks",  data: 38.7, color: "#68BC31"},
            { label: "search engines",  data: 24.5, color: "#2091CF"},
            { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
            { label: "direct traffic",  data: 18.6, color: "#DA5430"},
            { label: "other",  data: 10, color: "#FEE074"}
        ]
        /*
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder, data);
*/
        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;
        placeholder.on('plothover', function (event, pos, item) {
            if(item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent']+'%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });

        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }


        var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
      /*  $.plot("#sales-charts", [
            { label: "Domains", data: d1 },
            { label: "Hosting", data: d2 },
            { label: "Services", data: d3 }
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: { show: true },
                points: { show: true }
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: { colors: [ "#fff", "#fff" ] },
                borderWidth: 1,
                borderColor:'#555'
            }
        });*/


        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }


        $('.dialogs,.comments').slimScroll({
            height: '300px'
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function(e){
                var li = $(e.target).closest('#tasks li');
                if(li.length == 0)return;
                var label = li.find('label.inline').get(0);
                if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
            });

        $('#tasks').sortable({
                opacity:0.8,
                revert:true,
                forceHelperSize:true,
                placeholder: 'draggable-placeholder',
                forcePlaceholderSize:true,
                tolerance:'pointer',
                stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                    $(ui.item).css('z-index', 'auto');
                }
            }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
            if(this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });

        $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });


    })
        $(document).ready(function(){

            $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                $(this).prev().focus();
            });

            
        })

        var tolink = function(){
            var push_url = $("#push_url").val();
            if(push_url){
                window.open(push_url);
            }
        }
    </script>
<?php //底部数据块
if (isset($this->blocks['foot'])) {
    echo $this->blocks['foot'];
}?>
</body>
<?php $this->endPage() ?>

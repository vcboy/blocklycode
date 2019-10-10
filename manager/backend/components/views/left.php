<?php
    use yii\helpers\Url;
?>
<script type="text/javascript">
    $(function(){
        //得到左侧菜单是否缩进的状态，重置
        //alert($.cookie('left_menu_mode'));
        if($.cookie('left_menu_mode') == 'left'){
            $('#set_left_menu_mode').attr('class','icon-double-angle-left');
            $('#sidebar').attr('class','sidebar');
        }else if($.cookie('left_menu_mode') == 'right'){
            $('#set_left_menu_mode').attr('class','icon-double-angle-right');
            $('#sidebar').attr('class','sidebar menu-min');
        }
        //得到框架皮肤的cookie信息
        var skin_type = $.cookie('skin_type');
        //alert(skin_type);
        $('body').addClass($.cookie('skin_type'));
        $("#change_skin div ul a").attr('class','colorpick-btn');
        switch(skin_type){
            case 'skin-1':
                $("#change_skin div ul a:eq(1)").addClass('selected');
                $('#change_skin div a span').css('background-color','#222A2D');
                break;
            case 'skin-2':
                $("#change_skin div ul a:eq(2)").addClass('selected');
                $('#change_skin div a span').css('background-color','#C6487E');
                break;
            case 'skin-3':
                $("#change_skin div ul a:eq(3)").addClass('selected');
                $('#change_skin div a span').css('background-color','#D0D0D0');
                break;
            default :
                $("#change_skin div ul a:eq(0)").addClass('selected');

        }
        //得到固定导航条的cookie信息
        var ace_settings_navbar = $.cookie('ace_settings_navbar');
        if(ace_settings_navbar == 'true'){
            $('#ace-settings-navbar').prop('checked',true);
            $('body').addClass('navbar-fixed');
            $('#navbar').addClass('navbar-fixed-top');
        }else{
            $('#ace-settings-navbar').prop('checked',false);
        }
        //得到固定滑动条的cookie信息
        var ace_settings_sidebar = $.cookie('ace_settings_sidebar');
        //alert(ace_settings_sidebar);
        if(ace_settings_sidebar == 'true'){
            $('#ace-settings-sidebar').prop('checked',true);
            $('#sidebar').addClass('sidebar-fixed');
        }else{
            $('#ace-settings-sidebar').prop('checked',false);
        }
        //得到固定面包屑的cookie信息
        var ace_settings_breadcrumbs = $.cookie('ace_settings_breadcrumbs');
        //alert(ace_settings_sidebar);
        if(ace_settings_breadcrumbs == 'true'){
            $('#ace-settings-breadcrumbs').prop('checked',true);
            $('body').addClass('breadcrumbs-fixed');
            $('#breadcrumbs').addClass('breadcrumbs-fixed');
        }else{
            $('#ace-settings-breadcrumbs').prop('checked',false);
        }
        //得到切换到左边的cookie信息
        var ace_settings_rtl = $.cookie('ace_settings_rtl');
        //alert(ace_settings_rtl);
        if(ace_settings_rtl == 'true'){
            $('#ace-settings-rtl').prop('checked',true);
            $('body').addClass('rtl');
            $('#change_skin').attr('class','pull-right');
            $('#change_skin div ul').addClass('pull-right');
        }else{
            $('#ace-settings-rtl').prop('checked',false);
        }
        //得到切换窄屏的cookie信息
        var ace_settings_add_container = $.cookie('ace_settings_add_container');
        //alert(ace_settings_rtl);
        if(ace_settings_add_container == 'true'){
            $('#ace-settings-add-container').prop('checked',true);
            $('#main-container').addClass('container');
        }else{
            $('#ace-settings-add-container').prop('checked',false);
        }
        //原来的切换皮肤功能失效，用js代替
        $('#change_skin div a').click(function(){
            var class_name = $(this).parent().attr('class');
            //alert($(this).attr('class'));

            if(class_name == 'dropdown dropdown-colorpicker'){
                $(this).parent().attr('class','dropdown dropdown-colorpicker open');
            }else if(class_name == 'dropdown dropdown-colorpicker open'){
                $(this).parent().attr('class','dropdown dropdown-colorpicker');
            }

        });
        //切换皮肤后，用cookie记住
        $('#change_skin div ul a').click(function(){
            var data_color = $(this).attr('data-color');
            var class_name;
            switch(data_color){
                case '#438EB9':
                    class_name = '';
                    break;
                case '#222A2D':
                    class_name = 'skin-1';

                    break;
                case '#C6487E':
                    class_name = 'skin-2';
                    break;
                case '#D0D0D0':
                    class_name = 'skin-3';
                    break;
            }
            $.cookie('skin_type',class_name,{path : "/", expiress : 7});
            //alert($('body').attr('class'));
            /*
            setTimeout(function() {
                var class_name = $('body').attr('class');
                if(class_name){
                    //alert(class_name);
                    $.cookie('skin_type',class_name,{path : "/", expiress : 7});
                }else{
                    $.cookie('skin_type','',{path : "/", expiress : 7});
                }
            }, 100);
            */
        });
        //左侧菜单是否缩进用cookie记住
        $('#set_left_menu_mode').click(function(){
            var class_name = $(this).attr('class');
            if(class_name == 'icon-double-angle-left'){
                $.cookie('left_menu_mode','right',{path : "/", expiress : 7});
            }else if(class_name == 'icon-double-angle-right'){
                $.cookie('left_menu_mode','left',{path : "/", expiress : 7});
            }
        });
        //点击固定导航条，用cookie记住
        $('#ace-settings-navbar').click(function(){
            //alert($(this).prop('checked'));
            var ace_settings_navbar = $(this).prop('checked')
            $.cookie('ace_settings_navbar',ace_settings_navbar,{path : "/", expiress : 7});
            if(ace_settings_navbar == false){
                $.cookie('ace_settings_sidebar',false,{path : "/", expiress : 7});
                $.cookie('ace_settings_breadcrumbs',false,{path : "/", expiress : 7});
            }
        });
        //点击固定滑动条，用cookie记住
        $('#ace-settings-sidebar').click(function(){
            //alert($(this).prop('checked'));
            var ace_settings_sidebar = $(this).prop('checked');
            $.cookie('ace_settings_sidebar',ace_settings_sidebar,{path : "/", expiress : 7});
            if(ace_settings_sidebar == true){
                $.cookie('ace_settings_navbar',true,{path : "/", expiress : 7});
            }
            if(ace_settings_sidebar == false){
                $.cookie('ace_settings_breadcrumbs',false,{path : "/", expiress : 7});
            }
        });
        //点击固定面包屑，用cookie记住
        $('#ace-settings-breadcrumbs').click(function(){
            //alert($(this).prop('checked'));
            var ace_settings_breadcrumbs = $(this).prop('checked');
            $.cookie('ace_settings_breadcrumbs',ace_settings_breadcrumbs,{path : "/", expiress : 7});
            if(ace_settings_breadcrumbs == true){
                $.cookie('ace_settings_navbar',true,{path : "/", expiress : 7});
                $.cookie('ace_settings_sidebar',true,{path : "/", expiress : 7});
            }
        });
        //点击切换到左边，用cookie记住
        $('#ace-settings-rtl').click(function(){
            //alert($(this).prop('checked'));
            $.cookie('ace_settings_rtl',$(this).prop('checked'),{path : "/", expiress : 7});
        });
        //点击切换窄屏，用cookie记住
        $('#ace-settings-add-container').click(function(){
            //alert($(this).prop('checked'));
            $.cookie('ace_settings_add_container',$(this).prop('checked'),{path : "/", expiress : 7});
        });
    });
</script>
<a class="menu-toggler" id="menu-toggler" href="#">
    <span class="menu-text"></span>
</a>

<div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large" style="display: none">
            <button class="btn btn-success" id="student_count" title="直播管理">
                <i class="icon-signal"></i>
            </button>

            <button class="btn btn-info" id="notice" title="模板设置">
                <i class="icon-pencil"></i>
            </button>

            <button class="btn btn-warning" id="student_manage" title="修改密码">
                <i class="icon-group"></i>
            </button>

            <button class="btn btn-danger" id="user_manage" title="用户管理">
                <i class="icon-cogs"></i>
            </button>
        </div>
        <script type="text/javascript">
            $("#student_count").click(function(){
                location.href = "<?php echo Url::to(['course/index'])?>";
            });
            $("#notice").click(function(){
                location.href = "<?php echo Url::to(['template/index'])?>";
            });
            $("#student_manage").click(function(){
                location.href = "<?php echo Url::to(['admin/edit-password'])?>";
            });
            $("#user_manage").click(function(){
                location.href = "<?php echo Url::to(['admin/index'])?>";
            });
        </script>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- #sidebar-shortcuts -->

    <ul class="nav nav-list">
        <?php
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

        //print_r($current_url);
        //echo '<br />';
        //print_r($current_key);
        //echo '<br />';
        //print_r($leftMenu);
        /****菜单定位 End ******************************************************************/
        /****生成菜单 Start ******************************************************************/
        $menu_ico = [
            0   => 'icon-dashboard',
            1   => 'icon-text-width',
            2   => 'icon-desktop',
            3   => 'icon-list',
            4   => 'icon-edit',
            5   => 'icon-list-alt',
            6   => 'icon-calendar',
            7   => 'icon-picture',
            8   => 'icon-tag',
            9   => 'icon-file-alt',
        ];//菜单图标
        $menu_ico_i = 0;
        $menu_left = '';
        foreach($leftMenu as $k => $v){
            $menu_ico_k = $menu_ico_i % 10;
            if(array_key_exists($menu_ico_k,$menu_ico)){
                $icon_class = $menu_ico[$menu_ico_k];
            }else{
                $icon_class	= $menu_ico[0];
            }
            $menu_ico_i ++;
            $menu_left .= '';
            $li_class_1 = '';
            if(!empty($v['sons'])){
                if(strlen($current_key['k1'])){
                    if($current_key['k1'] == $k){
                        $li_class_1 = 'class = "active open"';
                    }
                }
                $menu_left .= '<li '.$li_class_1.'>
										<a href="#" class="dropdown-toggle">
											<i class="'.$icon_class.'"></i>
											<span class="menu-text"> '.$v['name'].' </span>

											<b class="arrow icon-angle-down"></b>
										</a>';
                $menu_left .= '<ul class="submenu">';
                foreach($v['sons'] as $k1 => $v1){
                    $li_class_2 = '';
                    if(!empty($v1['sons'])){
                        if(strlen($current_key['k2'])){
                            if($current_key['k1'] == $k && $current_key['k2'] == $k1){
                                $li_class_2 = 'class = "active open"';
                            }
                        }
                        $menu_left .= '<li  '.$li_class_2.'>
															<a href="#" class="dropdown-toggle">
																<i class="icon-double-angle-right"></i>'.$v1['name'].'<b class="arrow icon-angle-down"></b>
															</a><ul class="submenu">';
                        foreach($v1['sons'] as $k2 => $v2){
                            $li_class_3 = '';
                            if(strlen($current_key['k3'])){
                                if($current_key['k1'] == $k && $current_key['k2'] == $k1 && $current_key['k3'] == $k2){
                                    $li_class_3 = 'class = "active"';
                                }
                            }
                            $menu_left .= '<li '.$li_class_3.'><a href="'.Url::to([$v2['url']]).'">
																<i class="icon-leaf"></i>
																'.$v2['name'].'
															</a></li>';
                        }
                        $menu_left .= '</ul>';
                        $menu_left .= '</li>';
                    }else{
                        if(strlen($current_key['k2'])){
                            if($current_key['k1'] == $k && $current_key['k2'] == $k1){
                                $li_class_2 = 'class = "active"';
                            }
                        }
                        $menu_left .= '<li '.$li_class_2.'><a href="'.Url::to([$v1['url']]).'">
															<i class="icon-double-angle-right"></i>
															'.$v1['name'].'
														</a>
													</li>';
                    }
                }
                $menu_left .= '</ul>';
                $menu_left .= '</li>';
            }else{
                /*$menu_left .= '<li '.$li_class_1.'>
										<a href="#">
											<i class="'.$icon_class.'"></i>
											<span class="menu-text"> '.$v['name'].' </span>
										</a>
									</li>';*/
            }
        }

        echo $menu_left;
        /****生成菜单 End ******************************************************************/
        ?>
    </ul>

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right" id="set_left_menu_mode"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>



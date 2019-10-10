<?php
    use yii\helpers\Url;
?>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
        $(function(){
            //alert('Hello');

            $('#wellcome_user').click(function(){
                var class_name = $(this).attr('class');
                if(class_name == 'light-blue'){
                    $(this).attr('class','light-blue open');
                }else if(class_name == 'light-blue open'){
                    $(this).attr('class','light-blue');
                }
            });

        });
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="<?=Url::to(['default/index']);?>" class="navbar-brand">
                <small>
                    <i class="icon-leaf"></i>
                    <?=Yii::$app->params['appname']?>
                </small>
            </a>
        </div>

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown" id="wellcome_user">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle" >
                            <span class="user-info">
                                <small>欢迎</small>
                                <?=$admin -> name;?>
                            </span>
                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?=Url::to(['admin/edit-password']);?>" methods="post">
                                <i class="icon-cog"></i>
                                修改密码
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?=Url::to(['shortcut/index']);?>" methods="post">
                                <i class="icon-dashboard"></i>
                                快捷方式设置
                            </a>
                        </li> -->
                        <li>
                            <a href="<?=Url::to(['default/logout']);?>" methods="post">
                                <i class="icon-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>

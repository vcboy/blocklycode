<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=Yii::$app->params['appname']?></title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <!-- nePlayer CSS -->
    <!-- Bootstrap Core CSS -->
    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/bootstrap.min.css" rel="stylesheet">    
    <link href="<?=Yii::$app -> request -> baseUrl;?>/css/style1.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        html {
            width: 100%;
            height: 100%;
        }
        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }
        @media (min-width: 320px){
			.nav-tabs.nav-justified>li {
			    display: table-cell;
			    width: 1%;
			}
			.nav-tabs.nav-justified>li>a {
			    border-bottom: 1px solid #ddd;
			    border-radius: 4px 4px 0 0;
			}
			.nav-tabs.nav-justified>li>a {
			    margin-bottom: 0;
			}
			.nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover {
			    border-bottom-color: #fff;
			}
		}


    </style>

    <script type="text/javascript" src="<?=Yii::$app -> request -> baseUrl;?>/js/swfobject.js"></script>
    <script type="text/javascript" src="<?=Yii::$app -> request -> baseUrl;?>/js/web_socket.js"></script>
    <script type="text/javascript" src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-2.0.3.min.js"></script>

  <script type="text/javascript">
    if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
    WEB_SOCKET_SWF_LOCATION = "<?=Yii::$app -> request -> baseUrl;?>/swf/WebSocketMain.swf";
    WEB_SOCKET_DEBUG = true;
    var ws, name, client_list={};

    // 连接服务端
    function connect() {
       // 创建websocket
       ws = new WebSocket("ws://"+document.domain+":7272");
       // 当socket连接打开时，输入用户名
       ws.onopen = onopen;
       // 当有消息时根据消息类型显示不同信息
       ws.onmessage = onmessage; 
       ws.onclose = function() {
          console.log("连接关闭，定时重连");
          connect();
       };
       ws.onerror = function() {
          console.log("出现错误");
       };
//       console.log('con test');
    }

    // 连接建立时发送登录信息
    function onopen()
    {
        if(!name)
        {
            show_prompt();
        }
        // 登录
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['id']) ? $_GET['id'] : 1?>"}';
        console.log("websocket握手成功，发送登录数据:"+login_data);
        ws.send(login_data);
    }

    // 服务端发来消息时
    function onmessage(e)
    {
//        console.log('123');
        console.log(e.data);
        var data = eval("("+e.data+")");
//        console.log(data['type']);
        switch(data['type']){
            // 服务端ping客户端
            case 'ping':
                ws.send('{"type":"pong"}');
                break;
            // 登录 更新用户列表
            case 'login':
                //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                say(data['client_id'], data['client_name'],  data['client_name']+' 加入了聊天室'/*, data['time']*/);
                console.log('test');
//                console.log(data['client_list']);
                if(data['client_list'])
                {
                    client_list = data['client_list'];
                }
                else
                {
                    client_list[data['client_id']] = data['client_name']; 
                }
                // flush_client_list();
                var obj = Object.keys(client_list);
                console.log(obj.length);
                //每次有人登陆时会统计人数
                get_person_count(obj.length)
                console.log(data['client_name']+"登录成功");
                break;
            // 发言
            case 'say':
                //{"type":"say","from_client_id":xxx,"to_client_id":"all/client_id","content":"xxx","time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['content']/*, data['time']*/);
                break;

            // 用户退出 更新用户列表
            case 'logout':
                //{"type":"logout","client_id":xxx,"time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['from_client_name']+' 退出了'/*, data['time']*/);
                delete client_list[data['from_client_id']];
                // flush_client_list();
                var arr = Object.keys(client_list);
                console.log(arr.length);
                //每次有人登陆时会统计人数
                get_person_count(arr.length)
        }

                setTimeout(function () {
                    console.log('3334');
                    $('#dialog').scrollTop( $('#dialog')[0].scrollHeight  );
                    console.log($("#dialog>.speech_item").length);
                }, 1);



    }

    //统计人数
    function get_person_count(count_num) {
        var person_count = count_num;
//        $.ajax({
//            type: "post",
//            method: "post",
//            dataType: "json",
//            data: {"value": value},
//            url: "<?//= Url::to(['courseware/changecheck']);?>//",
//            success: function(data){
//                console.log(data);
//
//            }
//        });
//        var t=  <?//= $_SESSION['roomid']['person_count']?>
//        alert(t);
//        alert()
    }

    // 输入姓名
    function show_prompt(){
//        name = prompt('输入你的名字11：', '');
        if(!name || name=='null'){
            name = '游客' +  Math.floor(Math.random() * 100000);
        }
    }

    // 提交对话
    function onSubmit() {
      var input = document.getElementById("textarea");
      var to_client_id = $("#client_list option:selected").attr("value");
      var to_client_name = $("#client_list option:selected").text();
      if(input.value.length==0){
        return;
      }
      ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
      input.value = "";
      input.focus();
    }

    // 发言
    function say(from_client_id, from_client_name, content, time){
        $("#dialog").append('<div class="speech_item">  <div class="get_client_img"><img src="http://p4.music.126.net/bTIoFKFaE1-JQpgN3OynGg==/1986817511391283.jpg?param=30y30" class="user_icon" /> <span class="item_client_name">'+from_client_name+'：</span> <span class="item_content"> '+content+' </span></div> <div style="clear:both;"></div> </div> <div style="height: 5px;"></div> ');
    }

    $(function(){
        select_client_id = 'all';
        $("#client_list").change(function(){
             select_client_id = $("#client_list option:selected").attr("value");
        });
    });

  </script>
</head>
<body  onload="connect();">
<?php $this->beginBody() ?>
<?= $content ?>

<!-- Bootstrap Core JavaScript -->
<script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/bootstrap.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
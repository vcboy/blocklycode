<!-- html5 video tag -->
<style type="text/css">
    .video_menu{
        padding: 0px;
        display: block;
        margin: 0px;
    }
    .video_menu li{
        display: block;
        float: left;
        width: 50%;
        background-color: #206AB0;
        text-align: center;
        height: 48px;
        padding-top: 6px;
    }
    .video_menu li a{
        text-decoration: none;
        color: #fff;
        width: 110px;
        display: block;
        margin: 0px auto;
        text-align: center;
        line-height: 36px;
        border-radius: 4px;
    }
    .video_menu .active a{
        background-color: #3A86CF;
    }
    .video_menu li a:hover{
        background-color: #0E4882;
    }
    .video_menu:hover{
        background-color: #206AB0;
    }
    .tab-content{
        padding-top: 48px;
    }
</style>

        <div class="video_left">
                <!--div class="intro_bg">会计开课啦</div-->
            <div id="id_video_container" style="width:100%;height:1px;"></div>
        </div>
        <div class="video_right">
            <div class="video_intro">
                <!--div class="intro_bg">简介</div-->
                <div class="intro_text">
                <?=$model['model']->getChannel()->one()->name;?>
                <div style="font-size: 14px">在线直播</div>
                </div>
                <div class="intro_img">
                    <img src="http://www2.mynep.com/backend/uploads/tempproduct/1476413224_1471457005.jpg">
                </div>
            </div>
            <ul id="myTab" class="video_menu">
                <li class="active"><a href="#service-two" data-toggle="tab">互动聊天</a>
                </li>
                <li class=""><a href="#service-one" data-toggle="tab" id="online_user">在线学员(0)</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade " id="service-one">
                    <div class="video_border">
                        <div class="caption" id="userlist"></div>
                    </div>
                </div>
                <div class="tab-pane fade active in" id="service-two">
                    <div class="video_border">
                        <div class="caption" id="dialog"></div>
                    </div>
                    <div class="video_sbumit">
                        <form onsubmit="onSubmit(); return false;">
                            <select style="margin-bottom:8px;display:none" id="client_list">
                                <option value="all">所有人</option>
                            </select>
                            <div class="input-group">
                                <input type="text" class="form-control" id="textarea">
                                <span class="input-group-btn">
                                    <input class="btn btn-primary" type="submit" value="发送">
                                </span>
                            </div>
                        </form>
                    </div>           
                </div>
            </div>
        </div>     

<script src="http://qzonestyle.gtimg.cn/open/qcloud/video/live/h5/live_connect.js" charset="utf-8"></script>
<script type="text/javascript">
    (function(){
        var height = document.body.clientHeight;
        var width =  document.documentElement.clientWidth;
        //$('.video-js').css('height',height-40);
        $('#dialog').css('height',height-302);
        $('#userlist').css('height',height-302);
        $("body").keydown(function() {
            if (event.keyCode == "13" && $('#textarea').is(':focus')) {//keyCode=13是回车键
                onSubmit();
            }
        });
        var flv = "<?= $model['flv']?>";
        var m3u8 = "<?= $model['m3u8']?>";
        var videoheight = height;
        var videowidth = width * 0.8;
        //var option ={"channel_id":"1111","app_id":"12313","width":videowidth,"height":videoheight};
        var option = {
            "live_url" : flv,
            "live_url2": m3u8,
            "autoplay" : true,      //iOS下safari浏览器是不开放这个能力的
            //"coverpic" : "http://www.test.com/myimage.jpg",
            "width" :  videowidth,//视频的显示宽度，请尽量使用视频分辨率宽度
            "height" : videoheight//视频的显示高度，请尽量使用视频分辨率高度
        }
        var player = new qcVideo.Player(
           /*代码中的id_video_container将会作为播放器放置的容器使用,可自行替换*/
           "id_video_container",
           option
        );
        //qcVideo.resize(100,100);
        var barrage = [
        {"type":"content", "content":"hello world", "time":"1"},
        {"type":"content", "content":"居中显示", "time":"10", "style":"C64B03;30","position":"center"}
        ];
        player.addBarrage(barrage);

        $(window).resize(function(){
            console.log('a');
            var height = document.body.clientHeight;
            var width =  document.documentElement.clientWidth;
            var videoheight = height;
            var videowidth = width * 0.8;
            player.resize(videowidth,videoheight);
        })
    })()

    
 </script>   
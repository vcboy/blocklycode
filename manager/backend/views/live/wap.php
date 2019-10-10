<script>
    // 刷新用户列表框
    function flush_client_list() {
        // var userlist_window = $("#userlist");
        var client_list_slelect = $("#client_list");
        // userlist_window.empty();
        client_list_slelect.empty();
        // userlist_window.append('<h4>在线用户</h4><ul>');
        client_list_slelect.append('<option value="all" id="cli_all">所有人</option>');
        for (var p in client_list) {
            // userlist_window.append('<li id="'+p+'">'+client_list[p]+'</li>');
            client_list_slelect.append('<option value="' + p + '">' + client_list[p] + '</option>');
        }
        $("#client_list").val(select_client_id);
        // userlist_window.append('</ul>');
    }
</script>

<!-- html5 video tag -->
<div class="row top_row">
    <div class="col-lg-12 padding0">
        <div id="id_video_container" style="width:100%;height:1px;"></div>
    </div>
</div>

<div class="row bottom_row">
    <div class="col-lg-12 bottom_row padding0">

        <ul id="myTab" class="nav nav-tabs nav-justified">
            <li class="active"><a href="#service-two" data-toggle="tab"><i class="fa fa-car"></i> 互动</a>
            </li>
            <li class=""><a href="#service-one" data-toggle="tab"><i class="fa fa-tree"></i> 课程简介</a>
            </li>           
            <!-- <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-support"></i>xxx</a>
            </li>
            <li class=""><a href="#service-four" data-toggle="tab"><i class="fa fa-database"></i> Service Four</a>
            </li> -->
        </ul>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="service-two">
                <div class="container padding0 container_height">
                    <div class="row clearfix container_height">
                        <div class="col-md-1 column">
                        </div>
                        <div class="col-md-6 column padding0 container_height">
                            <div class="thumbnail chat_content margin0">
                                <div class="caption" id="dialog"></div>
                                <form onsubmit="onSubmit(); return false;" class="form_magin">
                                    <select style="margin-bottom:8px; display: none;" id="client_list">
                                        <option value="all">所有人</option>
                                    </select>
                                    <input type="text" class="textarea thumbnail" id="textarea" autocomplete="off" placeholder="说两句呗~"/>
                                    <div id="sub_btn" class="say-btn">
                                    <input type="submit" class="btn btn-default btn_send" id="btn_fb" value="发表"/></div>
                                </form>
                            </div>

                        </div>
                        <!-- <div class="col-md-3 column">
                           <div class="thumbnail">
                               <div class="caption" id="userlist"></div>
                           </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="service-one">
                <h4>课程简介</h4>
                <p>课程直播介绍</p>
            </div>
            
            <div class="tab-pane fade" id="service-three">
                xxxx
            </div>
            <div class="tab-pane fade" id="service-four">
                assss
            </div>
        </div>

    </div>
</div>
<script src="http://qzonestyle.gtimg.cn/open/qcloud/video/live/h5/live_connect.js" charset="utf-8"></script>
<!--<script src="//imgcache.qq.com/open/qcloud/video/vcplayer/TcPlayer.js" charset="utf-8"></script>-->
<script type="text/javascript">
    $(document).ready(function () {
        var height = document.documentElement.clientHeight;
        var width =  document.documentElement.clientWidth;
        video_height = height * 0.35;
        console.log(height);
        var flv = "<?= $model['flv']?>";
        var m3u8 = "<?= $model['m3u8']?>";


        var dialog_heitght = height * 0.48;
        var tabheight = height * 0.65 - 53;
        var dialog_height = tabheight - 50;

        var player =  new qcVideo.Player('id_video_container', {
//            'app_id' : '1252754321',
//            'channel_id' : '9896587163604826691',
            "live_url" : m3u8,
            "live_url2": flv,
            "autoplay" : true,      //iOS下safari浏览器是不开放这个能力的
//            "coverpic" : "http://www.test.com/myimage.jpg",
            "width" :  width,//视频的显示宽度，请尽量使用视频分辨率宽度
            "height" : video_height//视频的显示高度，请尽量使用视频分辨率高度
        });
        $(".chat_content").height(tabheight);
        $("#dialog").css("height", dialog_height);
        $('.top_row').height(video_height);
    })
</script>

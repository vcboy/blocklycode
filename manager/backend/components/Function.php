<?php
/*
 * 自定义全局函数文件
 * 全局函数应避免命名冲突
 */
	/**
	 * @param string $options 选项
	 * @param string $answer 答案
	 * @param int $type_id 类型
	 * @param int $id id
	 * @return string $optionstr 返回选项的html代码
	 */
	function getOptions2($options,$answer,$type_id,$id){
		$optionstr = '';
		$optionsindex =  Yii::$app->params['optionsindex'];
		$optionsArr = json_decode($options,true);
		if($type_id != 6){
			$answerArr = json_decode($answer,true);
		}else {
			$answerArr = $answer;
		}
		$se = '';
		switch ($type_id){
			case '1': //单选题
				$optionstr = '';
				//$input
				foreach ($optionsArr as $k => $v){
					$flag="";
					if($v == $answerArr[0]){
						$se = 'checked';
						$flag = " style='color:red;font-size:14px;font-weight:border;' ";
					}
					$optionsNewArr[$optionsindex[$k]] = "<span ".$flag.">".$optionsindex[$k].". <input type='radio' value='{$v}' name='question2{$id}' {$se}></span>";
					$se = '';
				}
				if(!empty($optionsNewArr) && is_array($optionsNewArr)){
					$optionstr .= implode(' ',$optionsNewArr);
				}
				break;
			case '2': //多选题
				$optionstr = '';
				$flag="";
				//$input
				foreach ($optionsArr as $k => $v){
					if(!empty($answerArr) && in_array($v,$answerArr)) {
						$se = 'checked';
						$flag = " style='color:red;font-size:14px;font-weight:border;' ";
					}
					$optionsNewArr[$optionsindex[$k]] = "<span ".$flag.">".$optionsindex[$k].". <input type='checkbox' value='{$v}' name='question2{$id}' {$se}></span>";
					$se = '';
				}
				if(!empty($optionsNewArr) && is_array($optionsNewArr)){
					$optionstr .= implode(' ',$optionsNewArr);
				}
				break;
			case '3': //判断题
				$optionstr = '';
				$flag1 = $flag0 = "";
				$se1 = $se0 = '';
				if($answerArr[0] == 1) {
					$se1 = 'checked';
					$flag1 = " style='color:red;font-size:14px;font-weight:border;' ";
				}
				if(isset($answerArr[0]) && $answerArr[0] == 0){
					$se0 = 'checked';
					$flag0 = " style='color:red;font-size:14px;font-weight:border;' ";
				}
				$optionstr .= "<span ".$flag1.">√<input type='radio' value='1' name='question2{$id}' {$se1}></span><span ".$flag0.">×<input type='radio' value='0' name='question2{$id}' {$se0}></span>";
				break;

		}
		return $optionstr;
	}

	function getOptionstr($options,$type_id){
		$optionstr = '';
		$optionsindex =  Yii::$app->params['optionsindex'];
		$optionsArr = json_decode($options,true);
		switch ($type_id){
			case '1': //单选题

				foreach ($optionsArr as $k => $v){
					$optionsNewArr[$optionsindex[$k]] = $optionsindex[$k].'. '.$v;
				}
				if(!empty($optionsNewArr) && is_array($optionsNewArr)){
					$optionstr = implode('<br>',$optionsNewArr);
				}
				break;
			case '2': //多选题

				foreach ($optionsArr as $k => $v){
					$optionsNewArr[$optionsindex[$k]] = $optionsindex[$k].'. '.$v;
				}
				if(!empty($optionsNewArr) && is_array($optionsNewArr)){
					$optionstr = implode('<br>',$optionsNewArr);
				}
				break;
			case '3': //判断题
				break;
			case '4': //填空题
				break;
			case '5': //问答题
				break;
			case '6': //操作题
				break;
		}

		return $optionstr;
	}

	function getOptions($options,$answer,$type_id,$id,$flag){
		$optionstr = '';
		$optionsindex =  Yii::$app->params['optionsindex'];
		$optionsArr = json_decode($options,true);
		if($type_id != 16){
			$answerArr = json_decode($answer,true);
		}else {
			$answerArr = $answer;
		}
		$se = '';
		switch ($type_id){
			case '1': //单选题
				$optionstr = '选择答案：';
				//$input
				foreach ($optionsArr as $k => $v){
					if($v == $answerArr[0]) $se = 'checked';
					$optionsNewArr[$optionsindex[$k]] = "<span>".$optionsindex[$k].". <input type='radio' value='{$v}' name='question{$id}' {$se}></span>";
					$se = '';
				}
				if(!empty($optionsNewArr) && is_array($optionsNewArr)){
					$optionstr .= implode(' ',$optionsNewArr);
				}
				break;
			case '2': //多选题
				$optionstr = '选择答案：';
				//$input
				foreach ($optionsArr as $k => $v){
					if(!empty($answerArr) && in_array($v,$answerArr)) $se = 'checked';
					$optionsNewArr[$optionsindex[$k]] = "<span>".$optionsindex[$k].". <input type='checkbox' value='{$v}' name='question{$id}' {$se}></span>";
					$se = '';
				}
				if(!empty($optionsNewArr) && is_array($optionsNewArr)){
					$optionstr .= implode(' ',$optionsNewArr);
				}
				break;
			case '3': //判断题
				$optionstr = '选择答案：';
				$se1 = $se0 = '';
				if($answerArr[0] == 1) $se1 = 'checked';
				if(isset($answerArr[0]) && $answerArr[0] == 0) $se0 = 'checked';
				$optionstr .= "<span>√<input type='radio' value='1' name='question{$id}' {$se1}></span><span>×<input type='radio' value='0' name='question{$id}' {$se0}></span>";
				break;
			case '4': //填空题
				$optionstr = '答题区：<br>';
				$optionstr .= "<textarea name='question{$id}'  class='da_put'>{$answerArr[0]}</textarea>";
				break;
			case '5': //问答题
				$optionstr = '答题区：<br>';
				$optionstr .= "<textarea name='question{$id}'  class='da_put'>{$answerArr[0]}</textarea>";
				break;
			case '16': //上传文件
				$optionstr = '上传文件：';
				if($flag=='edit'){
					$img_array = array("gif", "jpg", "jpeg", "bmp", "png");
					$type = strtolower(substr($answer,strripos($answer,".")+1));
					if (in_array($type,$img_array)){
						$optionstr .= "<a href='$answer' title='放大' target='_blank'><img src='$answer' WIDTH='149' HEIGHT='110' /></a>";
					}else if($type=="zip"||$type=="rar"){
						$fname = explode('/', $answer);
						$optionstr .= "<a href='".url('questionwrong/download',array('id'=>$id,'type'=>'answer'))."' title='打开'><font color='blue'>".array_pop($fname)."</font></a>";
					}else{
						$fname = explode('/', $answer);
						$optionstr .= "<a href='".url('questionwrong/download',array('id'=>$id,'type'=>'answer'))."' title='打开'><font color='blue'>".array_pop($fname)."</font></a>";
					}
				}else{
					if($answerArr) $se = '文件已经上传';
					//$optionstr .= "<input type='file' name='question{$id}' id='question{$id}'><input type='button' value='上传' name='uploadfi{$id}' ><span id='uploadsp{$id}'></span>";
					$optionstr .= "<div class='fieldset flash' id='Progress{$id}'><span id='spanButton{$id}'></span><input id='btnCancel{$id}' type='button' value='取消上传' onclick='cancelQueue(upload{$id});' disabled='disabled' /><span id='divstatus{$id}'><a href='{$answerArr}'>{$se}</a></span></div>";
					$se = '';
				}
				break;
			default:
				$optionstr = '答题区：<br>';
				$optionstr .= "<textarea name='question{$id}'  class='da_put'>{$answerArr[0]}</textarea>";
				break;
		}
		return $optionstr;
	}

	function dump($var, $echo=true, $label=null, $strict=true) {
		$label = ($label === null) ? '' : rtrim($label) . ' ';
		if (!$strict) {
			if (ini_get('html_errors')) {
				$output = print_r($var, true);
				$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
			} else {
				$output = $label . print_r($var, true);
			}
		} else {
			ob_start();
			var_dump($var);
			$output = ob_get_clean();
			if (!extension_loaded('xdebug')) {
				$output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
				$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
			}
		}
		if ($echo) {
			echo($output);
			return null;
		}else
			return $output;
	}
	//远程下载图片
	function downloadImage($url,$filepath) {
		if($url == ''){return false;}
		$ext_name = strrchr($url, '.'); //获取图片的扩展名
		if($ext_name != '.gif' && $ext_name != '.jpg' && $ext_name != '.bmp' && $ext_name != '.png') {
			return false; //格式不在允许的范围
		}
		//开始捕获
		ob_start();
		readfile($url);
		$img_data = ob_get_contents();
		ob_end_clean();
		$local_file = @fopen($filepath , 'a');
		fwrite($local_file, $img_data);
		fclose($local_file);
	}
	//对象转换成数组的函数
	function objectToArray($obj){
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    $arr = array();
    if(!empty($_arr)){
        foreach ($_arr as $key => $val) {
            $val = (is_array($val) || is_object($val)) ? objectToArray($val) : $val;
            $arr[$key] = $val;
        }
    }
    return $arr;
}

	/*xml文件转换为Array数组
	   * $str:对应的值
	   * $type:str的类型，f => file 即文件地址, s =>string 即Xml正文
	   *
	   */
	function xml2array($str,$type){
		$xmlstr = '';
		if($type == 'f'){
			$xmlstr = simplexml_load_file($str);
		}
		if($type == 's'){
			$xmlstr = simplexml_load_string($str);
		}
		$arrstrs=json_encode($xmlstr);
		$arrstr=json_decode($arrstrs,true);
		return $arrstr;
	}

	function get_wordstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
		$str=preg_replace('/<([^>]*)>/is',"",$str);	//把HTML代码过滤掉
		$str=preg_replace('/\[([^\]]*)\]/is',"",$str);	//把HTML代码过滤掉
		$str=str_replace("&nbsp;","",$str);
		$str=str_replace(" ","",$str);
		$str=str_replace("　","",$str);
		$str=str_replace("\r","",$str);
		$str=str_replace("\n","",$str);
		$str=str_replace("\t","",$str);
		$str=msubstr($str, $start=0, $length, $charset, $suffix);
		return $str;
	}

	function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
	{
		if(abslength($str)<=$length*2)return $str;

		if(function_exists("mb_substr"))
			$slice = mb_substr($str, $start, $length, $charset);
		elseif(function_exists('iconv_substr')) {
			$slice = iconv_substr($str,$start,$length,$charset);
		}else{
			$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
			$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
			preg_match_all($re[$charset], $str, $match);
			$slice = join("",array_slice($match[0], $start, $length));
		}
		return $suffix&&abslength($str)>=$length*2 ? $slice.'...' : $slice;
	}

	function abslength($str){
		$len=strlen($str);
		$i=0; $j=0;
		while($i<$len)
		{
			if(preg_match("/^[".chr(0xa1)."-".chr(0xf9)."]+$/",$str[$i]))
			{
				$i+=2;
			}
			else
			{
				$i+=1;
			}
			$j++;
		}
		return $j;
	}
	//通过curl 跨站上传文件
	 function uploadByCURL($post_url,$post_data){
		//$post_url = "http://cjnepstore/get_files.php";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $post_url);
        curl_setopt($curl, CURLOPT_POST, 1 );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/4.0");
        $result = curl_exec($curl);
        $error = curl_error($curl);
        return $error ? $error : $result;
    }
	//删除本地文件 
    function deleteLocalFile($path){
		if(file_exists($path))
			unlink($path);
    }

	//通过curl 跨站得到网易直播信息
	function getLiveByCURL($url,$post_data){
		//$url = "https://vcloud.163.com/app/channel/create";
		//$post_data = json_encode(array ("name" => "测试频道","type" => 0));
		/*if(empty($url)||empty($post_data))
			return;*/
		$post_data=json_encode($post_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书

		$AppKey='77db0c5efa9841b7a1b1a1dd31044bab';
		$APPSECRET='386f402145974c27b6b4c00f29c0d39a';
		$Nonce = time()+rand(0,999);
		$CurTime = time();

		//$CheckSum = sha1("这里是你的APPSECRET".$Nonce.$CurTime);
		$CheckSum = sha1($APPSECRET.$Nonce.$CurTime);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		
		//postheader
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json;charset=utf-8","AppKey:这里填你自己的APPKEY","Nonce:".$Nonce,"CurTime:".$CurTime,"CheckSum:".$CheckSum));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json;charset=utf-8","AppKey:".$AppKey,"Nonce:".$Nonce,"CurTime:".$CurTime,"CheckSum:".$CheckSum));
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		//print_r($post_data);exit;
		$output = curl_exec($ch);
		$errno = curl_errno( $ch );
		$info  = curl_getinfo( $ch );
		//print_r($info);exit;
		curl_close($ch);

		//打印获得的数据
		return $output;
	
	}

	/**
     * 判断用户名只能字母、数字、下划线
     * @param  [type]  $text [description]
     * @return boolean       [description]
     */
    function is_username( $text ) {
        $search = '/^[A-Za-z0-9_]+$/';
        if ( preg_match( $search, $text ) ) {
            return ( true );
        } else {
            return ( false );
        }
    }
?>
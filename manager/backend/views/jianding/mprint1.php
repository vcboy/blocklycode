<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title></title>

    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/font-awesome.min.css" />
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/css/default.css" />
    <script src="<?=Yii::$app -> request -> baseUrl;?>/js/jquery-2.1.1.min.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.PrintArea.js"></script>
  </head>
<!-- NAVBAR
================================================== -->
<body>
  <div>
    <button type="button" class="btn btn-default" id="printbtn">
      <span class="glyphicon glyphicon-print"></span> 打印
    </button>
  </div>

<?php 
foreach ($models as $key => $model): 
  $edu = $job = array();
  if($model->education){
      $edu = json_decode($model->education,true);
  }
  if($model->job){
      $job = json_decode($model->job,true);
  }
?>
<div class="printarea">
  <!-- <p class="tip">
    ID(编号)：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
  </p>
  <p class="tip">
    （备注：请按照年月日编号的次序编号例如：20140929001）
  </p> -->
  <p class="ptitle">
    浙江省电子商务专业人才鉴定申请表
  </p>
  <div class="pfooter">
    <div class="pdate">日期：</div><div class="pdate">年</div><div class="pdate">月</div><div class="pdate">日</div>
  </div>
  <div>
  <table border="1">
    <tbody>
      <tr>
        <td colspan="2" width="15%">
          <p>
            申报单位
          </p>
        </td>
        <td colspan="4">
          <p>
            <?=$model->getPlan()->one()->company?>
          </p>
        </td>
        <td rowspan="5" width="25%">
          <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;粘贴
          </p>
          <p>
            两寸
          </p>
          <p>
            彩照
          </p>
          <p>
            （须裁减整齐）
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>
            姓&nbsp;&nbsp; &nbsp;名
          </p>
        </td>
        <td colspan="2" width="20%">
          <p>
            <?=$model->name?>
          </p>
        </td>
        <td>
          <p>
            性&nbsp;&nbsp;&nbsp;别
          </p>
        </td>
        <td>
          <p>
            <?=$model->sex==1?'男':'女'?>
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>
            民&nbsp;&nbsp;&nbsp;族
          </p>
        </td>
        <td colspan="2">
          <p>
            <?=$model->nation?>
          </p>
        </td>
        <td>
          <p>
            出生年月
          </p>
        </td>
        <td>
          <p>
            <?=$model->birthday?>
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>
            身份证号码
          </p>
        </td>
        <td colspan="4">
          <p>
            <?=$model->sfz?>
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>
            报考证书
          </p>
        </td>
        <td colspan="2">
          <p>
            <?=$model->getPlan()->one()->bkzs?>
          </p>
        </td>
        <td>
          <p>
            报考方向
          </p>
        </td>
        <td>
          <p>
            <?=$model->getPlan()->one()->bkfx?>
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>
            证书等级
          </p>
        </td>
        <td colspan="2">
          <p>
            <?=$model->getPlan()->one()->zsdj?>
          </p>
        </td>
        <td>
          <p>
            联系方式&nbsp;&nbsp;
          </p>
        </td>
        <td colspan="2">
          <p>
            <?=$model->tel?>
          </p>
        </td>
      </tr>
      <tr>
        <td rowspan="4">
          <p>
            &nbsp;
          </p>
          <p>
            教
          </p>
          <p>
            育
          </p>
          <p>
            经
          </p>
          <p>
            历
          </p>
        </td>
        <td colspan="2" width="20%">
          <p>
            时间
          </p>
        </td>
        <td colspan="2" width="20%">
          <p>
            学校
          </p>
        </td>
        <td  width="20%">
          <p>
            专业
          </p>
        </td>
        <td>
          <p>
            学历学位
          </p>
        </td>
      </tr>
      <?php
      for($i=0;$i<3;$i++){
        $edu_time = ' ';
        $edu_school = ' ';
        $edu_zy = ' ';
        $edu_xl = ' ';
        if(is_array($edu) && array_key_exists($i,$edu) && $edu[$i]){
          $edu_time = $edu[$i][0];
          $edu_school = $edu[$i][1];
          $edu_zy = $edu[$i][2];
          $edu_xl = $edu[$i][3];
        }

      ?>
      <tr>
        <td colspan="2">
          <p>
            <?=$edu_time?>
          </p>
        </td>
        <td colspan="2">
          <p>
            <?=$edu_school?>
          </p>
        </td>
        <td>
          <p>
            <?=$edu_zy?>
          </p>
        </td>
        <td>
          <p>
            <?=$edu_xl?>
          </p>
        </td>
      </tr>
      <?php
      }
      ?>
      
      <tr>
        <td rowspan="4">
          <p>
            &nbsp;
          </p>
          <p>
            工
          </p>
          <p>
            作
          </p>
          <p>
            经
          </p>
          <p>
            历
          </p>
          <p>
            &nbsp;
          </p>
        </td>
        <td colspan="2">
          <p>
            时间
          </p>
        </td>
        <td colspan="2">
          <p>
            单位
          </p>
        </td>
        <td>
          <p>
            岗位
          </p>
        </td>
        <td>
          <p>
            学历学位
          </p>
        </td>
      </tr>
      <?php
      for($i=0;$i<3;$i++){
        $job_time = ' ';
        $job_school = ' ';
        $job_zy = ' ';
        $job_xl = ' ';
        if(is_array($job) && array_key_exists($i,$job) && $job[$i]){
          $job_time = $job[$i][0];
          $job_school = $job[$i][1];
          $job_zy = $job[$i][2];
          //$job_xl = $job[$i][3];
        }

      ?>
      <tr>
        <td colspan="2">
          <p>
            <?=$job_time?>
          </p>
        </td>
        <td colspan="2">
          <p>
            <?=$job_school?>
          </p>
        </td>
        <td>
          <p>
            <?=$job_zy?>
          </p>
        </td>
        <td>
          <p>
            <?//=$job_xl?>
          </p>
        </td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <td colspan="7">
          <p>
            注：1、以上所列选项必须如实完整填写，填写时务必清晰、工整；
          </p>
          <p>
            2、将身份证复印件正反面粘贴在报名表背面；
          </p>
          <p>
            3、提交三张两寸近期同版彩照并写上姓名；
          </p>
          <p>
            4、资料不清不全不实者责任自负。
          </p>
          <p>
            证书查询网址：http://nb.zjcec.com/
          </p>
        </td>
      </tr>
    </tbody>
  </table>
  </div>
  <div class="pfooter" style="padding-top: 10px;">
  浙江省商务厅培训认证中心&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;制
  </div>
</div>
<?php endforeach ?>  
</body>
  <script type="text/javascript">
  $("#printbtn").click(function(){
    $(".printarea").printArea();
});
  </script>
</html>

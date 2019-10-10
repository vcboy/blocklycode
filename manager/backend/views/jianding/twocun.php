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

  
<div class="printarea" style="padding: 20px 30px">
<?php 
foreach ($models as $key => $model): 
?>
  <div class="twocun">
    <img src="<?=Yii::$app -> request -> baseUrl.'/../../wap/'.$model->getMember()->one()->pic_path ?>" width="132">
    <div><?=$model['name']?></div>
    <div class="sfz"><?=$model['sfz']?></div>
  </div>
<?php endforeach ?>
</div>

</body>
  <script type="text/javascript">
  $("#printbtn").click(function(){
    $(".printarea").printArea();
});
  </script>
</html>

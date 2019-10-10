<?php
use backend\assets\AppAsset;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=Yii::$app->params['appname']?></title>
    <meta name="keywords" content="<?=Yii::$app->params['appname']?>" />
    <meta name="description" content="<?=Yii::$app->params['appname']?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- basic styles -->

    <link href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/font-awesome.min.css" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!-- page specific plugin styles -->

    <!-- ace styles -->

    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace.min.css" />
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace-rtl.min.css" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl;?>/resource/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/html5shiv.js"></script>
    <script src="<?=Yii::$app -> request -> baseUrl;?>/resource/js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?=Yii::$app -> request -> baseUrl?>/resource/css/indexCss.css">
</head>
<body class="login-layout my-login-layout">
    <?php $this->beginBody() ?>
        <?= $content;?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

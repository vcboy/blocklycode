<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>我的二维码</h1>
</div>
<div class="admin-view" style="text-align: center;">

    <img src="<?= Url::to(['admin/myqrcode'])?>" />

</div>

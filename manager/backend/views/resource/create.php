<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = '公告添加';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'time' => time(),
    ]) ?>
    </div>
</div>

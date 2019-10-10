<?php
use yii\helpers\Html;
use backend\models\Channel;
/* @var $this yii\web\View */
/* @var $model backend\models\Channel */
$this->title = 'Create Channel';
$this->params['breadcrumbs'][] = ['label' => 'Channel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-create">
    <?= $this->render('_form', [
        'model' => $model,
        'type_list'=>$type_list,
        'course_list'=>$course_list,
    ]) ?>

</div>

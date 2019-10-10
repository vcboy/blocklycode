<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\channel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status_list=Yii::$app->params['channel_status'];
?>
<div class="page-header">
    <h1>频道查看</h1>
</div>
<div class="channel-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'cid:html',
            [
                'attribute' => 'ctime',
                'value' => $model['ctime']?date('Y-m-d H:i',substr($model['ctime'],0,10)):'',
            ],
            'push_url:url',
            'http_pull_url:url',
            'hls_pull_url:url',
            'rtmp_pull_url:url',
            [
                'attribute' => 'status',
                'value' => $status_list[$model['status']],
            ],
            [
                'attribute' => 'is_exists',
                'value' => $model['is_exists']?'存在':'不存在',
            ],
            'uid',
            [
                'attribute' => 'need_record',
                'value' => $model['need_record']?'开启录制':'关闭录制',
            ],
            [
                'attribute' => 'format',
                'value' => $model['format']?'flv':'mp4',
            ],
            'duration',
            'filename',
        ],
    ]) ?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
   </div>

</div>

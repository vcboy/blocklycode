<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\channel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status_list=Yii::$app->params['course_status'];
$channel_list=Yii::$app->params['channel_status'];
$bizId = Yii::$app->params['bizId'];    //腾讯云bizId
$live_server_push = Yii::$app->params['live_server_push'];
$live_server_play = Yii::$app->params['live_server_play'];
?>
<div class="page-header">
    <h1>直播查看</h1>
</div>
<div class="channel-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'channel_id',
                'value' => $model->channel_id?$model->getChannel()->one()->name:'',
            ],
            [
                'label' => '频道状态',
                'format'=>'html',
                'value' => '<span style="color:red">'.$channel_list[$model->status].'</span>',
            ],
            [
                'label' => '频道推流地址',
                'format'=>'url',
                'value' => $model->upstream_url_params? 'rtmp://'.$bizId.$live_server_push:'',
            ],
            [
                'label' => '频道推流参数',
                'format'=>'html',
                'value' => $model->upstream_url_params? $model->upstream_url_params:'',
            ],
            [
                'label' => '拉流地址（HTTP）',
                'format'=>'url',
                'value' => $model->streamId?"http://" . $bizId . $live_server_play . $model->streamId . ".flv":'',
            ],
            
            [
                'label' => '拉流地址（HLS）',
                'format'=>'url',
                'value' => $model->streamId?"http://" . $bizId . $live_server_play . $model->streamId . ".m3u8":'',
            ],
            
            [
                'label' => '拉流地址（RTMP）',
                'format'=>'url',
                'value' => $model->streamId?"rtmp://" . $bizId . $live_server_play . $model->streamId :'',
            ],
            'teacher_name',
            'audience_count',
            [
                'attribute' => 'is_home',
                'value' => $model['is_home']?'是':'否',
            ],
            [
                'attribute' => 'live_start_time',
                'value' => $model['live_start_time']?date('Y-m-d H:i:s',$model['live_start_time']):'',
            ],
            [
                'attribute' => 'live_end_time',
                'value' => $model['live_end_time']?date('Y-m-d H:i:s',$model['live_end_time']):'',
            ],
            [
                'attribute' => 'create_time',
                'value' => $model['create_time']?date('Y-m-d H:i:s',$model['create_time']):'',
            ],
            'desc',
        ],
    ]) ?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
   </div>

</div>

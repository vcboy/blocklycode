<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Items */

$this->title = '视频查看';
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status_list=Yii::$app->params['video_status'];
?>
<style>
    .sdiv{margin-bottom:10px;color:#333;line-height:24px;width:950px;padding-left:20px;}
    .labeldiv{display: inline-block;width:150px;font-weight: bold;}
    .graydiv{background:#f7f8fa;padding:20px;word-break:break-all; word-wrap:break-word;font-size:14px;width:600px;display:inline-block;}

</style>
<div class="page-header">
    <h1>视频查看</h1>
</div>
<div class="items-view">
    <?= DetailView::widget([
        'model' => $model,
        'template'=>"<div class='sdiv'><div class='labeldiv'>{label}</div><div class='graydiv'>{value}</div></div>",
        'attributes' => [
            'videoName',
            [
                'attribute' => 'status',
                'value' => $model['status']?$status_list[$model->status]:'',
            ],
            'description',
            [
                'attribute' => 'completeTime',
                'value' => $model['completeTime']?date('Y-m-d H:i',substr($model['completeTime'],0,10)):'',
            ],
            [
                'attribute' => 'duration',
                'value' =>sprintf('%02d',intval($model['duration']/(60*60))).':'.sprintf('%02d',intval($model['duration']%(60*60)/60)).':'.sprintf('%02d',intval($model['duration']%(60*60)%60)),
            ],
            [
                'attribute' => 'typeName',
                'value' =>$model->typeId?$model->getItemsType()->one()->typeName:'',
            ],
            [
                'attribute' => 'course_id',
                'value' =>$model->course_id?$model->getCourse()->one()->name:'',
            ],
            'snapshotUrl:url',
            'origUrl:url',
            'downloadOrigUrl:url',
            [
                'attribute' => 'initialSize',
                'value' =>($model['initialSize']/1024/1024)>20?round($model['initialSize']/1024/1024/1024,2).'GB':round($model['initialSize']/1024/1024,2).'MB',
            ],
            'sdMp4Url:url',
            'downloadSdMp4Url:url',
            [
                'attribute' => 'sdMp4Size',
                'value' =>($model['sdMp4Size']/1024/1024)>20?round($model['sdMp4Size']/1024/1024/1024,2).'GB':round($model['sdMp4Size']/1024/1024,2).'MB',
            ],
            'hdMp4Url:url',
            'downloadHdMp4Url:url',
            [
                'attribute' => 'hdMp4Size',
                'value' =>($model['hdMp4Size']/1024/1024)>20?round($model['hdMp4Size']/1024/1024/1024,2).'GB':round($model['hdMp4Size']/1024/1024,2).'MB',
            ],
            'shdMp4Url:url',
            'downloadShdMp4Url:url',
            [
                'attribute' => 'shdMp4Size',
                'value' =>($model['shdMp4Size']/1024/1024)>20?round($model['shdMp4Size']/1024/1024/1024,2).'GB':round($model['shdMp4Size']/1024/1024,2).'MB',
            ],
            'sdFlvUrl:url',
            'downloadSdFlvUrl:url',
            [
                'attribute' => 'sdFlvSize',
                'value' =>($model['sdFlvSize']/1024/1024)>20?round($model['sdFlvSize']/1024/1024/1024,2).'GB':round($model['sdFlvSize']/1024/1024,2).'MB',
            ],
            'hdFlvUrl:url',
            'downloadHdFlvUrl:url',
            [
                'attribute' => 'hdFlvSize',
                'value' =>($model['hdFlvSize']/1024/1024)>20?round($model['hdFlvSize']/1024/1024/1024,2).'GB':round($model['hdFlvSize']/1024/1024,2).'MB',
            ],
            'shdFlvUrl:url',
            'downloadShdFlvUrl:url',
            [
                'attribute' => 'shdFlvSize',
                'value' =>($model['shdFlvSize']/1024/1024)>20?round($model['shdFlvSize']/1024/1024/1024,2).'GB':round($model['shdFlvSize']/1024/1024,2).'MB',
            ],
            'sdHlsUrl:url',
            'downloadSdHlsUrl:url',
            [
                'attribute' => 'sdHlsSize',
                'value' =>($model['sdHlsSize']/1024/1024)>20?round($model['sdHlsSize']/1024/1024/1024,2).'GB':round($model['sdHlsSize']/1024/1024,2).'MB',
            ],
            'hdHlsUrl:url',
            'downloadHdHlsUrl:url',
            [
                'attribute' => 'hdHlsSize',
                'value' =>($model['hdHlsSize']/1024/1024)>20?round($model['hdHlsSize']/1024/1024/1024,2).'GB':round($model['hdHlsSize']/1024/1024,2).'MB',
            ],
            'shdHlsUrl:url',
            'downloadShdHlsUrl:url',
            [
                'attribute' => 'shdHlsSize',
                'value' =>($model['shdHlsSize']/1024/1024)>20?round($model['shdHlsSize']/1024/1024/1024,2).'GB':round($model['shdHlsSize']/1024/1024,2).'MB',
            ],
            [
                'attribute' => 'createTime',
                 'value' => $model['createTime']?date('Y-m-d H:i',substr($model['createTime'],0,10)):'',
            ],
            [
                'attribute' => 'updateTime',
                 'value' => $model['updateTime']?date('Y-m-d H:i',substr($model['updateTime'],0,10)):'',
            ],   
            [
                'attribute' => 'is_exists',
                 'value' => $model['is_exists']?'是':'否',
            ],   
        ],
    ]) ?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
   </div>
</div>


<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_items".
 *
 * @property integer $vid
 * @property string $videoName
 * @property integer $status
 * @property string $description
 * @property string $completeTime
 * @property integer $duration
 * @property integer $typeId
 * @property string $typeName
 * @property string $snapshotUrl
 * @property string $origUrl
 * @property string $downloadOrigUrl
 * @property string $initialSize
 * @property string $sdMp4Url
 * @property string $downloadSdMp4Url
 * @property string $sdMp4Size
 * @property string $hdMp4Url
 * @property string $downloadHdMp4Url
 * @property string $hdMp4Size
 * @property string $shdMp4Url
 * @property string $downloadShdMp4Url
 * @property string $shdMp4Size
 * @property string $sdFlvUrl
 * @property string $downloadSdFlvUrl
 * @property string $sdFlvSize
 * @property string $hdFlvUrl
 * @property string $downloadHdFlvUrl
 * @property string $hdFlvSize
 * @property string $shdFlvUrl
 * @property string $downloadShdFlvUrl
 * @property string $shdFlvSize
 * @property string $sdHlsUrl
 * @property string $downloadSdHlsUrl
 * @property string $sdHlsSize
 * @property string $hdHlsUrl
 * @property string $downloadHdHlsUrl
 * @property string $hdHlsSize
 * @property string $shdHlsUrl
 * @property string $downloadShdHlsUrl
 * @property string $shdHlsSize
 * @property string $createTime
 * @property string $updateTime
 * @property integer $is_exists
 * @property integer $is_delete
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid'], 'required'],
            [['vid', 'status', 'completeTime', 'duration', 'typeId', 'initialSize', 'sdMp4Size', 'hdMp4Size', 'shdMp4Size', 'sdFlvSize', 'hdFlvSize', 'shdFlvSize', 'sdHlsSize', 'hdHlsSize', 'shdHlsSize', 'createTime', 'updateTime', 'is_exists', 'is_delete','course_id'], 'integer'],
            [['videoName', 'description', 'typeName', 'origUrl', 'sdMp4Url', 'hdMp4Url', 'shdMp4Url', 'sdFlvUrl', 'hdFlvUrl', 'shdFlvUrl', 'sdHlsUrl', 'hdHlsUrl', 'shdHlsUrl'], 'string', 'max' => 255],
            [['snapshotUrl', 'downloadOrigUrl', 'downloadSdMp4Url', 'downloadHdMp4Url', 'downloadShdMp4Url', 'downloadSdFlvUrl', 'downloadHdFlvUrl', 'downloadShdFlvUrl', 'downloadSdHlsUrl', 'downloadHdHlsUrl', 'downloadShdHlsUrl'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vid' => '视频ID',
            'videoName' => '视频名称',
            'status' => '状态',
            'description' => '视频简介',
            'completeTime' => '转码完成时间',
            'duration' => '时长',
            'typeId' => '视频分类',
            'typeName' => '分类名称',
            'snapshotUrl' => '视频封面',
            'origUrl' => '原始播放地址',
            'downloadOrigUrl' => '原始下载地址',
            'initialSize' => '占用空间',
            'sdMp4Url' => '标清Mp4格式播放地址',
            'downloadSdMp4Url' => '标清Mp4格式下载地址',
            'sdMp4Size' => '标清Mp4格式文件大小',
            'hdMp4Url' => '高清Mp4格式播放地址',
            'downloadHdMp4Url' => '高清Mp4格式下载地址',
            'hdMp4Size' => '高清Mp4格式文件大小',
            'shdMp4Url' => '超清Mp4格式播放地址',
            'downloadShdMp4Url' => '超清Mp4格式下载地址',
            'shdMp4Size' => '超清Mp4格式文件大小',
            'sdFlvUrl' => '标清Flv格式播放地址',
            'downloadSdFlvUrl' => '标清Flv格式下载地址',
            'sdFlvSize' => '标清Flv格式文件大小',
            'hdFlvUrl' => '高清Flv格式播放地址',
            'downloadHdFlvUrl' => '高清Flv格式下载地址',
            'hdFlvSize' => '高清Flv格式文件大小',
            'shdFlvUrl' => '超清Flv格式播放地址',
            'downloadShdFlvUrl' => '超清Flv格式下载地址',
            'shdFlvSize' => '超清Flv格式文件大小',
            'sdHlsUrl' => '标清Hls格式播放地址',
            'downloadSdHlsUrl' => '标清Hls格式下载地址',
            'sdHlsSize' => '标清Hls格式文件大小',
            'hdHlsUrl' => '高清Hls格式播放地址',
            'downloadHdHlsUrl' => '高清Hls格式下载地址',
            'hdHlsSize' => '高清Hls格式文件大小',
            'shdHlsUrl' => '超清Fls格式播放地址',
            'downloadShdHlsUrl' => '超清Fls格式下载地址',
            'shdHlsSize' => '超清Fls格式文件大小',
            'createTime' => '创建日期',
            'updateTime' => '更新日期',
            'is_exists' => '是否存在外网（网易）',
            'course_id' => '所属课程',
        ];
    }
    public function getItemsType()
    {
        return $this->hasOne(ItemsType::className(), ['typeId' => 'typeId']);
    }
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
  
}

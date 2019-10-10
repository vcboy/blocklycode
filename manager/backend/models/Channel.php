<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_channel".
 *
 * @property integer $id
 * @property string $cid
 * @property string $name
 * @property integer $ctime
 * @property string $push_url
 * @property string $http_pull_url
 * @property string $hls_pull_url
 * @property string $rtmp_pull_url
 * @property integer $status
 */
class Channel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','cid'],'required'],
            [['ctime', 'status'], 'integer'],
            //[['cid', 'name', 'push_url', 'http_pull_url', 'hls_pull_url', 'rtmp_pull_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => '频道ID',
            'name' => '频道名称',
            'ctime' => '创建日期',
            'push_url' => '推流地址',
            'http_pull_url' => '拉流地址（HTTP）',
            'hls_pull_url' => '拉流地址（HLS）',
            'rtmp_pull_url' => '拉流地址（RTMP）',
            'status' => '状态',
            'type' => '频道类型',
            'is_exists' => '是否存在外网（网易）',
            'uid' => '用户ID',
            'need_record' => '开启录制',
            'format' => '视频格式',
            'duration' => '切片长度',
            'filename' => '视频名称',
        ];
    }
    public function getCourse()
    {
        return $this->hasMany(Course::className(), ['channel_id' => 'cid']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_items_preset".
 *
 * @property integer $presetId
 * @property string $presetName
 * @property integer $sdMp4
 * @property integer $hdMp4
 * @property integer $shdMp4
 * @property integer $sdFlv
 * @property integer $hdFlv
 * @property integer $shdFlv
 * @property integer $sdHls
 * @property integer $hdHls
 * @property integer $shdHls
 * @property integer $isDel
 * @property integer $is_delete
 * @property integer $is_exists
 */
class ItemsPreset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_items_preset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presetId'], 'required'],
            [['presetId', 'sdMp4', 'hdMp4', 'shdMp4', 'sdFlv', 'hdFlv', 'shdFlv', 'sdHls', 'hdHls', 'shdHls', 'isDel', 'is_delete', 'is_exists'], 'integer'],
            [['presetName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presetId' => 'Preset ID',
            'presetName' => '模板名称',
            'sdMp4' => 'Sd Mp4',
            'hdMp4' => 'Hd Mp4',
            'shdMp4' => 'Shd Mp4',
            'sdFlv' => 'Sd Flv',
            'hdFlv' => 'Hd Flv',
            'shdFlv' => 'Shd Flv',
            'sdHls' => 'Sd Hls',
            'hdHls' => 'Hd Hls',
            'shdHls' => 'Shd Hls',
            'isDel' => '是否能编辑',
            'is_delete' => 'Is Delete',
            'is_exists' => '是否存在外网（网易）',
        ];
    }
}

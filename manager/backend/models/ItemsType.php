<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_items_type".
 *
 * @property integer $typeId
 * @property string $typeName
 * @property string $desc
 * @property integer $number
 * @property integer $isDel
 * @property string $createTime
 */
class ItemsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_items_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeName','typeId'], 'required', 'message'=>'{attribute}不能为空'],
            [['number', 'isDel', 'createTime'], 'integer'],
            [['typeName', 'desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typeId' => 'Type ID',
            'typeName' => '分类名称',
            'desc' => '描述信息',
            'number' => '文件数量',
            'isDel' => '是否能编辑',
            'createTime' => '创建日期',
            'is_exists' => '是否存在外网（网易）',
        ];
    }
}

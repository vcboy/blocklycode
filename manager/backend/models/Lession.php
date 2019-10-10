<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%lession}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $description
 */
class Lession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lession}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required','message'=>'{attribute}不能为空'],
            [['description'], 'string'],
            [['name', 'img'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '课程名称',
            'average' => '平均分',
            'img' => '封面',
            'description' => '描述',
        ];
    }
}

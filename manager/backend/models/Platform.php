<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_platform".
 *
 * @property integer $id
 * @property string $name
 * @property string $describe
 */
class Platform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_platform';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['id'], 'required'],
            [['id'], 'integer'],
            
            [['public_key', 'private_key'], 'string', 'max' => 64]*/
            [['name','public_key', 'private_key'], 'required', 'message'=>'{attribute}不能为空'],
            [['name'], 'unique', 'message'=>'{attribute}已经存在'],
            [['describe'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '平台名称',
            'describe' => '描述',
            'public_key' => '公钥',
            'private_key' => '私钥'
        ];
    }
}

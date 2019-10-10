<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%jf}}".
 *
 * @property integer $id
 * @property integer $mid
 * @property double $jf
 * @property string $way
 */
class Jf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jf}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mid'], 'integer'],
            [['jf'], 'number'],
            [['way'], 'string', 'max' => 64],
            [['datetime'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mid' => '会员id',
            'jf' => '积分',
            'way' => '获取方式',
            'datetime' => '时间',
        ];
    }

    public function getMember(){
        return $this->hasOne(Member::className(), ['id' => 'mid']);
    }
}

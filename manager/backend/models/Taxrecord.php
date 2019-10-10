<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%taxrecord}}".
 *
 * @property integer $id
 * @property string $taitou
 * @property string $taxno
 * @property double $taxnum
 * @property string $tax_time
 * @property integer $mid
 */
class Taxrecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%taxrecord}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxnum'], 'number'],
            [['mid'], 'required'],
            [['mid','isdone'], 'integer'],
            [['taitou'], 'string', 'max' => 128],
            [['taxno'], 'string', 'max' => 32],
            [['tax_time'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taitou' => '发票抬头',
            'taxno' => '企业税号',
            'taxnum' => '开票金额',
            'tax_time' => '申请时间',
            'mid' => '申请人',
            'isdone' => '是否开票',
        ];
    }

    public function getMember(){
        return $this->hasOne(Member::className(), ['id' => 'mid']);
    }
}

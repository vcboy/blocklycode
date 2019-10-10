<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $order_no
 * @property double $price
 * @property string $order_time
 * @property integer $state
 * @property integer $mid
 * @property integer $is_delete
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_no', 'price', 'order_time', 'state', 'mid'], 'required'],
            [['price'], 'number'],
            [['state', 'mid', 'is_delete'], 'integer'],
            [['order_no'], 'string', 'max' => 32],
            [['order_time'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => '订单号',
            'price' => '价格',
            'order_time' => '订单时间',
            'plan_id' => '活动名',
            'state' => '支付状态',
            'mid' => '会员',
            'is_delete' => 'Is Delete',
            'source' => '活动类型',
        ];
    }

    public function getMember(){
        return $this->hasOne(Member::className(), ['id' => 'mid']);
    }

    public function getPlan(){
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }
}

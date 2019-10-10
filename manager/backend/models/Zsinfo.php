<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%zsinfo}}".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property integer $source
 * @property integer $sid
 * @property integer $zs_id
 */
class Zsinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zsinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'plan_id', 'source', 'sid', 'zs_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_id' => '活动名',
            'source' => '活动类型',
            'sid' => '对应报名',
            'zs_id' => '招生人员',
            'mid' => '会员',
        ];
    }

    public function getPlan(){
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    public function getZs(){
        return $this->hasOne(Admin::className(), ['id' => 'zs_id']);
    }

    public function getMember(){
        return $this->hasOne(Member::className(), ['id' => 'mid']);
    }
}

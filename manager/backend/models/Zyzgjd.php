<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%zyzgjd_table}}".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property string $name
 * @property integer $sex
 * @property string $birthday
 * @property integer $edu_level
 * @property integer $card_type
 * @property string $sfz
 * @property string $nation
 * @property integer $hukou_type
 * @property string $company
 * @property string $address
 * @property string $zipcode
 * @property string $tel
 * @property string $phone
 * @property string $email
 * @property integer $zhiye_type
 * @property integer $zhicheng_type
 * @property string $sbzy
 * @property integer $sbjb
 * @property integer $examtype
 * @property integer $khkm
 * @property integer $is_delete
 */
class Zyzgjd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zyzgjd_table}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id', 'sex', 'edu_level', 'card_type', 'hukou_type', 'zhiye_type', 'zhicheng_type', 'sbjb', 'examtype', 'khkm', 'is_delete'], 'integer'],
            [['name', 'sfz', 'email'], 'string', 'max' => 64],
            [['birthday', 'tel', 'phone'], 'string', 'max' => 32],
            [['nation', 'company', 'address', 'sbzy'], 'string', 'max' => 128],
            [['zipcode'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_id' => '活动id',
            'name' => '姓名',
            'sex' => '1：男 0：女',
            'birthday' => '出生年月',
            'edu_level' => '文化程度',
            'card_type' => '证件类型',
            'sfz' => '证件号码',
            'nation' => '户籍所在地',
            'hukou_type' => '户口性质',
            'company' => '单位名称',
            'address' => '通讯地址',
            'zipcode' => '邮政编码',
            'tel' => '联系电话',
            'phone' => '手机号码',
            'email' => '电子邮件',
            'zhiye_type' => '现职业资格',
            'zhicheng_type' => '现职称',
            'sbzy' => '申报职业',
            'sbjb' => '申报级别',
            'examtype' => '考试类型',
            'khkm' => '考核科目',
            'is_delete' => 'Is Delete',
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $cid
 * @property string $tel
 * @property string $username
 * @property string $pass
 * @property double $jf
 * @property integer $source
 * @property integer $sid
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jf'], 'number'],
            [['source', 'sid'], 'integer'],
            [['username','name','pass'], 'required'],
            [['name', 'cid', 'username', 'pass'], 'string', 'max' => 64],
            [['tel'], 'string', 'max' => 32],
            [["username"], "checkusername",'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    public function checkusername($attribute, $params){
        if($this->isNewRecord){
            if($this->username){
                $isphone = is_username($this->username);
                if(!$isphone){
                    $this->addError($attribute, "用户名只能包含字母、数字、下划线.");
                    return;
                }
                $num = self::find()->where(['username'=>$this->username])->count();         
                if($num > 0)
                    $this->addError($attribute, "该用户名已经存在.");
            }
        }else{
            if($this->phone){
                $isphone = is_username($this->phone);
                if(!$isphone){
                    $this->addError($attribute, "用户名只能包含字母、数字、下划线.");
                    return;
                }
                $obj = self::find()->where(['phone'=>$this->phone,'corp_id'=>$corp_id])->one();
                if($obj && $obj->id != $this->id){
                    $this->addError($attribute, "该用户名已经存在.");
                }
            }
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'cid' => '身份证',
            'tel' => '手机号码',
            'username' => '用户名',
            'pass' => '密码',
            'jf' => '积分',
            'source' => '活动类型',
            'sid' => '对应报名id',
            'getway' => '证书领取方式',
            'address' => '地址',
            'express_name' => '联系人',
            'express_tel' => '联系电话',
            'lan_ip' => '内网ip',
            'wan_ip' => '外网ip',
        ];
    }
}

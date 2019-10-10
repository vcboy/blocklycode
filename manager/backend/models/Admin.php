<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property integer $gender
 * @property integer $correspondence_id
 * @property string $role_name
 * @property integer $is_delete
 * @property string $courseids
 * @property string $disciplineids
 * @property string $oldpassword
 * @property string $checkpassword
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $status;
    public $authKey;
    public $accessToken;

    //旧密码
    public $oldpassword;

    //确认密码
    public $checkpassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required', 'message'=>'{attribute}不能为空'],
            [['username'], 'unique', 'message'=>'{attribute}已经存在'],
            //[['password'], 'required', 'message'=>'{attribute}不能为空'],
            [['name'], 'required', 'message'=>'{attribute}不能为空'],
            [['gender', 'is_delete', 'correspondence_id'], 'integer'],
            [['courseids','disciplineids'], 'string'],
            [['username', 'name'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
            [['role_name'], 'string', 'max' => 64]
        ];
    }

    public static function findByUsername($username) {
        $user = Admin::find()->where(['username' => $username])->one();
        if ($user) {
            return new static($user);
        }
        return null;
    }

    public function validatePassword($password){
        if(md5($password) == $this -> password){
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $user = self::findById($id);
        if ($user) {
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        $user = Admin::find()->where(array('accessToken' => $token))->one();
        if ($user) {
            return new static($user);
        }
        return null;
    }

    public static function findById($id) {
        $user = Admin::find()->where(array('id' => $id))->asArray()->one();
        if ($user) {
            return new static($user);
        }
            return null;
    }
    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }
    /*
     * 得到性别名称
     */
    public function getGenderName(){
        $gender = Yii::$app->params['gender'];
        $name = array_key_exists($this->gender,$gender)?$gender[$this->gender]:'';
        return $name;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'name' => '姓名',
            'gender' => '性别',
            'correspondence_id' => '函授站',
            'role_name' => '角色名称',
            'courseids' => '课程名称',
            'disciplineids' => '专业名称',
            'oldpassword' => '原密码',
            'checkpassword' => '确认密码',
        ];
    }

    /*
     * 得到角色名称
     */
    public function getRoleName(){
        $name = '';
        if($this->role_name){
            $role = RoleForm::findOne(['name'=>$this->role_name]);
            $name = $role -> description;
        }
        return $name;
    }

    /*
     * 保存前做一些操作
     */
    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->password = md5($this->password);
            }else{
                if(!empty($this->password)){
                    $this->password = md5($this->password);
                }else{
                    unset($this->password);
                }
            }
            return true;
        }else{
            return false;
        }
    }
    /*
     * 保存后做一些操作
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $auth = Yii::$app->authManager;
        if($insert) {
            //这里是新增数据
        } else {
            //这里是更新数据
            $auth->revokeAll($this->id);
        }
        $role = $auth ->getRole($this->role_name);
        $auth->assign($role,$this->id);
    }
}

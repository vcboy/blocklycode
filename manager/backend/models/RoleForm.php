<?php

namespace backend\models;

use Yii;
use backend\models\AuthItem;
use yii\rbac\Item;

/**
 * 角色model
 */
class RoleForm extends AuthItem
{
    public function init(){
        parent::init();
        $this->type = Item::TYPE_ROLE;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message'=>'{attribute}不能为空'],
            [['name'], 'unique', 'message'=>'{attribute}已经存在'],
            [['description'], 'required', 'message'=>'{attribute}不能为空'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => '角色编码',
            'type' => '类型',
            'description' => '角色名称',
            'rule_name' => '规则名称',
            'data' => '数据',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public static function getRoleList(){
        $myData = [''=>'请选择'];
        $myRole = self::find()->where(['type' => Item::TYPE_ROLE])->orderBy(['name' => SORT_ASC])->all();
        foreach($myRole as $k => $v){
            $myData[$v->name] = $v->description;
        }
        return $myData;
    }
}

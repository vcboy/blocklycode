<?php

namespace backend\models;

use Yii;
use backend\models\AuthItem;
use backend\models\Menu;
use yii\rbac\Item;

/**
 * 权限model
 */
class PermissionForm extends AuthItem
{
    public function init(){
        parent::init();
        $this->type = Item::TYPE_PERMISSION;
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
            [['menu_id'], 'required', 'message'=>'{attribute}不能为空'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => '权限编码',
            'type' => '类型',
            'description' => '权限名称',
            'rule_name' => '规则名称',
            'data' => '数据',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'menu_id' => '权限所属菜单',
        ];
    }
    /*
     * 得到权限名称
     */
    public function getMenuName(){
        $menuName = '';
        $menu = new Menu();
        $myData = $menu ->findOne($this->menu_id);
        if(!empty($myData)){
            $menuName = $myData -> name ;
        }
        return $menuName;

    }
}

<?php
namespace backend\components;

use Yii;
use yii\base\Widget;
use backend\models\Admin;
use backend\models\Menu;

class LeftWidget extends Widget{
    public function init(){
       parent::init();
    }

    public function run(){
        $admin = Admin::findById(Yii::$app -> user -> id);
        //START-得到左侧菜单
        $menu = new Menu();
        /****判断登录用户拥有的菜单 START******************************************************************************/
        $auth = Yii::$app->authManager;
        $userid = Yii::$app->user->identity->id;
        $leftMenu = $menu ->getUserLeftMenu($userid);
        /****判断登录用户拥有的菜单 END******************************************************************************/
        //END-得到左侧菜单
        return $this -> render('left',['admin' => $admin,'leftMenu' => $leftMenu]);
    }

}

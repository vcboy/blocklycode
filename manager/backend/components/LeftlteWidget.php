<?php
namespace backend\components;

use Yii;
use yii\base\Widget;
use backend\models\Admin;
use backend\models\Menu;

class LeftlteWidget extends Widget{
    public function init(){
       parent::init();
    }

    public function run(){
        $admin = Admin::findById(Yii::$app -> user -> id);

        $menu = new Menu();

        $auth = Yii::$app->authManager;
        $userid = Yii::$app->user->identity->id;
        $leftMenu = $menu ->getUserLeftMenu($userid);

        return $this -> render('leftlte',['admin' => $admin,'leftMenu' => $leftMenu]);
    }

}

<?php
namespace backend\components;
use Yii;
use yii\base\Widget;
use backend\models\Admin;
class ToplteWidget extends Widget{
    public function init(){
        parent::init();
    }

    public function run(){
        $admin = Admin::findById(Yii::$app -> user -> id);
        return $this -> render('toplte',['admin' => $admin]);
    }
}

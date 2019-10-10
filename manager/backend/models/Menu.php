<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\PermissionForm;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $route
 * @property integer $taxis
 * @property string $data
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $select_option = [0 => '无'];
    public $menu_list = [];
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message'=>'{attribute}不能为空'],
            [['parent'], 'integer'],
            [['taxis'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 256],
            [['url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parent' => '上级菜单',
            'route' => 'Route',
            'taxis' => '排序字段',
            'data' => 'Data',
            'url' => '链接地址',
        ];
    }
    /*
     * 得到菜单的权限
     */
    public function getPermissionList(){
        $permissionForm = new PermissionForm();
        $list = $permissionForm->find()->andFilterWhere(['=','menu_id',$this->id])->all();
        $name_arr = [];
        foreach($list as $k => $v){
            //array_push($name_arr,$v->description);
            $name_arr[$v->name] = $v->description;
        }
        return $name_arr;
    }
    /*
     * 得到上级菜单名称
     */
    public function getParentName(){
        //$menuList = self::getSelectList();
        //return array_key_exists($this->parent,$menuList)?$menuList[$this->parent]:'';
        $parentName = '';
        if($this->parent){
            $parent = self::findOne(['id'=>$this->parent]);
            $parentName = $parent -> name;
        }
        return $parentName;
    }
    //递归生成树形数组
    function getSelectList($pid = 0,$str = '',$currentId = 0){
        $num = self::find()->where(['parent' => $pid])->count();
        //$obj = self::find()->where(['parent' => $pid])->orderBy(['taxis'=>SORT_DESC])->all();
        //$num = ArrayHelper::toArray($obj);
        if($num){
            $obj = self::find()->where(['parent' => $pid])->orderBy(['taxis' => SORT_DESC])->all();
            $rows = ArrayHelper::toArray($obj);
            foreach($rows as $k => $v){
                if($str != ""){
                    $t = "┕━";
                }else{
                    $t = '';
                }
                $this->select_option[$v['id']] =  $str.$t.$v['name'];
                $this->getSelectList($v['id'],"━━".$str);
                $se = '';
            }
        }
        return $this->select_option;
        //return $num;
    }
    //递归生成菜单列表数组
    function getMenuList($pid = 0,$str = '',$name = ''){
        $numObj = self::find()->where(['parent' => $pid]);
        if(strlen($name)){
            $numObj ->andFilterWhere(['like','name',$name]);
        }
        $num = $numObj->count();
        //$obj = self::find()->where(['parent' => $pid])->orderBy(['taxis'=>SORT_DESC])->all();
        //$num = ArrayHelper::toArray($obj);
        if($num){
            $rowsObj = self::find()->where(['parent' => $pid]);
            if(strlen($name)){
                $rowsObj -> andFilterWhere(['like','name',$name]);
            }
            $rows = $rowsObj->orderBy(['taxis' => SORT_DESC])->all();
            //$rows = ArrayHelper::toArray($obj);
            foreach($rows as $k => $v){
                if($str != ""){
                    $t = "┕━";
                }else{
                    $t = '';
                }
                $this->menu_list[$v->id] =  ['id'=>$v->id,'name'=>$str.$t.$v->name,'url'=>$v->url,'taxis'=>$v->taxis,'permission'=>$v->getPermissionList()];
                $this->getMenuList($v->id,"━━".$str,$name);
                $se = '';
            }
        }
        return $this->menu_list;
        //return $num;
    }
    /*
     * 得到左侧菜单数组
     */
    function getLeftMenu(){
        $leftMenu = [];
        $firstRows = self::find()->where(['parent'=>0])->orderBy(['taxis'=>SORT_DESC])->all();
        foreach($firstRows as $k_1 => $v_1){
            $leftMenu[$v_1->id]['id']       = $v_1->id;
            $leftMenu[$v_1->id]['name']     = $v_1->name;
            $leftMenu[$v_1->id]['parent']   = $v_1->parent;
            $leftMenu[$v_1->id]['url']      = $v_1->url;
            $leftMenu[$v_1->id]['permission'] = $v_1->getPermissionList();
            $sonCount = self::find()->where(['parent'=>$v_1->id])->count();
            if($sonCount){
                $secondRows = self::find()->where(['parent'=>$v_1->id])->orderBy(['taxis'=>SORT_DESC])->all();
                foreach($secondRows as $k_2 => $v_2){
                    $leftMenu[$v_1->id]['sons'][$v_2->id]['id']         = $v_2->id;
                    $leftMenu[$v_1->id]['sons'][$v_2->id]['name']       = $v_2->name;
                    $leftMenu[$v_1->id]['sons'][$v_2->id]['parent']     = $v_2->parent;
                    $leftMenu[$v_1->id]['sons'][$v_2->id]['url']        = $v_2->url;
                    $leftMenu[$v_1->id]['sons'][$v_2->id]['permission'] = $v_2->getPermissionList();
                    $son2Count = self::find()->where(['parent'=>$v_2->id])->count();
                    if($son2Count){
                        $thirdRows = self::find()->where(['parent'=>$v_2->id])->orderBy(['taxis'=>SORT_DESC])->all();
                        foreach($thirdRows as $k_3 => $v_3){
                            $leftMenu[$v_1->id]['sons'][$v_2->id]['sons'][$v_3->id]['id']         = $v_3->id;
                            $leftMenu[$v_1->id]['sons'][$v_2->id]['sons'][$v_3->id]['name']       = $v_3->name;
                            $leftMenu[$v_1->id]['sons'][$v_2->id]['sons'][$v_3->id]['parent']     = $v_3->parent;
                            $leftMenu[$v_1->id]['sons'][$v_2->id]['sons'][$v_3->id]['url']        = $v_3->url;
                            $leftMenu[$v_1->id]['sons'][$v_2->id]['sons'][$v_3->id]['permission'] = $v_3->getPermissionList();
                        }
                    }else{
                        $leftMenu[$v_1->id]['sons'][$v_2->id]['sons'] = [];
                    }
                }
            }else{
                $leftMenu[$v_1->id]['sons'] = [];
            }
        }
        return $leftMenu;
    }
    /*
     * 得到所有的菜单的数组
     */
    function getAllMenuData(){
        $myData = [];
        $menuList = self::find()->all();
        foreach($menuList as $k => $v){
            $myData[$v->id]['id']   = $v->id;
            $myData[$v->id]['name'] = $v->name;
            $myData[$v->id]['url']  = $v->url;
        }
        return $myData;
    }
    /*
     * 根据用户权限，得到用户的菜单
     */
    function getUserLeftMenu($userid){
        $auth = Yii::$app->authManager;
        $leftMenu = $this->getLeftMenu();
        foreach($leftMenu as $k_1 => $v_1){
            if($v_1['sons']){
                foreach($v_1['sons'] as $k_2 => $v_2){
                    $permission_2 = 0;
                    if($v_2['permission']){
                        foreach($v_2['permission'] as $k_p_2 => $v_p_2){
                            if($auth->checkAccess($userid,$k_p_2)){
                                $permission_2 = 1;
                                break;
                            }
                        }
                    }
                    if($v_2['sons']){

                        foreach($v_2['sons'] as $k_3 => $v_3){
                            $permission_3 = 0;
                            if($v_3['permission']){
                                foreach($v_3['permission'] as $k_p_3 => $v_p_3){
                                    if($auth->checkAccess($userid,$k_p_3)){
                                        $permission_3 = 1;
                                        break;
                                    }
                                }
                            }
                            if($permission_3 == 0){
                                unset($leftMenu[$k_1]['sons'][$k_2]['sons'][$k_3]);
                            }else{
                                $permission_2 = 1;
                            }
                        }
                    }
                    if($permission_2 == 0){
                        unset($leftMenu[$k_1]['sons'][$k_2]);
                    }
                }
            }
        }
        return $leftMenu;
    }
}

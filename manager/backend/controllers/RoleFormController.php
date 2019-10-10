<?php

namespace backend\controllers;

use Yii;
use backend\models\RoleForm;
use backend\models\RoleFormSearch;
use yii\rbac\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;
use backend\models\Menu;
use yii\rbac\Role;
use yii\rbac\ManagerInterface;

/**
 * RoleFormController implements the CRUD actions for RoleForm model.
 */
class RoleFormController extends CController
{
    public function init(){
        parent::init();
        $this->subject = '角色管理';
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RoleForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $searchModel = new RoleFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ] + $request->get()
        );
    }

    /**
     * Displays a single RoleForm model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RoleForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RoleForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RoleForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RoleForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /*
     * 实际删除方法（用了sweetalert后，上面那个有问题，一模一样的地址404错误，找不到原因，用这个代替）
     */
    public function actionDodelete(){
        $params = Yii::$app->request->get();
        if($params['id']){
            $id = $params['id'];
            //PermissionForm::deleteAll(['name' => $params['id']]);
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }
    /**
     * Finds the RoleForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RoleForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoleForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * 设置角色权限
     */
    public function actionPermission($id){
        $request = Yii::$app->request;
        $role = new RoleForm();
        $roleData = $role ->findOne(['name' => $id]);
        $otherRoleData = $role ->find() ->where("name <> '$id'")->andWhere(['type'=>Item::TYPE_ROLE])->all();
        $menu = new Menu();
        $menuList = $menu ->getMenuList();
        $auth = Yii::$app->authManager;
        $children = $auth->getChildren($id);
        $myRole = $auth ->getRole($id);
        if ($request->isPost){
            $auth->removeChildren($myRole);
            $rolebox = $request->post('rolebox');
            if(!empty($rolebox)){
                foreach($rolebox as $k => $v){
                    $child = $auth->getRole($v);
                    $auth->addChild($myRole,$child);
                }
            }
            $ckbox = $request->post('ckbox');
            if(!empty($ckbox)){
                foreach($ckbox as $k => $v){
                    $child = $auth->getPermission($v);
                    $auth->addChild($myRole,$child);
                }
            }
            return $this->redirect(['index']);
            //print_r($request->post('ckbox'));
        }
        return $this->render('permission',[
                        'roleData'      => $roleData,
                        'otherRoleData' => $otherRoleData,
                        'menuList'      => $menuList,
                        'children'      => $children,
        ]);
    }
}

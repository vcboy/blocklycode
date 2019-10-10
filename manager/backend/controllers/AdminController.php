<?php

namespace backend\controllers;

use backend\models\Course;
use backend\models\Discipline;
use Yii;
use backend\models\Admin;
use backend\models\AdminSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;
use backend\models\Menu;
use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\formats\MailTo;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends CController
{
    public function init(){
        parent::init();
        $this->subject = '用户管理';
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $where = " and role_name != 'zhaosheng'";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all 招生人员.
     * @return mixed
     */
    public function actionMarketer()
    {
        $searchModel = new AdminSearch();
        $where = " and role_name = 'zhaosheng'";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        return $this->render('marketer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();
        $role_name = Yii::$app->request->get('role_name');
        $role_name = $role_name ? $role_name:'';
        if($role_name) $model->role_name = $role_name;
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) ) {
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model['is_delete'] = 1;
        $model -> save();

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
        //print_r($params);
    }
    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     *
     */
    public function actionQuickentry($id){
        $request = Yii::$app->request;
        $admin = new Admin();
        $adminData = $admin ->findOne(['id'=>$id]);
        $menu = new Menu();
        $menuList = $menu ->getUserLeftMenu($id);
        if($request->isPost){
            $ckbox = $request->post('ckbox');
            if(!empty($ckbox)){
                $allMenuData = $menu ->getAllMenuData();
                $my_quickentry = [];
                foreach($ckbox as $k => $v){
                    $my_quickentry[$v] = $allMenuData[$v];
                }
                $adminData ->my_quickentry = json_encode($my_quickentry);
                $adminData->save();
            }
            return $this->redirect(['index']);
        }
        return $this->render('quickentry',[
            'adminData'     => $adminData,
            'menuList'      => $menuList,
        ]);
    }

    public function actionShowCourse(){
        $userid = Yii::$app -> request -> post('userid');
        if($userid){
            $admin = Admin::findById($userid);
            $courseids = $admin -> courseids;
            $disciplineids = $admin -> disciplineids;
            return json_encode(['course' => $courseids,'discipline' => $disciplineids]);
        }
    }

    /**
     * 修改密码
     */
    public function actionEditPassword(){
        $this -> childSubject = '修改密码';
        $id = Yii::$app -> user -> id;
        $admin = new Admin();
        $adminData = $admin ->findOne(['id'=>$id]);
        if(Yii::$app -> request -> isPost){
            if(Yii::$app -> request -> post('Admin')['oldpassword']){
                if(md5(Yii::$app -> request -> post('Admin')['oldpassword']) == $adminData -> password){
                    $adminData -> password = Yii::$app -> request -> post('Admin')['password'];
                    $adminData -> save();
                    $message = '密码修改成功!';
                    Yii::$app -> session -> setFlash('message',$message);
                    return $this -> render('edit-password',['model' => $adminData]);
                }else{
                    $message = '原密码不正确!';
                    Yii::$app -> session -> setFlash('message',$message);
                    return $this -> render('edit-password',['model' => $adminData]);
                }
            }else{
                $message = '请输入原始密码！';
                Yii::$app -> session -> setFlash('message',$message);
                return $this -> render('edit-password',['model' => $adminData]);
            }
        }
        return $this -> render('edit-password',['model' => $adminData]);
    }


    public function actionQrcode(){
        return $this->render('qrcode');
    }

    public function actionMyqrcode(){
        return QrCode::png('https://www.cnblogs.com/',false,0,10);
    }
}

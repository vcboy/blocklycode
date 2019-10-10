<?php

namespace backend\controllers;

use Yii;
use backend\models\PermissionForm;
use backend\models\PermissionFormSearch;
use backend\models\Menu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;

/**
 * PermissionFormController implements the CRUD actions for PermissionForm model.
 */
class PermissionFormController extends CController
{
    private $menuList = [];
    public function init(){
        parent::init();
        $this->subject = '权限管理';
        $menuModel = new Menu();
        $menuList =  $menuModel->getSelectList();
        $this -> menuList = $menuList;
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
     * Lists all PermissionForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $searchModel = new PermissionFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'menuList' => $this -> menuList,
        ] + $request->get()
        );
    }

    /**
     * Displays a single PermissionForm model.
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
     * Creates a new PermissionForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermissionForm();
        $post = Yii::$app->request->post();
        unset($this -> menuList[0]);
        if ($model->load($post) && $model->save()) {
            $model->menu_id = $post['PermissionForm']['menu_id'];
            $model->save();
                return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'menuList' => $this -> menuList,
            ]);
        }
    }

    /**
     * Updates an existing PermissionForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        unset($this -> menuList[0]);
        if ($model->load($post) && $model->save()) {
            $model->menu_id = $post['PermissionForm']['menu_id'];
            $model->save();
                return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'menuList' => $this ->menuList,
            ]);
        }
    }

    /**
     * Deletes an existing PermissionForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $params = Yii::$app->request->get();
        if($params['id']){
            PermissionForm::deleteAll(['name' => $params['id']]);
        }
        return $this->render('create');
        //$this->findModel($id)->delete();

        //return $this->redirect(['index']);
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
     * Finds the PermissionForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PermissionForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermissionForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

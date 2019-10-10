<?php

namespace backend\controllers;

use Yii;
use backend\models\Menu;
use backend\models\MenuSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\CController;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends CController
{
    private $menuList = [];
    public function init(){
        parent::init();
        $menuModel = new Menu();
        $this -> menuList = $menuModel->getSelectList();
        $this->subject = '菜单管理';
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //print_r($dataProvider);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menuList' => $this -> menuList,
        ]);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'menuList' => $this -> menuList,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
                'menuList' => $this -> menuList,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
        //print_r($params);
    }
    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * 更新排序
     * If update is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionUpdateTaxis()
    {
        $request = Yii::$app->request;
        $ckbox = implode(',', $request->post('ckbox'));
        $sql_where = "id in ($ckbox)";
        $query = Menu::find()->where($sql_where)->all();
        foreach($query as $key=>$val){
            $val->taxis = $request->post("taxis_".$val['id']);
            $val->save();
        }
        return $this->redirect(['index']);
    }
}

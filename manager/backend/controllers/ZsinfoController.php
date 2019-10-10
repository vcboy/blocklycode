<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\Zsinfo;
use backend\models\ZsinfoSearch;
use backend\models\Plan;
use backend\models\Member;
use backend\components\CController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZsinfoController implements the CRUD actions for Zsinfo model.
 */
class ZsinfoController extends CController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Zsinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZsinfoSearch();
        $session = Yii::$app->getSession();
        $level = Yii::$app->user->identity->level;
        $zs_id = Yii::$app->user->identity->id;
        $where = $level!=1?" and zs_id = {$zs_id}":"";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        $tabletype=Yii::$app->params['tabletype'];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tabletype' => $tabletype,
        ]);
    }

    /**
     * Displays a single Zsinfo model.
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
     * Creates a new Zsinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zsinfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Zsinfo model.
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
            ]);
        }
    }

    /**
     * Deletes an existing Zsinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model['is_delete'] = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Zsinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zsinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zsinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\Taxrecord;
use backend\models\TaxrecordSearch;
use backend\components\CController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaxrecordController implements the CRUD actions for Taxrecord model.
 */
class TaxrecordController extends CController
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
     * Lists all Taxrecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaxrecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taxrecord model.
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
     * Creates a new Taxrecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Taxrecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Taxrecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tax_time = $model->tax_time;
        if ($model->load(Yii::$app->request->post())) {
            $model->tax_time = $tax_time;
            $model->save();
            /*var_dump($model->tax_time);
            var_dump($model->getErrors());*/
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Taxrecord model.
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
     * Finds the Taxrecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taxrecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taxrecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 开票
     */
    public function actionTaxdone(){
        $request = Yii::$app->request;
        $ckbox = implode(',', $request->post('ckbox'));
        $sql_where = "id in ($ckbox)";
        //echo $sql_where;
        $query = Taxrecord::find()->where($sql_where)->all();
        foreach($query as $key=>$val){
            $val->isdone = 1;
            $val->save();
        }
        return $this->redirect(['index']);
    }
}

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Member */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>会员查看</h1>
</div>
<div class="member-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'cid',
            'tel',
            'username',
            'pass',
            'jf',
            [
                'attribute'=>'source',
                'value' => function($model,$tabletype){
                    $tabletype=Yii::$app->params['tabletype'];
                    return $tabletype[$model->source];
                },
            ],
            [
                'attribute'=>'getway',
                'value' => function($model){
                    if( $model->getway == 1 ){
                        $str = '自取';
                    }else{
                        $str = "快递";
                    }
                    return $str;
                },
            ],
            'address',
            'express_name',
            'express_tel',
        ],
    ]) ?>
    <div class="clearfix form-actions">
        <div class="col-md-9 lmar">
            <?=Html::a('　返回　',Url::to(['index']), ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
   </div>
</div>

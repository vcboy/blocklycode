<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Zyzgjd */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Zyzgjds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zyzgjd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'plan_id',
            'name',
            'sex',
            'birthday',
            'edu_level',
            'card_type',
            'sfz',
            'nation',
            'hukou_type',
            'company',
            'address',
            'zipcode',
            'tel',
            'phone',
            'email:email',
            'zhiye_type',
            'zhicheng_type',
            'sbzy',
            'sbjb',
            'examtype',
            'khkm',
            'is_delete',
        ],
    ]) ?>

</div>

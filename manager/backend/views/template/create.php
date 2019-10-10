<?php
use yii\helpers\Html;
use backend\models\Template;


/* @var $this yii\web\View */
/* @var $model backend\models\Template */

$this->title = 'Create Template';
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">
    <?= $this->render('_form', [
        'model' => $model,
        'menulist'=>$menulist,
        'children'=>array(),

    ]) ?>

</div>

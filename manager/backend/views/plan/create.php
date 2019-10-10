	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Plan */

$this->title = '创建活动';
$this->params['breadcrumbs'][] = ['label' => 'Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'tabletype' => $tabletype,
        'lession' => $lession,
        'teacher' => $teacher,
    ]) ?>
    </div>
</div>

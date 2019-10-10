	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = '教师添加';
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
        'lession' => $lession,
    ]) ?>
    </div>
</div>

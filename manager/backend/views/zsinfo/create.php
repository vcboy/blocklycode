	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Zsinfo */

$this->title = 'Create Zsinfo';
$this->params['breadcrumbs'][] = ['label' => 'Zsinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zsinfo-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

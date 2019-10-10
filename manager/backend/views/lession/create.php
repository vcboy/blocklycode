	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Lession */

$this->title = 'Create Lession';
$this->params['breadcrumbs'][] = ['label' => 'Lessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lession-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

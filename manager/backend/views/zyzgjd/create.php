	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Zyzgjd */

$this->title = 'Create Zyzgjd';
$this->params['breadcrumbs'][] = ['label' => 'Zyzgjds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zyzgjd-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Jf */

$this->title = 'Create Jf';
$this->params['breadcrumbs'][] = ['label' => 'Jfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jf-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

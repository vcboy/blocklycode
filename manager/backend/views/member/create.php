	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Member */

$this->title = 'Create Member';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

	<div class="createfield"><?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Taxrecord */

$this->title = '开票记录';
$this->params['breadcrumbs'][] = ['label' => 'Taxrecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxrecord-create">
	<div class="createfield">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

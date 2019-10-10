<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::$app ->request -> baseUrl?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::$app ->request -> baseUrl?>/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::$app ->request -> baseUrl?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
 $(function(){
    var ue = UE.getEditor('editor');
 })
</script>
<div class="page-header">
    <h1><?=$this->title?></h1>
</div>
<div class="news-form editor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?php if(!$model->pic){?>
        <?=$form->field($model,'pic')->fileInput(['class'=>'form-control','id'=>'pic']);?>
    <?php }else{?>
         <div class="form-group field-channel-type" style="height: 160px">
            <label class="control-label" for="channel-name">图片</label>
            <div class="col-lg-3" style="display: inline-block;padding: 0px;"><img src="<?=Yii::$app -> request -> baseUrl.'/..'.str_replace('\\', '/',$model->pic);?>" style="vertical-align:text-top;margin-right:20px" height="150px;">
            <a href="<?=Url::to(['news/delimg','id'=>$model['id']])?>">删除</a>    
            </div>       
        </div>
    <?}?>

    <?//= $form->field($model, 'content')->textInput() ?>
    <?= $form->field($model, 'content')->textarea(['rows'=>16,'id'=>'editor','class'=>'col-sm-1 col-md-10 editorfield','style'=>'height:300px;']);?>
    <?//= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'datetime')->textInput(['value' => date("Y-m-d H:i:s", $model->datetime?$model->datetime:time())]); ?>

    <div class="form-group field-news-datetime">
    <label class="control-label" for="news-datetime">日期</label>
    <?=Html::textInput('datetime',date("Y-m-d",$model->datetime?$model->datetime:time()),['onfocus' => 'WdatePicker({dateFmt:"yyyy-MM-dd"})','readonly' => 'false','class' => 'form-control','style' => 'width:120px']);?>
    <div class="help-block"></div>
    </div>

    <div class="form-group">
    <?=  Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?=  Html::a('返回',Url::toRoute("index"),['class'=>'btn btn-primary'])?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

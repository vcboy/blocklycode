<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '登陆';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    
    input{-webkit-appearance: none;}
</style>

<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="my-center">
                    <!--img src="<?=Yii::$app -> request -> baseUrl?>/resource/images/logo.png"-->
                    <!--img src="<?=Yii::$app -> request -> baseUrl?>/resource/images/title.png"-->
                </div>
                <div class="login-container my-login-container">
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="icon-coffee green"></i>
                                        登录
                                    </h4>

                                    <div class="space-6"></div>
                                    <?php $form = ActiveForm::begin([
                                        'id' => 'login-form',
                                        'fieldConfig' =>
                                            [
                                                'template' => "{label}{input}{error}",
                                                'horizontalCssClasses' => [
                                                    'input' => 'form-control',
                                                ]
                                            ]
                                        ]); ?>
                                        <fieldset>
                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
												<?php ?>
                                                    <?= $form->field($model, 'username')->label(false) ->input('username',['placeholder' => '用户名']); ?>
                                                    <i class="icon-user"></i>
                                                </span>
                                            </label>

                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <?= $form->field($model, 'password') ->label(false)-> passwordInput(['placeholder' => '密码']); ?>
                                                    <i class="icon-lock"></i>
                                                </span>
                                            </label>
                                            <div class="clearfix">
                                                <?= Html::activeCheckbox($model,'rememberMe',['label' => '<span class="lbl">记住密码</span>','class' => 'ace']);?>
                                                <?= Html::submitButton('登陆', ['class' => 'width-35 pull-right btn btn-sm btn-primary', 'name' => 'login-button']) ?>
                                            </div>
                                            <div class="space-4"></div>
                                        </fieldset>
                                    <?php ActiveForm::end(); ?>
                                </div><!-- /widget-main -->

                            </div><!-- /widget-body -->
                        </div><!-- /login-box -->
                    </div><!-- /position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?=Yii::$app -> request -> baseUrl;?>/resource/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
    function show_box(id) {
        jQuery('.widget-box.visible').removeClass('visible');
        jQuery('#'+id).addClass('visible');
    }


</script>

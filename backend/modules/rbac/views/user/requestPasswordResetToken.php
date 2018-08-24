<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '管理登录';

$fieldOptions1 = [
    'options' => ['class' => 'layui-form-item'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h1>找回密码</h1>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form','options'=>['class' => 'layui-form'], 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['class' => 'layui-input','lay-verify'=>'required','placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="layui-form-item">
			<?= Html::submitButton('发送邮件', ['class' => 'layui-btn login_btn', 'name' => 'login-button']) ?>
        </div>
		
        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

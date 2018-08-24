<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '管理登录';

$fieldOptions1 = [
    'options' => ['class' => 'layui-form-item']
];

$fieldOptions2 = [
    'options' => ['class' => 'layui-form-item']
];
?>

<div>
	<h1>后台登录</h1>
</div>
<div>
	<?php $form = ActiveForm::begin(
			[
				'layout' => 'horizontal',
				'id' => 'login-form',
				'options'=>[
					'class' => 'layui-form'
					],
				'enableClientValidation' => false,
				'fieldConfig'=>[
					'template' => "{label}\n{input}\n{error}",
					'horizontalCssClasses' => [
						'label' => 'col-sm-4',
						'error' => 'login_error_msg',
					]
				]
				
			]
		); 
	?>

	<?= $form->field($model, 'username', $fieldOptions1)
		->label(false)
		->textInput(
				[
					'class' => 'layui-input',
					'lay-verify'=>'required',
					'placeholder' => $model->getAttributeLabel('username')
				]) 
	?>

	<?= $form->field($model, 'password', $fieldOptions2)
		->label(false)
		->passwordInput(
				[
					'class' => 'layui-input',
					'lay-verify'=>'required',
					'placeholder' => $model->getAttributeLabel('password')
				]) 
	?>


	<div class="layui-form-item">
		<?= Html::submitButton("登录", ['class' => 'layui-btn login_btn','lay-submit'=>'','name' => 'login-button']) ?>
	</div>

	<div>
		<div style="float: left;">
			<?= $form->field($model, 'rememberMe')->label(false)->checkbox(['class' => 'lay-ignore']) ?>
		</div>
		<div style="float: left;margin-top: 5px;color: #999;padding-left: -8px;font-size: 12px;">
			<span>记住密码</span>
		</div>
		<div style="float: right;margin-top: -5px;">
			<?= Html::a('忘记密码', ['/rbac/user/request-password-reset'], ['class' => 'layui-form-mid layui-word-aux',"style"=>'float:right;padding: 5px 0;']) ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>
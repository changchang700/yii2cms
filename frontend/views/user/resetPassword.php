<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php
$this->title = '重置密码';
?>
<div class="site-reset-password form-box form">
	<div class="form-login" id="landing">修改密码</div>
	<div class="landing-content-login">
			<?php $form = ActiveForm::begin([
				'id' => 'reset-password-form',
				'options'=>['enctype'=>'multipart/form-data','class' => 'form-horizontal'],
				'fieldConfig' => [
					'template' => "{label}\n<div class=\"inp\">{input}</div>\n<div class=\"col-lg-2 center\">{error}</div>", 
					'labelOptions' => ['class' => 'col-lg-2 control-label'],
				]
			]); ?>

			<?= $form->field($model, 'password')->label(false)->passwordInput(['autofocus' => true]) ?>

			<div class="form-group">
				<?= Html::submitButton('修改密码', ['class' => 'login']) ?>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
<script>
$('.inp input').focus(function(){
	$(this).parent().css({
		'box-shadow':'-2px -2px 5px #ccc',
	});
});
$('.inp input').blur(function(){
	$(this).parent().css({
		'box-shadow':'none',
	});
});
</script>
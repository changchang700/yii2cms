<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<?php
$this->title = '用户登录';
?>
<div class="form-box form">
	<div class="form-login">用户登陆</div>
	<div class="fix"></div>
	<div id="landing-content">
		<div class="photo">
			<img src="https://resources.alilinet.com/upload/file/2017/0609/caec0ef6f07036203d555810fd81c75a.jpg" />
		</div>
			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				'fieldConfig' => [
					'template' => "{label}\n<div class=\"inp\">{input}</div>\n<div class=\"col-lg-2 center\">{error}</div>", 
					'labelOptions' => ['class' => 'col-lg-2 control-label'],
				]
			]); ?>
		
			<?= $form->field($model, 'username')->label(false)->textInput(['placeholder'=>'请输入手机号或邮箱或用户名']) ?>
		
			<?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder'=>'请输入密码']) ?>
		
			<div class="inp" style="display: none">
				<?= $form->field($model, 'rememberMe')->checkbox() ?>
			</div>
		
		<div class="form-group">
			<?= Html::submitButton('登录', ['class' => 'login', 'name' => 'login-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
		<div class="icon_box">
			<a href="<?=Url::to(['oauth/geturl'])?>" class="auth_qq_btn" target="_blank"><img src="/images/qq.png"/></a>
			<a href="javascript:;" class="auth_zfb_btn" target="_blank"><img src="/images/zfb.png"/></a>
			<a href="javascript:;" class="auth_wx_btn" target="_blank"><img src="/images/wx.png"/></a>
			<a href="javascript:;" class="auth_wb_btn" target="_blank"><img src="/images/wb.png"/></a>
		</div>
		<div class="signup-bottom">
			<span class="bottom-left"><a href="<?=Url::to(['user/signup'])?>">立即注册</a></span>
			<span class="bottom-right"><a href="<?=Url::to(['user/forget'])?>">忘记密码</a></span>			
		</div>
	</div>
</div>
<script>
$(".auth_zfb_btn,.auth_wx_btn,.auth_wb_btn").click(function(){
	layer.msg("功能还未实现哦！");
});
</script>
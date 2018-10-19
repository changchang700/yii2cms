<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<?php
$this->title = '邮箱注册';
?>
<?php
if(!\yii::$app->request->isPost){
	//暂时这样解决吧
	echo '<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>';
}
?>
<div class="form-box form signup-all">
	<div class="form-login">邮件注册</div>
	<div class="fix"></div>
	<div id="landing-content">
			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				'fieldConfig' => [
					'template' => "{label}\n<div class=\"inp\">{input}</div>\n<div class=\"col-lg-2 center\">{error}</div>", 
					'labelOptions' => ['class' => 'col-lg-2 control-label'],
				]
			]); ?>
		
			<?= $form->field($model, 'email')->label(false)->textInput(['placeholder'=>'请输入电子邮箱地址']) ?>
		
			<div class="msgs send_email_checkcode">发送邮箱验证码</div>
			
			<?= $form->field($model, 'checkcode')->label(false)->textInput(['placeholder'=>'请输入邮箱验证码']) ?>
			
			<?= $form->field($model, 'username')->label(false)->textInput(['placeholder'=>'请输入用户名']) ?>
			
			<?= $form->field($model, 'nickname')->label(false)->textInput(['placeholder'=>'请输入昵称']) ?>
		
			<?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder'=>'请输入密码']) ?>
		
		<div class="form-group">
			<?= Html::submitButton('注册', ['class' => 'login', 'name' => 'login-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
		
		<div class="signup-bottom">
			<span class="bottom-left"><a href="<?=Url::to(['user/login'])?>">立即登录</a></span>
			<span class="bottom-right"><a href="<?=Url::to(['user/registration-agreement'])?>">注册协议</a></span>
		</div>
	</div>
</div>
<script>
//邮件注册发送验证码
$(".send_email_checkcode").click(function(){
	var str = $(".send_email_checkcode").html();
	if(str=="发送邮箱验证码" || str=="重新获取"){
		var email = $("#emailsignupform-email").val();
		if(!email){
			layer.msg("邮箱地址不能为空");
			return false;
		}
		var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
		if(!reg.test(email)){
			layer.msg("请输入正确的电子邮箱");
			return false;
		}
		//加载层
		layer.load(1);

		$.ajax({
			type: "POST",
			url: "<?=Url::to(['user/send-email-code'])?>",
			data: {email:email},
			success: function(data){
				if(data.code == "2001"){
					layer.msg("发送邮件验证码成功，请登录邮箱获取验证码");
					rematime("send_email_checkcode");
				}else{
					layer.msg(data.message);
				}
			},
			complete:function(){
				layer.closeAll('loading');
			},
			dataType: "json"
		});
	}
 });
 
//倒计时
 function rematime(send_email_checkcode){
    var validCode=true;
    var time=60;
    var code=$("."+send_email_checkcode+"");
    if (validCode) {
        validCode=false;
        code.addClass("msgs_after");
        var t=setInterval(function  () {
            time--;
            code.html(time+"秒");
            if (time==0) {
                clearInterval(t);
                code.html("重新获取");
                validCode=true;
                code.removeClass("msgs_after");
            }
        },1000);
    }
}
</script>
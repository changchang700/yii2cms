<?php
use yii\helpers\Url;
if(!\yii::$app->request->isPost){
	//暂时这样解决吧
	echo '<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>';
}
?>
<?php
$this->title = '忘记密码';
?>
<div class="form-box form">
	<div class="form-signup landing-left">邮箱找回密码</div>
	<div class="form-signup landing-right">短信找回密码</div>
	<div class="fix"></div>
	<div class="content-left">
		<form action="<?=Url::to(['user/request-rassword-reset'])?>" method="post">
			<div class="photo">
				<img src="https://resources.alilinet.com/upload/file/2017/0609/caec0ef6f07036203d555810fd81c75a.jpg" />
			</div>
			<div class="inp">
				<input id="email" type="text" placeholder="请输入注册账号的邮箱地址" />
			</div>
			<div class="msgs send-emali">发送邮箱地址</div>
			<div class="signup-bottom">
				<span class="bottom-left"><a href="<?=Url::to(['user/login'])?>">立即登录</a></span>
				<span class="bottom-right"><a href="<?=Url::to(['user/registration-agreement'])?>">注册协议</a></span>
			</div>
		</form>
	</div>
	<div class="content-right">
		<form action="<?=Url::to(['user/request-rassword-reset'])?>" method="post">
			<div class="photo">
				<img src="https://resources.alilinet.com/upload/file/2017/0609/caec0ef6f07036203d555810fd81c75a.jpg" />
			</div>
			<div class="inp">
				<input id="mobile" type="text" placeholder="请输入注册账号的手机号码" />
			</div>
			<div class="msgs send-sms">发送短信地址</div>
			<div class="signup-bottom">
				<span class="bottom-left"><a href="<?=Url::to(['user/login'])?>">立即登录</a></span>
				<span class="bottom-right"><a href="<?=Url::to(['user/registration-agreement'])?>">网站协议</a></span>
			</div>
		</form>
	</div>
</div>
<script>
//绑定登陆事件
$(".landing-left").addClass("border-btn");
$(".landing-right").click(function() {
	$(this).addClass("border-btn");
	$(".landing-left").removeClass("border-btn");
	$(".content-left").hide(500);
	$(".content-right").show(500);

});
$(".landing-left").click(function() {
	$(this).addClass("border-btn");
	$(".landing-right").removeClass("border-btn");
	$(".content-left").show(500);
	$(".content-right").hide(500);
});

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

$(".send-emali").click(function(){
	var str = $(".send-emali").html();
	if(str == '发送邮箱地址' || str == '重新获取'){
		var email = $('#email').val();
		//加载层
		layer.load(1);
		$.ajax({
			type: "POST",
			url: "<?=Url::to(['user/send-code'])?>",
			data: {type:"email",email:email},
			success: function(data){
				if(data.code == "2001"){
					layer.msg(data.message);
					rematime("send-emali");
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
$(".send-sms").click(function(){
	var str = $(".send-sms").html();
	if(str == '发送短信地址' || str == '重新获取'){
		var mobile = $('#mobile').val();
		//加载层
		layer.load(1);
		$.ajax({
			type: "POST",
			url: "<?=Url::to(['user/send-code'])?>",
			data: {type:"mobile",mobile:mobile},
			success: function(data){
				if(data.code == "2001"){
					layer.msg(data.message);
					rematime("send-sms");
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
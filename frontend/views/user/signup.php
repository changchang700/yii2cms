<?php
use yii\helpers\Url;
?>
<?php
$this->title = '用户注册';
?>
<div class="form-box form">
	<div class="form-login">用户注册</div>
	<div class="content-left signup-ajax-bind">
		<div class="msgs"><a href="<?=Url::to(['user/email-signup'])?>">邮箱注册</a></div>
		<div class="msgs"><a href="<?=Url::to(['user/mobile-signup'])?>">手机注册</a></div>
	</div>
</div>
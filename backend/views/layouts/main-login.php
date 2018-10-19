<?php
use backend\assets\LayuiAsset;
use yii\helpers\Html;

LayuiAsset::register($this);
LayuiAsset::addScript($this, "@web/resources/js/login.js");
LayuiAsset::addCss($this, "@web/resources/css/login.css");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登录--后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<?= Html::csrfMetaTags() ?>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="login_background" style="background: url(<?=Yii::getAlias("@web/resources/images/login.jpg")?>) no-repeat center center;"></div>
	<div class="login">
		<?= $content ?>
	</div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
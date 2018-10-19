<?php
use yii\helpers\Html;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="favicon.ico">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body class="<?php if(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index'){echo "mainBody";}else{echo "childrenBody";}?>">
	<?php $this->beginBody() ?>
	<?= $content ?>
	<!-- 移动导航 -->
<?php
	if(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index'){?>
		<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
		<div class="site-mobile-shade"></div>
<?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php
use yii\helpers\Html;
use backend\assets\LayuiAsset;
use backend\assets\AppAsset;

//只需要在首页的时候加载资源，其他方法不需要加载，因为他们自带加载资源，不然会多次加载资源
if(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index'){
	LayuiAsset::register($this);
	LayuiAsset::addScript($this, "@web/js/index.js");
}else{
	//加载bootstrp资源，后期统一资源后只加载一个资源
	AppAsset::register($this);
}
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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="favicon.ico">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body class="<?php if(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index'){echo "main_body";}else{echo "childrenBody";}?>">
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
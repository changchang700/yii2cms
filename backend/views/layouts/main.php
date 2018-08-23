<?php
use backend\assets\AppAsset;
use backend\assets\LayuiAsset;

$action_list = [
	'login',
	'request-password-reset',
	'reset-password'
];

if (in_array(Yii::$app->controller->action->id, $action_list)) { 
    echo $this->render(
        'main-login',
        ['content' => $content]
	);
}else{
	$bootstrp_list = [
		'site',
		'index'
	];
	//只需要在首页的时候加载资源，其他方法不需要加载，因为他们自带加载资源，不然会多次加载资源
	if(in_array(Yii::$app->controller->id, $bootstrp_list)){
		LayuiAsset::register($this);
		LayuiAsset::addScript($this, "@web/js/index.js");
	}else{
		//加载bootstrp资源，后期统一资源后只加载一个资源
		AppAsset::register($this);
	}
	echo $this->render(
        'main-index',
        ['content' => $content]
	);
}
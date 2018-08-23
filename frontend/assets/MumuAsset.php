<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MumuAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/reset.css',
		'css/style.css',
		'css/wangEditor.min.css',
    ];
    public $js = [
		'js/jquery-1.10.2.min.js',
		'js/jquery.cookie.min.js',
		'js/index.js?v=1.02',
		'js/web_socket.js',
		'js/jquery.jplayer.min.js',
		'js/jquery.mousewheel.js',
		'js/responsive.js',
		'js/audio_player.js',
		'js/comment.js',
		'js/bg.js',
		'js/gallery.js',
		'layer/layer.js',
		'js/site-ajax.js?v=1.02',
		
    ];
    public $depends = [
		
    ]; 
}

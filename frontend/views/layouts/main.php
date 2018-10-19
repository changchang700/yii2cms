<?php
use frontend\assets\MumuAsset;
use yii\helpers\Html;
use common\models\Config;
use yii\helpers\Url;
MumuAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= Html::encode($this->title) ?>-木木博客-有暖风在心中，何必畏惧过寒冬。</title>
        <meta charset="UTF-8" />
        <meta name="keywords" content="木木博客,PHP资源网,<?= Html::encode($this->title) ?>,网页注入,网站XSS,社工库 Oday,安全信息,安全防护" />
        <meta name="description" content="木木博客,<?= Html::encode($this->title) ?>" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
		<link rel="shortcut icon" type="images/x-icon" href="/images/favicon.ico" />
		<?= Html::csrfMetaTags() ?>
		<?php $this->head() ?>
    </head>
    <body>
	<?php $this->beginBody() ?>
        <div id="wrapper">
            <header id="main-header" style="background-image:url(<?=Config::getConfig("WEB_SITE_BACKGROUND")?>);background-position:center center;background-size:cover;">
                <div id="header-wrap">
                    <div id="logo">
                        <div class="logo-img">
                            <img class="avatar" src="/images/header.jpg" title="Li" /></div>
                        <div id="logo-music">
                            <div id="logo-music-name"></div>
                            <div id="logo-music-prev"></div>
                            <div id="logo-music-play"></div>
                            <div id="logo-music-pause"></div>
                            <div id="logo-music-next"></div>
                            <div class="loading">
                                <div class="loading-bar">
                                    <div class="bar1"></div>
                                    <div class="bar2"></div>
                                    <div class="bar3"></div>
                                    <div class="bar4"></div>
                                </div>
                            </div>
                        </div>
                        <div id="logo_jplayer" class="jp-jplayer"></div>
                    </div>
                    <button id="openlist" class="open">
                        <span></span>
                        <span></span>
                        <span></span>playlist
					</button>
                    <button id="openmenu" class="open">
                        <span></span>
                        <span></span>
                        <span></span>menu
					</button>
					<?= frontend\widgets\MenuWidget::widget(['is_mobile'=>false])?>
                    <form role="search" method="get" id="search-form" action="<?= Url::to(['site/index'])?>">
                        <div>
                            <input value="Search" name="s" id="s" onblur="if ( this.value == '' ){this.value='Search';}" onfocus="if ( this.value == 'Search' ){this.value = '';}" type="text" /></div>
                    </form>
                    <div class="clear"></div>
                </div>
            </header>
            <!--header end-->
            <!--content begin-->
            <div id="main" class="main-narrow">
				<?=$content?>
            </div>
            <!--content end-->
            <!--footer begin-->
            <footer id="main-footer">
				<div id="full-footer-widget">
					<?= frontend\widgets\LinkWidget::widget()?>
				</div>
                <div id="footer-copy">
					<div id="online_box">
						当前<b>1365</b>人在线，共打开<b>1536</b>个页面
					</div>
                    <div>
						&copy;2016-2017&nbsp;&nbsp;Aili&nbsp;&nbsp;|&nbsp;&nbsp; 湘ICP备16011802号-1&nbsp;&nbsp;|&nbsp;&nbsp;Powered By
						<a href="" target="_blank">木木博客-有暖风在心中，何必畏惧过寒冬。</a>
					</div>
                </div>
                <div class="clear"></div>
            </footer>
            <!--footer--></div>
        <div class="hide" id="scrolltop"></div>
        <?= frontend\widgets\MenuWidget::widget(['is_mobile'=>true])?>
        <div id="loading-wrap">
            <div class="loading">
                <div class="loading-bar">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                    <div class="bar4"></div>
                </div>
                <div class="loading-text">
					loading
				</div>
			</div>
        </div>
        <!--loading-->
        <div id="jquery_jplayer" class="jp-jplayer"></div>
		<script type="text/javascript">
			var Always = {
				"is_mobile": "0",
				"ajaxurl": "<?= Config::getConfig("WEB_SITE_AJAX_URL")?>",
				"ajax_site_title": "\u6728\u6728\u535a\u5ba2-\u6709\u6696\u98ce\u5728\u5fc3\u4e2d\uff0c\u4f55\u5fc5\u754f\u60e7\u8fc7\u5bd2\u51ac\u3002"
			};
		</script>
    </body>
	<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
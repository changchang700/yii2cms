<?php
namespace frontend\widgets;

use yii;
use yii\base\Widget;
use common\models\ArticleGroup;
use common\models\PhotoGroup;
use yii\helpers\Url;

class MenuWidget extends Widget
{
	public $is_mobile;

	public function run()
    {
		if($this->is_mobile){
			$tpl_id = 'narrow-menu';
			$ul_id = 'menu-always-1';
		}else{
			$tpl_id = 'main-nav';
			$ul_id = 'menu-always';
		}
		
		$article_group = ArticleGroup::find()->asArray()->all();
		$article_group_html = '';
		foreach ($article_group as $value) {
			$article_group_html .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-category">
										<a href="'.Url::to(['site/index',"group_id"=>$value['id']]).'">'.$value['name'].'</a>
									</li>';
		}
		
		$photo_group = PhotoGroup::find()->asArray()->all();
		$photo_group_html = '';
		foreach ($photo_group as $value) {
			$photo_group_html .=	'<li class="menu-item menu-item-type-post_type menu-item-object-page">
										<a href="'.Url::to(['site/photo',"group_id"=>$value['id']]).'">'.$value['name'].'</a>
									</li>';
		}
		
		$login_html = '';
		if(yii::$app->user->isGuest){
			$login_html =  '<a href="#" id="userbox">用户</a>
							<ul class="sub-menu">
								<li class="menu-item menu-item-type-post_type menu-item-object-page">
									<a class="user_login" href="'.Url::to(['user/login']).'">登录</a>
									<a class="user_signup" href="'.Url::to(['user/signup']).'">注册</a>
								</li>
							</ul>';
		}else{
			//退出a连接必须写类，否则会出现错误。
			$login_html =  '<a href="#" id="userbox">'.Yii::$app->user->identity->nickname.'</a>
							<ul class="sub-menu">
								<li class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="'.Url::to(['user/center']).'">个人中心</a>
									<a class="logout" href="'.Url::to(['user/logout']).'">退出</a>
								</li>
							</ul>';
		}
		return '<nav id="'.$tpl_id.'">
					<div class="menu-always-container">
						<ul id="'.$ul_id.'" class="nav-menu">
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="'.Url::to(['site/index']).'">首页</a>
							</li>
							<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
								<a href="#">分类</a>
								<ul class="sub-menu">
									'.$article_group_html.'
								</ul>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="'.Url::to(['site/link']).'">邻居</a>
							</li>
							<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
								<a href="#">相册</a>
								<ul class="sub-menu">
									'.$photo_group_html.'
								</ul>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="'.Url::to(['site/about']).'">关于</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a target="_blank" href="/tool/">工具</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a target="_blank" href="/music/">音乐</a>
							</li>
							<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
								'.$login_html.'
							</li>
						</ul>
					</div>
				</nav>';
    }
}

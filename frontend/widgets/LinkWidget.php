<?php
namespace frontend\widgets;

use yii\base\Widget;
use common\models\Link;

class LinkWidget extends Widget
{

	public function run()
    {
		$link_list = Link::find()->limit(9)->asArray()->all();
		$link_start_tag = '<aside style="display: block;" id="full-footer-readwall" class="foo-widget readwall"><ul>';
		$link_content = '';
		$link_end_tag = '</ul></aside>';
		foreach ($link_list as $value) {
			$link_content .= '<li>
							<a href="'.$value['site_url'].'" target="_blank">
								<img alt="" src="'.$value['site_img'].'" class="avatar avatar-46 photo" width="46" height="46"></a>
							<span class="author" style="display:none"></span>
							<div class="detail">
								<a href="'.$value['site_url'].'" target="_blank" class="author">
									<img alt="" src="'.$value['site_img'].'" srcset="'.$value['site_img'].'" class="avatar avatar-46 photo" width="46" height="46">'.$value['site_name'].'</a>
								<span class="count">总评论数：342</span>
								<a href="'.$value['site_url'].'" class="recent-comment">'.$value['site_motto'].'</a>
								<span>Tracert</span>
								<div class="triangle">
									<div></div>
								</div>
							</div>
						</li>';
		}
		return $link_start_tag . $link_content . $link_end_tag;
    }
}

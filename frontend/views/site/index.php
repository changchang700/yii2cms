<?php
use yii\widgets\ListView;
use yii\helpers\Url;
use common\models\Music;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\searchs\ArticleSearchs */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '首页';
?>
<?= ListView::widget([
	'options' => [
		'id' => 'content',
		'class'=>'post-index',
		'style'=>'padding-bottom: 80px;'
	],
	'dataProvider' => $dataProvider,
	'summary'=>'', 
	'emptyText'=>'没有找到您搜索的文章哦！',
	'emptyTextOptions'=> ['class'=>'form-box form no-result'],
    'pager' => [
        'firstPageLabel' => '<<',
        'lastPageLabel' => '>>',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'maxButtonCount' => 3,
        
        // Customzing options for pager container tag
        'options' => [
            'class' => 'page-navi page-navi-item',
            'id' => 'pager-container',
        ],
        
        // Customzing CSS class for pager link
        'linkOptions' => ['class' => 'mylink'],
        'activePageCssClass' => 'page-navi-active',
        'disabledPageCssClass' => 'page-navi-disable',
        
        // Customzing CSS class for navigating link
        'prevPageCssClass' => 'mypre',
        'nextPageCssClass' => 'mynext',
        'firstPageCssClass' => 'myfirst',
        'lastPageCssClass' => 'mylast',
    ],
	'itemOptions' => ['class' => 'item'],
	'itemView' => function ($model, $key, $index, $widget) {
		return '<article id="" class="post type-post status-publish format-standard hentry category-yufan">
					<div class="article-wrap">
						<header class="entry-header">
							<h1><a class="post-title" href="'.Url::to(['view','id'=>$model->id]).'" rel="bookmark" title="'.$model->title.'">'.$model->title.'</a><span class="meta-time">'.date("m月d日",$model->created_at).'</span></h1>
						</header>
						<div class="entry-content">
							<p><a href="'.Url::to(['view','id'=>$model->id]).'" class="post-feature" title="'.$model->title.'" style="background-image:url('.$model->first_img.');"></a></p>
								<div id="jp_container" class="jp-audio">
									<span rel="'.Music::findOne(['id'=>$model->music_id])->music_url.'" class="play-switch play" title="play"></span>
									<span  class="play-switch stop" title="stop"></span>
									<span rel="0" class="auto"></span>
									<div class="length-bar">
									<div class="seek-bar">
									<div class="play-bar"></div>
									</div>
									</div>
									<span class="current-time">00:00</span>
								</div>
						</div>
					</div>
				</article>';
	},
]) ?>
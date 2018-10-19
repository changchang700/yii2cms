<?php
use common\models\Music;
use yii\helpers\Url;
?>
<?php
$this->title = $model->title;
?>
<div id="main" class="main-narrow">
    <div id="content" class="post-single">
        <div id="singular-content">
            <article id="post-<?= $model->id?>">
                <header class="entry-header">
                    <h1><?= $model->title?></h1>
                </header>
                <div class="entry-content">
                    <p class="center"><a href="<?= $model->first_img?>"><img src="<?= $model->first_img?>"></a></p>
                    <div id="jp_container" class="jp-audio">
                        <span rel="<?=Music::findOne(['id'=>$model->music_id])->music_url?>" class="play-switch play" title="play"></span>
                        <span style="display: none;" class="play-switch stop" title="stop"></span>
                        <span rel=" 0 " class="auto"></span>
                    <div class="length-bar">
                        <div class="seek-bar">
                            <div class="play-bar"></div>
                        </div>
                    </div>
                    <span class="current-time">00:00</span>
                    </div>
                    <?= $model->content?>
                </div>
                <footer class="entry-footer">
                    <div class="meta-author">文 / Admin</div>
                    <div class="share">
                        <ul style="display: none;" class="share-ul">
                            <li><a href="http://twitter.com/share?url=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&text=<?=$model->title?>" target="_blank" rel="nofollow" class="twitter-share" title="Twitter"></a></li>
                            <li><a href="http://facebook.com/share.php?u=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&t=<?=$model->title?>" target="_blank" rel="nofollow" class="facebook-share" title="facebook"></a></li>
                            <li><a href="http://v.t.sina.com.cn/share/share.php?url=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&title=<?=$model->title?>" target="_blank" rel="nofollow" class="sina-share" title="新浪微博"></a></li>
                            <li><a href="http://v.t.qq.com/share/share.php?title=<?=$model->title?>&url=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&site=" target="_blank" rel="nofollow" class="tencent-share" title="腾讯微博"></a></li>
                            <li><a href="http://www.douban.com/recommend/?url=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&title=<?=$model->title?>" target="_blank" rel="nofollow" class="douban-share" title="豆瓣网"></a></li>
                            <li><a href="http://fanfou.com/sharer?u=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&t=<?=$model->title?>" target="_blank" rel="nofollow" class="fanfou-share" title="饭否网"></a></li>
                            <li><a href="http://share.renren.com/share/buttonshare?link=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&title=<?=$model->title?>" target="_blank" rel="nofollow" class="renren-share" title="人人网"></a></li>
                            <li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?= Yii::$app->request->getHostInfo() . Url::to(['view','id'=>$model->id])?>&title=<?=$model->title?>" target="_blank" rel="nofollow" class="qzone-share" title="QQ空间"></a></li>
                        </ul>
                        <span class="share-c">分享到</span>
                    </div>
                </footer>
                <div class="clear"></div>
            </article>
            
            <div id="comments">
                <div class="comment-title">
                    <span>评论</span>
                </div>
                <ol class="comment-list">
					<?= frontend\widgets\CommentWidget::widget(['article_id'=>$model->id])?>
                </ol>
                <div class="comment-navi">
                </div>
                <!--comentlist-->
                <div class="comment-title">
                    <span>金玉良言</span>
                </div>
                <div id="respond">
                    <form action="" method="post" id="commentform">
                        <div>
                            <span class="cancel_comment_reply">
                                <a rel="nofollow" id="cancel-comment-reply-link" href="" style="display:none;">取消回复</a>
                            </span>
                        </div>
                        <div class="comment-textarea">
                            <textarea name="content" id="comment" tabindex="4" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false;};"></textarea>
                        </div>
                        <div>
                            <button name="submit" id="submit" tabindex="5" type="submit">发布</button>
                            <div style="display: none;" id="loading">Sending...</div>
                            <div style="display: none;" id="error">#</div>
                            <input name="article_id" value="<?= $model->id?>" id="comment_post_ID" type="hidden">
                            <input name="comment_parent_id" value="0" id="comment_parent_id" type="hidden">
							<input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
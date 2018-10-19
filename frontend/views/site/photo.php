<?php
$this->title = '相册';
?>
<div id="content" class="post-single">
    <div id="singular-content">
        <article>
            <div class="entry-content">
                <div class="album">
                    <div class="thumb-wrap">
                        <span class="thumb-left">
                        </span>
                        <div class="thumb">
                            <p>
                                <?php foreach ($model as $value) {?>
                                <a href="<?=$value['src']?>" class="has-img-a">
                                    <img title="<?=$value['notice']?>" src="<?=$value['src']?>" alt="<?=$value['notice']?>" class="thumb-current">
                                </a>
                                <?php }?>
                            </p>
                        </div>
                        <span class="thumb-right">
                        </span>
                    </div>
                </div>
            </div>
            <div class="clear">
            </div>
        </article>
        <div id="comments">
        </div>
    </div>
</div>
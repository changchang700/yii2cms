<?php
$this->title = '友情链接';
?>
<div id="main" class="main-narrow" style="opacity: 1;">			
    <div id="content" class="post-single">
        <div id="singular-content">
            <article>
                <header class="entry-header">
                    <h1>邻居</h1>
                </header>
                <div class="entry-content">
                    <ul class="links">
                        <?php foreach ($model as $value){?>
                        <li><a href="<?=$value['site_url']?>" target="_blank"><?=$value['site_name']?></a><span><?=$value['site_content']?></span></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="clear"></div>					
            </article>		
            <div id="comments">
            </div>										
        </div>
    </div>
</div>
<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this); 
LayuiAsset::addScript($this,"@web/js/socket.js");
$this->registerJs($this->render('js/online-users.js'));
?>
<div class="article-index layui-form news_list">
    <div id="grid" class="grid-view" style="overflow:auto"><div class="summary">共<b id="summary">*</b>条数据.</div>
<table class="layui-table"><thead>
<tr><th width="6%" style="text-align: center;">UID</th><th width="8%" style="text-align: center;">打开页面数量</th><th width="8%" style="text-align: center;">客户端IP</th><th width="8%" style="text-align: center;">客户端端口</th><th style="text-align: center;">网关地址</th><th width="10%" style="text-align: center;">网关端口</th><th width="6%" style="text-align: center;">连接ID</th><th width="10%" style="text-align: center;">操作</th></tr>
</thead>
<tbody class="userinfo_list">

</tbody></table>
</div></div>
	<div class="layui-layout layui-layout-admin">
		<!-- 顶部 -->
		<?= $this->render('header.php') ?>
		<!-- 左侧导航 -->
		<?= $this->render('nav.php') ?>
		<!-- 右侧内容 -->
		<?= $this->render('content.php',['data'=>$data]) ?>
		<!-- 底部 -->
		<?= $this->render('footer.php') ?>
	</div>
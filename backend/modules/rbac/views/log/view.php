<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="user-view">
	<?=
	DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'route',
			'url',
			'user_agent',
			'gets:ntext',
			'posts:ntext',
			'admin_email',
			'updated_at',
			'created_at',
		],
		'template' => '<tr><th width="90px;">{label}</th><td>{value}</td></tr>', 
	]);
	?>
</div>
<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="menu-view">
    <?=DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
        'attributes' => [
            'menuParent.name:text:Parent',
            'name',
            'route',
            'order',
        ],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
    ])
    ?>
</div>

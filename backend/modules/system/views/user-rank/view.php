<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="user-rank-view">
    <?= DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'name',
            'score',
            'discount',
            'status',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="auth-item-view">
    <?php
    echo DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
        'attributes' => [
            'name',
            'className',
        ],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
    ]);
    ?>
</div>

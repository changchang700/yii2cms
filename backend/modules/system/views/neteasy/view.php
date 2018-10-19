<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="neteasy-view">
    <?= DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'username',
            'password',
            'notice_1',
            'notice_2',
			[
				'attribute'=>'created_at',
				"value"=>function($data){
                    return date("Y-m-d H:i:s",$data->created_at);
                }
			],
            [
				'attribute'=>'updated_at',
				"value"=>function($data){
                    return date("Y-m-d H:i:s",$data->created_at);
                }
			]
        ],
    ]) ?>

</div>

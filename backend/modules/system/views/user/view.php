<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use common\models\UserRank;
LayuiAsset::register($this);
?>
<div class="user-view">
    <?= DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'username',
			'nickname',
            [
                "attribute"=>"head_pic",
                "format"=>[
                    "image",
                    [
                        "width"=>"100px",
                        "height"=>"100px",
						"class" => "layui-circle"
                    ],
                ],
            ],
            'email:email',
			'mobile',
            [
				'attribute' => 'status',
				'value' => function($model){
					return $model->status == 0 ? '禁用' : '启用';
				}
			],
			[
				'attribute' => 'r_id',
				'value' => function($model){
					return UserRank::findOne($model->r_id)->name;
				}
			],
            [
                "attribute"=>"created_at",
                "value"=>function($data){
                    return date("Y-m-d H:i:s",$data->created_at);
                }
            ],
            [
                "attribute"=>"updated_at",
                "value"=>function($data){
                    return isset($data->updated_at)?date("Y-m-d H:i:s",$data->updated_at):"";
                }
            ],
        ],
		'template' => '<tr><th width="90px;">{label}</th><td>{value}</td></tr>', 
    ]) ?>

</div>

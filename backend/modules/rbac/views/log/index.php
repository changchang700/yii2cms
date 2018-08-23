<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\assets\LayuiAsset;
/* @var $this yii\web\View */
/* @var $searchModel rbac\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

LayuiAsset::register($this); 
$this->registerJs($this->render('js/index.js'));
?>
<div class="layui-form article-index">
    <?=GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],
		'tableOptions'=> ['class'=>'layui-table'],
		'pager' => [
			'options'=>['class'=>'layuipage pull-right'],
				'prevPageLabel' => '上一页',
				'nextPageLabel' => '下一页',
				'firstPageLabel'=>'首页',
				'lastPageLabel'=>'尾页',
				'maxButtonCount'=>5,
        ],
        'columns' => [
            [
				'class' => 'yii\grid\SerialColumn',
				'contentOptions' => ['style'=> 'text-align: center;'],
				'headerOptions' => [
					'width' => '50px',
					'style'=> 'text-align: center;'
				],
			],
			[
				'attribute' => 'route',
				'headerOptions' => ['width'=>'100','style'=> 'text-align: center;'],
				'contentOptions' => ['style'=> 'text-align: center;']
			],
			[
				'attribute' => 'url',
				'contentOptions' => ['style'=> 'text-align: center;'],
				'headerOptions' => ['width'=>'110','style'=> 'text-align: center;'],
                "format"=>[
                    "image",
                    [
                        "width"=>"30px",
                        "height"=>"30px",
                    ],
                ],
			],
            [
				'attribute' => 'admin.username',
				'contentOptions' => ['style'=> 'text-align: center;'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				],
			],
            [
				'attribute' => 'admin_email',
				'format' => 'email',
				'contentOptions' => ['style'=> 'text-align: center;'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				],
			],
            [
                'attribute' => 'ip',
				'contentOptions' => ['class'=>'text-center'],
                'value' => function($model){
                    return date("Y-m-d H:i:s",$model->created_at);
                },
				'headerOptions' => [
					'style'=> 'text-align: center;'
				],
            ],
            [
				'header' => '操作',
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				],
				'template' =>'{view}',
				'buttons' => [
                    'view' => function ($url, $model, $key){
						return Html::a('查看', $url, ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    },
				]
			],
            ],
        ]);
        ?>
</div>

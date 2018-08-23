<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this); 
$this->registerJs($this->render('js/index.js'));

$columns = [
    [
		'class' => 'yii\grid\SerialColumn',
		'contentOptions' => ['style'=> 'text-align: center;'],
		'headerOptions' => [
			'width' => '5%',
			'style'=> 'text-align: center;'
		]
	],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] =[
				'header' => '操作',
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'headerOptions' => [
					'width' => '5%',
					'style'=> 'text-align: center;'
				],
				'template' =>'{view}',
				'buttons' => [
                    'view' => function ($url){
						return Html::a('分配权限', $url, ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    },
				]
			];
?>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="layui-form assignment-index">
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
        'columns' => $columns,
    ]);
    ?>
</div>

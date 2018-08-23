<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
use yii\grid\GridView;
use common\models\UserRank;
LayuiAsset::register($this); 
$this->registerJs($this->render('js/index.js'));
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="user-index layui-form news_list">
    <?= GridView::widget([
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
				'class' => 'backend\widgets\CheckboxColumn',
				'checkboxOptions' => ['lay-skin'=>'primary','lay-filter'=>'choose'],
				'headerOptions' => ['width'=>'50','style'=> 'text-align: center;'],
				'contentOptions' => ['style'=> 'text-align: center;']
			],
			[
				'attribute' => 'nickname',
				'headerOptions' => ['width'=>'100','style'=> 'text-align: center;'],
				'contentOptions' => ['style'=> 'text-align: center;']
			],
			[
				'attribute' => 'head_pic',
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
            'username',
            'email:email',
			[
				'attribute' => 'mobile',
			],
			[
				'attribute' => 'r_id',
				'value' => function($model){
					return UserRank::findOne($model->r_id)->name;
				}
			],
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date("Y-m-d H:i:s",$model->created_at);
                },
				'headerOptions' => [
					'width' => '10%'
				]
            ],
			'created_ip',
			'created_address',
//            [
//                'attribute' => 'last_login_date',
//                'value' => function($model){
//                    return date("Y-m-d H:i:s",$model->last_login_date);
//                },
//				'headerOptions' => [
//					'width' => '8%'
//				]
//            ],
//			'last_login_ip',
//			'last_login_address',
            [
                'attribute' => 'status',
				'format' => 'html',
                'value' => function($model) {
                    return $model->status == 0 ? '<font color="red">禁用</font>' : '<font color="green">启用</font>';
                },
				'contentOptions' => ['style'=> 'text-align: center;'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				]
            ],
//            [
//                'attribute' => 'updated_at',
//                'value' => function($model){
//                    return date("Y-m-d H:i:s",$model->updated_at);
//                },
//				'headerOptions' => [
//					'width' => '10%'
//				]
//            ],

            [
				'header' => '操作',
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				],
				'template' =>'{view} {update} {activate} {delete}',
				'buttons' => [
                    'view' => function ($url, $model, $key){
						return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    },
                    'update' => function ($url, $model, $key) {
						return Html::a('修改', Url::to(['update','id'=>$model->id]), ['class' => "layui-btn layui-btn-normal layui-btn-xs layui-default-update"]);
                    },
                    'activate' => function ($url, $model, $key) {
						if($model->status==0){
							return Html::a('启用', Url::to(['active','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-btn-normal layui-default-active"]);
						}else{
							return Html::a('禁用', Url::to(['inactive','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-btn-warm layui-default-inactive"]);
						}
                    },
					'delete' => function ($url, $model, $key) {
						return Html::a('删除', Url::to(['delete','id'=>$model->id]), ['class' => "layui-btn layui-btn-danger layui-btn-xs layui-default-delete"]);
					}
				]
			],
        ],
    ]); ?>
</div>

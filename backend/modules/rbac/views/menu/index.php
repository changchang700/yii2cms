<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\LayuiAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel rbac\models\searchs\Menu */

LayuiAsset::register($this); 
$this->registerJs($this->render('js/index.js'));
?>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="layui-form menu-index">
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
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
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
            [
				'header' => '操作',
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				],
				'template' =>'{view} {update} {delete}',
				'buttons' => [
                    'view' => function ($url, $model, $key){
						return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    },
                    'update' => function ($url, $model, $key) {
						return Html::a('修改', Url::to(['update','id'=>$model->id]), ['class' => "layui-btn layui-btn-normal layui-btn-xs layui-default-update"]);
                    },
					'delete' => function ($url, $model, $key) {
						return Html::a('删除', Url::to(['delete','id'=>$model->id]), ['class' => "layui-btn layui-btn-danger layui-btn-xs layui-default-delete"]);
					}
				]
			],
        ],
    ]);
    ?>
<?php Pjax::end(); ?>

</div>

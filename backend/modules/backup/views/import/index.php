<?php

use yii\grid\GridView;
use yii\helpers\Html;
use backend\assets\LayuiAsset;
LayuiAsset::register($this); 
$this->registerJs($this->render('js/import.js'));
?>
<div class="config-index">
    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
				'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],
				'tableOptions'=> ['class'=>'layui-table'],	
                'columns' => [
                    [
                        'attribute' => 'time',
                        'label' => '备份名称',
                        'value' => function($model) {
                            return date('Ymd-His', $model['time']);
                        }
                    ],
                    [
						'attribute' => 'part',
						'label' => '卷数',
						'headerOptions' => ['width'=>'220','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
					],							
                    [
						'attribute' => 'compress',
						'label' => '压缩方式',
						'headerOptions' => ['width'=>'220','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
					],
                    [
                        'attribute' => 'size',
                        'label' => '数据大小',
						'headerOptions' => ['width'=>'220','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
                        'value' => function($model) {
                            return Yii::$app->formatter->asShortSize($model['size']);
                        }
                    ],
                    [
						'header' => '操作',
						'headerOptions' => ['width'=>'180','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{a} {b}',
                        'buttons' => [
                            'a' => function ($url, $model, $key) {
                                return Html::a('还原',
                                    ['init', 'time' => $model['time']],
                                    ['class' => 'layui-btn layui-btn-xs db-import']
                                );
                            },
                            'b' => function ($url, $model, $key) {
                                return Html::a('删除',
                                    ['del','time' => $model['time']],
                                    [
                                        'data-params' => ['time' => $model['time']],
                                        'class' => 'layui-btn layui-btn-normal layui-btn-xs layui-default-delete'
                                    ]
                                );
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

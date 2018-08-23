<?php

use yii\grid\GridView;
use yii\helpers\Html;
use backend\assets\LayuiAsset;
LayuiAsset::register($this); 

$this->registerJs($this->render('js/export.js'));
?>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
    <p>
        <?= Html::a('立即备份', ['init'], ['class' => 'layui-btn layui-btn-normal', 'id' => 'export']) ?>
    </p>
</blockquote>
<div class="config-index layui-form">
    <?php \yii\widgets\ActiveForm::begin(['id' => 'export-form', 'action' => ['init']])?>
    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'id' => 'grid',
                'dataProvider' => $dataProvider,
				'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],
				'tableOptions'=> ['class'=>'layui-table'],				
                'columns' => [
					[
						'class' => 'backend\widgets\CheckboxColumn',
						'name' => 'tables',
						'checkboxOptions' =>function($model){
							return ['lay-skin'=>'primary','lay-filter'=>'choose','value' => $model['name']];
						},
						'headerOptions' => ['width'=>'50','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;']
					],
                    'name:text:表名',
                    [
						'attribute' => 'process',
						'label' => '备份进度',
						'value' => function(){
							return '未开始备份';
						},
						'headerOptions' => ['width'=>'180','style'=> 'text-align: center;'],
						'contentOptions' => function($model){
							return ['style'=> 'text-align: center;','class'=>'tb_process_'.$model['name']];
						}
					],
                    [
						'attribute' => 'rows',
						'label' => '数据量',
						'headerOptions' => ['width'=>'220','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
					],
                    [
                        'attribute' => 'data_length',
                        'label' => '数据大小',
						'headerOptions' => ['width'=>'220','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
                        'value' => function ($model) {
                            return Yii::$app->formatter->asShortSize($model['data_length']);
                        }
                    ],
                    [
						'attribute' => 'create_time',
						'label' => '备份时间',
						'headerOptions' => ['width'=>'220','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
					],
                    [
						'header' => '操作',
						'headerOptions' => ['width'=>'180','style'=> 'text-align: center;'],
						'contentOptions' => ['style'=> 'text-align: center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{a} {b}',
                        'buttons' => [
                            'a' => function ($url, $model, $key) {
                                return Html::a('优化表',
                                    ['export/optimize', 'tables' => $model['name']],
                                    [
                                        'class' => 'layui-btn layui-btn-xs table_optimize'
                                    ]
                                );
                            },
                            'b' => function ($url, $model, $key) {
                                return Html::a('修复表',
                                    ['export/repair', 'tables' => $model['name']],
                                    [
                                        'class' => 'layui-btn layui-btn-normal layui-btn-xs table_repair'
                                    ]
                                );
                            }
                        ]
                    ],
                ],
            ]); ?>
            <?php \yii\widgets\ActiveForm::end()?>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\searchs\User */
/* @var $form yii\widgets\ActiveForm */
AppAsset::register($this);
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
		'fieldConfig' => [
		   'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
	   ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['class'=>'layui-input search_input']) ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'r_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= Html::button('添加', ['class' => 'layui-btn layui-default-add']) ?>
		<?= Html::button('批量删除', ['class' => 'layui-btn layui-btn-danger gridview layui-default-delete-all']) ?>
    </div>
	<div align='right' class="form-group" >
        <?= Html::a('<i class="iconfont" data-icon="&#xe753;">&#xe753;</i>  <cite>在线用户</cite>' , 'javascript:;', ['data-url'=>Url::to(['/system/user/online-users']),'class' => "layui-btn layui-btn-normal online-users"]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

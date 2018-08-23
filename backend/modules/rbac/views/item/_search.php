<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use common\models\ArticleGroup;
/* @var $this yii\web\View */
/* @var $model common\models\searchs\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
AppAsset::register($this);
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline layui-form'],
		'fieldConfig' => [
		   'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
	   ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['class'=>'layui-input search_input']) ?>
	
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= Html::button('添加', ['class' => 'layui-btn layui-default-add']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

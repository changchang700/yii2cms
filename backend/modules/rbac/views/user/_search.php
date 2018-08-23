<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

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

    <?= $form->field($model, 'email')->textInput(['class'=>'layui-input search_input']) ?>


    <div class="form-group">
        <?= Html::submitButton('查找用户', ['class' => 'layui-btn layui-btn-normal']) ?>
		<?= Html::button('添加用户', ['class' => 'layui-btn layui-default-add']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

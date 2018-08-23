<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model system\models\UserRank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-rank-form create_box">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'score')->textInput()->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'status')->textInput()->textInput(['class'=>'layui-input']) ?>

    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

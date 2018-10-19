<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Neteasy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="neteasy-form create_box">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'notice_1')->textInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'notice_2')->textInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

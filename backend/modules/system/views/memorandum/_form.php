<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Memorandum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memorandum-form create_box">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->textInput(['class'=>'layui-input']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 20,'class'=>'layui-textarea']) ?>

    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

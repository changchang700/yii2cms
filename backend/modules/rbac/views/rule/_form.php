<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this  yii\web\View */
/* @var $model rbac\models\BizRule */
/* @var $form ActiveForm */
?>

<div class="auth-item-form create_box">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>

    <?= $form->field($model, 'className')->textInput(['class'=>'layui-input']) ?>

    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

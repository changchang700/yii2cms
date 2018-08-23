<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rbac\components\RouteRule;
use rbac\AutocompleteAsset;
use yii\helpers\Json;
use rbac\components\Configs;

/* @var $this yii\web\View */
/* @var $model rbac\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(['id' => 'item-form']); ?>
     
	<?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 2,'class'=>'layui-textarea']) ?>

	<?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name','class'=>'layui-input']) ?>

	<?= $form->field($model, 'data')->textarea(['rows' => 6,'class'=>'layui-textarea']) ?>			
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal','name' => 'submit-button'])?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

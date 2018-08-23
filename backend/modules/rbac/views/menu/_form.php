<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rbac\models\Menu;
use yii\helpers\Json;
use rbac\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model rbac\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
        'menus' => Menu::getMenuSource(),
        'routes' => Menu::getSavedRoutes(),
    ]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('js/_script.js'));
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
	
	<?= $form->field($model, 'name')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>

	<?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name','class'=>'layui-input']) ?>

	<?= $form->field($model, 'route')->textInput(['id' => 'route','class'=>'layui-input']) ?>
	
	<?= $form->field($model, 'order')->input('number',['class'=>'layui-input']) ?>

	<?= $form->field($model, 'data')->textarea(['rows' => 4,'class'=>'layui-textarea']) ?>

    <div align='right'>
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

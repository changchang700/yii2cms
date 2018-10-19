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

	<div class="layui-input-inline" style='width:240px'>
		<label class="control-label" for="menu-order">图标</label>
		<input placeholder="请输入或选择图标" id="icon" type="text" name="Menu[icon]" value='<?=$model->icon?>' class="layui-input">
	</div>
	<?php echo \yii\helpers\Html::button('打开图标',['class'=>'layui-btn open-icon','style'=>'margin-top: 25px;']);?>
	
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

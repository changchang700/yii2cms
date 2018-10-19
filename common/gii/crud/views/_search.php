<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
AppAsset::register($this);
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
		'fieldConfig' => [
		   'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
	   ],
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . "->textInput(['class'=>'layui-input']) ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
	<?php echo '<?php //$form->field($model, "status")->dropDownList([""=>"全部","0"=>"待审核","1"=>"审核通过"],["class"=>"layui-input"]) ?>' . "\n\n"?>
	<div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('查找') ?>, ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= "<?= " ?>Html::button(<?= $generator->generateString('添加') ?>, ['class' => 'layui-btn layui-default-add']) ?>
		<?= "<?= " ?>Html::button(<?= $generator->generateString('批量删除') ?>, ['class' => 'layui-btn layui-btn-danger gridview layui-default-delete-all']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

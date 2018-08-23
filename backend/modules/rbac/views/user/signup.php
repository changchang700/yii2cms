<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);

$this->registerJs($this->render('js/upload.js'));
?>
<div class="site-signup create_box">
	<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
		<?= $form->field($model, 'username')->textInput(['class'=>'layui-input search_input']) ?>
		<?= $form->field($model, 'nickname')->textInput(['class'=>'layui-input search_input']) ?>
		<?= $form->field($model, 'head_pic',['template' => '{label} <div class="row"><div class="col-sm-12">{input}<button type="button" class="layui-btn upload_button" id="test3"><i class="layui-icon"></i>上传文件</button>{error}{hint}</div></div>'])->textInput(['maxlength' => true,'class'=>'layui-input upload_input']) ?>
		<?= $form->field($model, 'email')->textInput(['class'=>'layui-input search_input']) ?>
		<?= $form->field($model, 'password')->passwordInput(['class'=>'layui-input search_input']) ?>
		<div align='right'>
			<?= Html::submitButton(Yii::t('rbac-admin', 'Signup'), ['class' => 'layui-btn', 'name' => 'signup-button']) ?>
		</div>
	<?php ActiveForm::end(); ?>
</div>

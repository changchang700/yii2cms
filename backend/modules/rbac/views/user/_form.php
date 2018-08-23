<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use system\models\UserRank;

$this->registerJs($this->render('js/upload.js'));
?>

<div class="user-form create_box">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
	
    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'class'=>'layui-input','readonly'=>true]) ?>
	
	<?= $form->field($model, 'nickname')->textInput(['maxlength' => true,'class'=>'layui-input']) ?>
	
	<?= $form->field($model, 'head_pic',['template' => '{label} <div class="row"><div class="col-sm-12">{input}<button type="button" class="layui-btn upload_button" id="test3"><i class="layui-icon"></i>上传文件</button>{error}{hint}</div></div>'])->textInput(['maxlength' => true,'class'=>'layui-input upload_input']) ?>
	
	<?= Html::img(@$model->head_pic, ['width'=>'50','height'=>'50','class'=>'layui-circle userinfo_head_pic'])?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'class'=>'layui-input']) ?>
	
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'value'=>'','class'=>'layui-input search_input']) ?>
	
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


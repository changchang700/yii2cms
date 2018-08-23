<?php

use rbac\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use backend\assets\LayuiAsset;

LayuiAsset::register($this); 
AnimateAsset::register($this);
YiiAsset::register($this);

$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);

$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('js/_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="assignment-index" style="margin-top: 20px;">
    <div class="row" style="margin-right: 2px;margin-left: 2px;">
        <div class="col-sm-5">
            <input class="layui-form-control search" data-target="available" placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
            <select multiple size="35" class="layui-form-control list" data-target="available"></select>
        </div>
        <div class="col-sm-1">
            <br><br>
            <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => (string) $model->id], ['class' => 'layui-btn layui-btn-normal btn-assign','data-target' => 'available','title' => Yii::t('rbac-admin', 'Assign'),]);?>
			<br><br>
            <?=Html::a('&lt;&lt;' . $animateIcon, ['revoke', 'id' => (string) $model->id], ['class' => 'layui-btn layui-btn-danger btn-assign','data-target' => 'assigned','title' => Yii::t('rbac-admin', 'Remove'),]);?>
        </div>
        <div class="col-sm-5">
            <input class="layui-form-control search" data-target="assigned" placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
            <select multiple size="35" class="layui-form-control list" data-target="assigned"></select>
        </div>
    </div>
</div>

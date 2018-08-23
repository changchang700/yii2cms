<?php

use rbac\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
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
<div class="auth-item-view">
    <div class="row" style="margin-right: 2px;margin-left: 15px;">
        <div class="col-sm-11">
            <?=
DetailView::widget([
    'model' => $model,
	'options' => ['class' => 'layui-table'],
    'attributes' => [
        'name',
        'description:ntext',
        'ruleName',
        'data:ntext',
    ],
    'template' => '<tr><th style="width:8%">{label}</th><td>{value}</td></tr>',
]);
?>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;margin-left: 15px;">
        <div class="col-sm-5">
            <input class="layui-form-control search" data-target="available"
                   placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
            <select multiple size="20" class="layui-form-control list" data-target="available"></select>
        </div>
        <div class="col-sm-1">
            <br><br>
            <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => $model->name], [
    'class' => 'btn btn-success btn-assign',
    'data-target' => 'available',
    'title' => Yii::t('rbac-admin', 'Assign'),
]);?><br><br>
            <?=Html::a('&lt;&lt;' . $animateIcon, ['remove', 'id' => $model->name], [
    'class' => 'btn btn-danger btn-assign',
    'data-target' => 'assigned',
    'title' => Yii::t('rbac-admin', 'Remove'),
]);?>
        </div>
        <div class="col-sm-5">
            <input class="layui-form-control search" data-target="assigned"
                   placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
            <select multiple size="20" class="layui-form-control list" data-target="assigned"></select>
        </div>
    </div>
</div>

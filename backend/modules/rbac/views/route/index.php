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
    'routes' => $routes,
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('js/_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<h1><?=Html::encode($this->title);?></h1>
<div class="row" style="margin-right: 2px;margin-left: 2px;">
    <div class="col-sm-11">
        <div class="input-group">
            <input id="inp-route" type="text" class="layui-form-control"
                   placeholder="<?=Yii::t('rbac-admin', 'New route(s)');?>">
            <span class="input-group-btn">
                <?=Html::a(Yii::t('rbac-admin', '添加') . $animateIcon, ['create'], ['class' => 'layui-btn-auth btn-success','id' => 'btn-new',]);?>
            </span>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<div class="row" style="margin-right: 2px;margin-left: 2px;">
    <div class="col-sm-5">
        <div class="input-group">
            <input class="layui-form-control search" data-target="available" placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
            <span class="input-group-btn">
                <?=Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['refresh'], ['class' => 'layui-btn-auth btn-default','id' => 'btn-refresh',]);?>
            </span>
        </div>
        <select multiple size="35" class="layui-form-control list" data-target="available"></select>
    </div>
    <div class="col-sm-1">
        <br><br>
        <?=Html::a('&gt;&gt;' . $animateIcon, ['assign'], ['class' => 'layui-btn layui-btn-normal btn-assign','data-target' => 'available','title' => Yii::t('rbac-admin', 'Assign'),]);?>
		<br><br>
        <?=Html::a('&lt;&lt;' . $animateIcon, ['remove'], ['class' => 'layui-btn layui-btn-danger btn-assign','data-target' => 'assigned','title' => Yii::t('rbac-admin', 'Remove'),]);?>
    </div>
    <div class="col-sm-5">
        <input class="layui-form-control search" data-target="assigned" placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
        <select multiple size="35" class="layui-form-control list" data-target="assigned"></select>
    </div>
</div>

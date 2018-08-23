<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">
    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

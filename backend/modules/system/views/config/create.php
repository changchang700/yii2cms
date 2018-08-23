<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
$this->registerJs($this->render('js/create.js'));
?>
<div class="config-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

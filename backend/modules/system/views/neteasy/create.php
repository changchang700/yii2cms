<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="neteasy-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

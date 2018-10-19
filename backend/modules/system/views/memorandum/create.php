<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="memorandum-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

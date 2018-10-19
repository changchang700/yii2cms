<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="memorandum-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

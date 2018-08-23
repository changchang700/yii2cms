<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="config-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

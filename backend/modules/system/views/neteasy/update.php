<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="neteasy-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

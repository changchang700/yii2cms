<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="auth-item-update">
    <?=$this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>

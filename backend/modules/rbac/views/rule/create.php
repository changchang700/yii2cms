<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="auth-item-create">
    <?=$this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>

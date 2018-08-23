<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="menu-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>

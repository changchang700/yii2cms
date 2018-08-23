<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
?>
<div class="auth-item-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
<script>
var url = '/activity';
var  frameindex= parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
console.log(frameindex);
</script>

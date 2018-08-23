<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user rbac\models\User */

$resetLink = Url::to(['user/reset-password','token'=>$user->password_reset_token], true);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>

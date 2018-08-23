@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../yiisoft/yii2-apidoc/apidoc
php "%BIN_TARGET%" %*

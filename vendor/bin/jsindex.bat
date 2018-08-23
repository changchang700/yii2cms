@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../cebe/js-search/bin/jsindex
php "%BIN_TARGET%" %*

@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../cebe/markdown-latex/bin/markdown-latex
php "%BIN_TARGET%" %*

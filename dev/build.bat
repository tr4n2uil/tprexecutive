@echo off
type init.js services\*.js workflows\*.js helpers\*.js > ..\ui\js\executive-jquery.js
type templates\*.js > ..\ui\js\executive-templates.js
type styles\*.css > ..\ui\css\executive-styles.css
pause

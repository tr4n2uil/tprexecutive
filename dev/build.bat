@echo off
type init.js services\*.js workflows\*.js helpers\*.js > ..\ui\js\executive-jquery.js
type templates\*.js > ..\ui\js\executive-templates.js
type styles\*.css > ..\ui\css\executive-styles.css
type ..\ui\js\jquery-1.6.1.min.js ..\ui\js\jquery.tmpl.min.js ..\ui\js\jquery.cookie.js ..\ui\js\json2.js ..\ui\js\jquery-firespark.js ..\ui\js\executive-jquery.js ..\ui\js\executive-templates.js > ..\ui\js\executive-ui.js
type ..\ui\css\default.css ..\ui\css\jquery.css ..\ui\css\layout.css ..\ui\css\executive-styles.css > ..\ui\css\executive-ui.css
pause

@echo off
type styles\*.css > ..\ui\css\executive-ui.css
type ..\..\services\firespark\jquery\dev\jquery-firespark.js > ..\ui\js\jquery-firespark.js
type ..\..\services\firespark\jquery\dev\jquery-firespark.min.js > ..\ui\js\jquery-firespark.min.js
type init.js helpers\*.js workflows\*.js > ..\ui\js\executive-ui.js
type ..\..\services\cirrusbolt\php\swiftblaze\invoke\interface\console.html > ..\ui\tpl\interface\console.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\post\menu.html > ..\ui\tpl\display\menu.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\post\pagination.html > ..\ui\tpl\display\pagination.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\board\board.html > ..\ui\tpl\display\board.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\post\post.html > ..\ui\tpl\display\post.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\update\update.html > ..\ui\tpl\display\update.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\comment\comment.html > ..\ui\tpl\display\comment.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\storage\file\file.html > ..\ui\tpl\storage\file.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\storage\directory\directory.html > ..\ui\tpl\storage\directory.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\access\permission\permission.html > ..\ui\tpl\access\permission.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\access\identity\identity.html > ..\ui\tpl\access\identity.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\shortlist\stage\stage.html > ..\ui\tpl\shortlist\stage.tpl.html
type ..\core\executive\student\student.html > ..\ui\tpl\executive\student.tpl.html
type ..\core\executive\student\students.html > ..\ui\tpl\executive\students.tpl.html
type ..\core\executive\batch\batch.html > ..\ui\tpl\executive\batch.tpl.html
type ..\core\executive\grade\grade.html > ..\ui\tpl\executive\grade.tpl.html
type ..\core\executive\slot\slot.html > ..\ui\tpl\executive\slot.tpl.html
type ..\core\executive\company\company.html > ..\ui\tpl\executive\company.tpl.html
type ..\core\executive\company\companies.html > ..\ui\tpl\executive\companies.tpl.html
type ..\core\executive\visit\visit.html > ..\ui\tpl\executive\visit.tpl.html
type ..\core\executive\cutoff\cutoff.html > ..\ui\tpl\executive\cutoff.tpl.html
type ..\core\executive\willingness\willinglist.html > ..\ui\tpl\executive\willinglist.tpl.html
type ..\core\executive\willingness\willingness.html > ..\ui\tpl\executive\willingness.tpl.html
type ..\core\executive\selection\selection.html > ..\ui\tpl\executive\selection.tpl.html
type ..\core\manager\contact\contact.html > ..\ui\tpl\manager\contact.tpl.html
pause

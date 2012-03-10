@echo off
type styles\*.css > ..\ui\css\executive-ui.css
type ..\ui\js\jquery-1.6.1.min.js ..\ui\js\jquery.tmpl.min.js ..\ui\js\jquery.cookie.js ..\ui\js\json2.js ..\ui\js\jquery.expander.js ..\..\services\snowblozm\js\Snowblozm.class.js ..\..\services\firespark\jquery\dev\jquery-firespark.js init.js helpers\*.js workflows\*.js > ..\ui\js\executive-ui.js
type ..\..\services\cirrusbolt\php\swiftblaze\invoke\interface\console.html > ..\ui\tpl\interface\console.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\post\menu.html > ..\ui\tpl\display\menu.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\post\pagination.html > ..\ui\tpl\display\pagination.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\board\board.html > ..\ui\tpl\display\board.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\post\post.html > ..\ui\tpl\display\post.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\display\comment\comment.html > ..\ui\tpl\display\comment.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\storage\file\file.html > ..\ui\tpl\storage\file.tpl.html
type ..\..\services\cirrusbolt\php\thundersky\access\permission\permission.html > ..\ui\tpl\access\permission.tpl.html
type ..\core\portal\profile\profile.html > ..\ui\tpl\portal\profile.tpl.html
type ..\core\parikshan\submission\scoreboard.html > ..\ui\tpl\submission\scoreboard.tpl.html
type ..\core\parikshan\submission\feedback.html > ..\ui\tpl\submission\feedback.tpl.html
type ..\core\parikshan\question\question.html > ..\ui\tpl\quiz\question.tpl.html
type ..\core\parikshan\problem\problem.html > ..\ui\tpl\quiz\problem.tpl.html
type ..\core\parikshan\puzzle\puzzle.html > ..\ui\tpl\quiz\puzzle.tpl.html
pause

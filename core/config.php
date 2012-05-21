<?php 
	
	/**
	 *	@config Defaults
	**/
	$YEAR = '2012';
	$TILES_0 = $TILES_1 = $HTML = $STATEMENU = $SHTML = '';
	$TPR = false;
	$PORTAL = '';
	
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = 'krishna';
	
	$CB_DB_NAME = 'cirrusbolt';
	$CBD_DB_NAME = 'cirrusbolt_display';
	$CBQ_DB_NAME = 'cirrusbolt_queue';
	$CBS_DB_NAME = 'cirrusbolt_storage';
	$CBP_DB_NAME = 'tprexecutive';
	$CBSL_DB_NAME = 'cirrusbolt_shortlist';
	$DB_NAME = 'tprexecutive';
	$DB_PERSIST = true;

	$CACHE_ENABLE = true;
	$CACHE_LIFE = 5;
	$CACHE_LEVEL = 0;
	
	$MAIL_HOST = 'smtp.gmail.com';
	$MAIL_USER = 'TPO IT BHU';
	$MAIL_EMAIL = 'web.tpo@itbhu.ac.in';
	$MAIL_PASS = 'w@itbhu';
	
	/**
	 *	@constants System
	**/
	define('COOKIEKEY', 'executive-session');
	define('COOKIEEXPIRY', 15);
	define('ROOTPATH', 'http://'.$_SERVER['SERVER_NAME'].($_SERVER['SERVER_NAME'] == 'tpo.iitbhu.org.in' ? '' : '/tpo'));
	define('CONTEXT', 'EX');
	define('UIBASE', EXROOT. 'ui/');
	define('CACHELITE', 'Cache/Lite.php');
	define('CACHELITEOUTPUT', 'Cache/Lite/Output.php');
	define('PLACEMENT_UPDATES_BOARD', 15);
	define('INTERNSHIP_UPDATES_BOARD', 14);
	define('GENERAL_UPDATES_BOARD', 13);
	define('TPR_UPDATES_BOARD', 19);
	define('PERSON_THUMB', 10);
	define('PEOPLE_ID', 16);
	define('STUDENT_PORTAL_ID', 16);
	define('COMPANY_PORTAL_ID', 17);
	define('MANAGER_ID', 18);
	define('FORM_ID', 32);
	define('FORUM_ID', 33);
	define('FORUM_MAIL_SUBJECT_PREFIX', '[TPO Portal Discussion Alerts]');
	define('FORUM_MAIL_BODY_SIGNATURE', 'TPO Portal Alerts<br />http://itbhu.org.in/tpo/');
	
	date_default_timezone_set('Asia/Kolkata');
	
	/**
	 *	@data Defaults
	**/
	$PAGES = array(
		'info' => 'info',
		'error' => 'error'
	);
	
	$FEEDBACKMAILS = 'vibhaj.rajan.cse08@itbhu.ac.in';
	
?>
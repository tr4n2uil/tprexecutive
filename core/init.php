<?php
	
	/**
	 * 	@initialize TPR Executive
	**/
	require_once(EXROOT. 'core/sb-init.php');
	
	/**
	 * 	@static SnowBlozm
	**/
	Snowblozm::$setmime = 'html';
	
	/**
	 *	@config CacheLite
	**/
	Snowblozm::init('cachelite', array(
		'caching' => $CACHE_ENABLE,
		'cacheDir' => EXROOT.'cache'.DIRECTORY_SEPARATOR,
		'lifeTime' => $CACHE_LIFE,
		'automaticCleaningFactor' => $CACHE_LIFE,
		'hashedDirectoryLevel' => $CACHE_LEVEL,
		'automaticSerialization' => true
	));
	
	/**
	 *	@config Session
	**/
	Snowblozm::init('session', array(
		'key' => COOKIEKEY,
		'expiry' => COOKIEEXPIRY,
		'root' => ROOTPATH,
		'context' => CONTEXT
	));
	
	/**
	 *	@config Dataservices
	**/
	
	Snowblozm::init('cbconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CB_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbqconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBQ_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbsconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBS_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbdconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBD_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbpconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBP_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbslconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBSL_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('exconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	/**
	 *	@config Mail
	**/
	Snowblozm::init('mail', array(
		'type' => 'smtp',
		'host' => $MAIL_HOST,
		'port' => 465,
		'secure' => 'ssl',
		'user' => $MAIL_USER,
		'email' => $MAIL_EMAIL,
		'pass' => $MAIL_PASS,
		'params' => "-f$MAIL_USER <$MAIL_EMAIL>"
	));
	
	/**
	 *	@config reCAPTCHA
	**/
	Snowblozm::init('recaptcha', array(
		'url' => 'http://www.google.com/recaptcha/api/verify',
		'public' => '6LeS880SAAAAAHH2R_CjmQpN61jVlpsI3jRttnoj',
		'private' => '6LeS880SAAAAAAHWd2Msjq9qoDC2T16lFxtQdvHv',
	));
	
	/**
	 *	@config Updates
	**/
	Snowblozm::init('update_mailto', array(
		13 => 'tpr09@itbhu.ac.in',
		14 => 'tpr09@itbhu.ac.in',
		15 => 'tpr09@itbhu.ac.in',
		19 => 'tpr09@itbhu.ac.in'
	));
	
	/**
	 *	@config Form
	**/
	Snowblozm::init('form_mailto', array(
		'response' => 'tpo@itbhu.ac.in, web.tpo@itbhu.ac.in',
		'contact' => 'tpo@itbhu.ac.in, web.tpo@itbhu.ac.in',
		'digest' => 'vibhaj8@gmail.com',
		'digest_intern' => 'vibhaj8@gmail.com'
	));
	
	/**
	 *	@initialize $memory
	**/
	$memory = array(
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'user' => false,
		'context' => CONTEXT,
		'emergency' => $EMERGENCY,
		'access' => array(
			'root' => array(
				'storage', 
				'display',
				'people',
				'executive',
				'manager',
				'access',
				'shortlist'
			),
			'maps' => array(
				'default' => 'invoke.interface.console',
				'session' => 'invoke.interface.session',
				'openid' => 'invoke.interface.openid',
				'register' => 'portal.profile.add',
				'available' => 'people.person.available',
				'send' => 'people.person.send',
				'verify' => 'people.person.verify',
				'reset' => 'people.person.reset',
				'file' => 'storage.file.read',
				'files' => 'storage.file.list',
				'directories' => 'storage.directory.list',
				'permissions' => 'access.permission.list',
				'identities' => 'access.identity.list',
				'tprs' => 'access.permission.list',
				'batch' => 'executive.batch.find',
				'batches' => 'executive.batch.list',
				'profile' => 'executive.student.find',
				'student' => 'executive.student.find',
				'students' => 'executive.student.list',
				'grade' => 'executive.grade.find',
				'grades' => 'executive.grade.list',
				'slots' => 'executive.slot.list',
				'company' => 'executive.company.find',
				'companies' => 'executive.company.list',
				'skills' => 'executive.company.list',
				'visit' => 'executive.visit.info',
				'willinglists' => 'executive.willingness.visit',
				'willingness' => 'executive.willingness.list',
				'filter' => 'executive.student.filter',
				'opportunities' => 'executive.willingness.list',
				'experiences' => 'executive.willingness.list',
				'candidates' => 'executive.willingness.list',
				'calendar' => 'executive.visit.list',
				'workshops' => 'executive.visit.list',
				'contacts' => 'manager.contact.list',
				'update' => 'display.update.info',
				'updates' => 'display.update.list',
				'post' => 'display.post.info',
				'posts' => 'display.post.list',
				'board' => 'display.board.info',
				'boards' => 'display.board.list',
				'comment' => 'display.comment.info',
				'comments' => 'display.comment.list',
				
			)
		),
		'pages' => $PAGES
	);

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class StudentKeyWorkflow
 *	@desc Changes key for student by ID
 *
 *	@param stuid long int Student ID [memory] optional default false
 *	@param keyid long int Usage Key ID [memory]
 *	@param keyvalue string Key value [memory]
 *	@param currentemail string Current Email
 *	@param currentkey string Current key value [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentKeyWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'keyvalue', 'currentkey', 'currentemail'),
			'optional' => array('stuid' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Student Key changed successfully';
		$attr = $memory['stuid'] ? 'stuid' : 'owner';
		$init = $memory['stuid'] ? false : true;
		$memory['stuid'] = $memory['stuid'] ? $memory['stuid'] : $memory['keyid'];
		
		$workflow = array(
		array(
			'service' => 'ad.relation.unique.workflow',
			'args' => array('stuid'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `$attr`=\${stuid}",
			'errormsg' => 'Invalid Student ID'
		),
		array(
			'service' => 'adcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0.owner' => 'owner', 'result.0.stuid' => 'stuid')
		),
		array(
			'service' => 'ad.reference.authorize.workflow',
			'input' => array('id' => 'stuid'),
			'action' => 'edit',
			'init' => $init
		),
		array(
			'service' => 'ad.key.authenticate.workflow',
			'input' => array('email' => 'currentemail', 'key' => 'currentkey')
		),
		array(
			'service' => 'ad.reference.master.workflow',
			'input' => array('id' => 'stuid')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
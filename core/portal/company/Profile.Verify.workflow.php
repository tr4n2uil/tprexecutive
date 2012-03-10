<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileVerifyWorkflow
 *	@desc Changes key for profile by ID
 *
 *	@param username string Person username [memory]
 *	@param verify string Verification code [memory]
 *	@param context string Context [constant as CONTEXT]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileVerifyWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('username', 'verify')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Verified successfully';

		$workflow = array(
		array(
			'service' => 'people.person.verify.workflow'
		),
		array(
			'service' => 'transpera.relation.update.workflow',
			'args' => array('username'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlcnd' => "set `ustatus`='A' where `username`='\${username}'",
			'escparam' => array('username'),
			'check' => false,
			'errormsg' => 'Invalid Username'
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
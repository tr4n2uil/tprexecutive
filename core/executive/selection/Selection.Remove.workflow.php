<?php 
require_once(SBSERVICE);

/**
 *	@class SelectionRemoveWorkflow
 *	@desc Removes selection by ID
 *
 *	@param selid long int Selection ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param shlstid long int Shortlist ID [memory] optional default 0
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class SelectionRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'selid'),
			'optional' => array('shlstid' => 0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$service = array(
			'service' => 'transpera.entity.remove.workflow',
			'input' => array('id' => 'selid', 'parent' => 'shlstid'),
			'conn' => 'exconn',
			'relation' => '`selections`',
			'type' => 'selection',
			'sqlcnd' => "where `selid`=\${id}",
			'errormsg' => 'Invalid Selection ID',
			'successmsg' => 'Selection removed successfully'
		);
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
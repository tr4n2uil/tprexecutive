<?php 
require_once(SBSERVICE);

/**
 *	@class WillinglistRemoveWorkflow
 *	@desc Removes willinglist by ID
 *
 *	@param wgltid long int Willinglist ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillinglistRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'wgltid'),
			'optional' => array('batchid' => 0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$service = array(
			'service' => 'transpera.entity.remove.workflow',
			'input' => array('id' => 'wgltid', 'parent' => 'batchid'),
			'conn' => 'exconn',
			'relation' => '`willinglists`',
			'type' => 'willinglist',
			'sqlcnd' => "where `wgltid`=\${id}",
			'errormsg' => 'Invalid Willinglist ID',
			'successmsg' => 'Willinglist removed successfully'
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
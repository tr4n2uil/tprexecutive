<?php 
require_once(SBSERVICE);

/**
 *	@class WillinglistInfoWorkflow
 *	@desc Returns willinglist information by ID
 *
 *	@param wgltid/id long int Willinglist ID [memory]
 *	@param keyid long int Usage Key ID [memory] optional default false
 *	@param user string Key User [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
 *	@param btname/name string Batch name [memory] optional default ''
 *
 *	@return willinglist array Willinglist information [memory]
 *	@return btname string Batch name [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillinglistInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('wgltid'),
			'optional' => array('keyid' => false, 'user' => '', 'btname' => false, 'name' => '', 'batchid' => false, 'id' => 0),
			'set' => array('id', 'name')
		); 
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['wgltid'] = $memory['wgltid'] ? $memory['wgltid'] : $memory['id'];
		
		$service = array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'wgltid', 'parent' => 'batchid', 'cname' => 'name', 'btname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`willinglists`',
			'sqlprj' => '`wgltid`, `batchid`, `visitid`, `name`',
			'sqlcnd' => "where `wgltid`=\${id}",
			'errormsg' => 'Invalid Willinglist ID',
			'type' => 'willinglist',
			'successmsg' => 'Willinglist information given successfully',
			'output' => array('entity' => 'willinglist')
		);
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('willinglist', 'btname', 'batchid', 'admin');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class WillinglistListWorkflow
 *	@desc Returns all willinglists information in post
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param batchid/id long int Batch/Visit ID [memory] optional default 0
 *	@param btname/name string Batch name [memory] optional default ''
 *
 *	@param pgsz long int Paging Size [memory] optional default 50
 *	@param pgno long int Paging Index [memory] optional default 0
 *	@param total long int Paging Total [memory] optional default false
 *	@param padmin boolean Is parent information needed [memory] optional default true
 *
 *	@return willinglists array Willinglists information [memory]
 *	@return batchid long int Batch/Visit ID [memory]
 *	@return btname string Batch Name [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return pgsz long int Paging Size [memory]
 *	@return pgno long int Paging Index [memory]
 *	@return total long int Paging Total [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillinglistListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('user' => '', 'batchid' => false, 'id' => 0, 'btname' => false, 'name' => '', 'pgsz' => 15, 'pgno' => 0, 'total' => false, 'padmin' => true),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['batchid'] = $memory['batchid'] ? $memory['batchid'] : $memory['id'];
		$memory['btname'] = $memory['btname'] ? $memory['btname'] : $memory['name'];
		
		$attr = $memory['btname'] == '' ? 'visitid' : 'batchid';
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'args' => array('batchid'),
			'input' => array('id' => 'batchid', 'btname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`willinglists`',
			'type' => 'willinglist',
			'sqlprj' => '`wgltid`, `batchid`, `visitid`, `name`',
			'sqlcnd' => "where `$attr`=\${batchid}",
			'successmsg' => 'Willinglists information given successfully',
			'lsttrack' => true,
			'output' => array('entities' => 'willinglists'),
			'mapkey' => 'wgltid',
			'mapname' => 'willinglist',
			'saction' => 'add'
		);
		
		$memory = Snowblozm::run($service, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory['uiadmin'] = ($memory['admin'] || $memory['padmin']) && ($memory['btname'] != '');
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('willinglists', 'batchid', 'btname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz', 'uiadmin');
	}
	
}

?>
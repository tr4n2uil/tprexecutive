<?php 
require_once(SBSERVICE);

/**
 *	@class BatchInfoWorkflow
 *	@desc Returns batch information by ID
 *
 *	@param batchid/id long int Batch ID [memory]
 *	@param keyid long int Usage Key ID [memory] optional default false
 *	@param user string Key User [memory]
 *	@param portalid long int Portal ID [memory] optional default 0
 *	@param plname/name string Portal name [memory] optional default ''
 *
 *	@return batch array Batch information [memory]
 *	@return plname string Portal name [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('batchid'),
			'optional' => array('keyid' => false, 'user' => '', 'plname' => false, 'name' => '', 'portalid' => false, 'id' => 0),
			'set' => array('id', 'name')
		); 
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['batchid'] = $memory['batchid'] ? $memory['batchid'] : $memory['id'];
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'batchid', 'parent' => 'portalid', 'cname' => 'name', 'pname' => 'plname'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "where `batchid`=\${id}",
			'errormsg' => 'Invalid Batch ID',
			'type' => 'batch',
			'successmsg' => 'Batch information given successfully',
			'output' => array('entity' => 'batch')
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('batch'),
			'params' => array('batch.0.btname' => 'btname', 'batch.0.resumes' => 'resumes', 'batch.0.notes' => 'notes')
		));
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batch', 'plname', 'portalid', 'admin', 'btname', 'resumes', 'notes');
	}
	
}

?>
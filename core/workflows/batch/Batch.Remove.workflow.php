<?php 
require_once(SBSERVICE);

/**
 *	@class BatchRemoveWorkflow
 *	@desc Removes batch by ID
 *
 *	@param batchid long int Batch ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param deptid long int Department ID [memory] optional default 0
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'batchid'),
			'optional' => array('deptid' => 0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Batch removed successfully';
		
		$workflow = array(
		array(
			'service' => 'executive.batch.info.workflow'
		),
		array(
			'service' => 'ad.reference.remove.workflow',
			'input' => array('parent' => 'deptid', 'id' => 'batchid')
		),
		array(
			'service' => 'ad.relation.delete.workflow',
			'args' => array('batchid'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "where `batchid`=\${batchid}",
			'errormsg' => 'Invalid Batch ID'
		),
		array(
			'service' => 'griddata.space.remove.workflow',
			'input' => array('spaceid' => 'resume', 'cntrid' => 'deptid')
		),
		array(
			'service' => 'griddata.space.remove.workflow',
			'input' => array('spaceid' => 'photo', 'cntrid' => 'deptid')
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
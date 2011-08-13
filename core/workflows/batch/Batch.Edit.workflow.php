<?php 
require_once(SBSERVICE);

/**
 *	@class BatchEditWorkflow
 *	@desc Edits batch of department
 *
 *	@param batchid long int Batch ID [memory]
 *	@param btname string Batch name [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'batchid', 'btname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Batch edited successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.authorize.workflow',
			'input' => array('id' => 'batchid'),
			'action' => 'edit'
		),
		array(
			'service' => 'sb.relation.update.workflow',
			'args' => array('batchid', 'btname'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "set `btname`='\${btname}' where `batchid`=\${batchid}",
			'escparam' => array('btname')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
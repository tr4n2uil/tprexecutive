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
		$memory['msg'] = 'Batch edited successfully';
		
		$workflow = array(
		array(
			'service' => 'ad.reference.authorize.workflow',
			'input' => array('id' => 'batchid'),
			'action' => 'edit'
		),
		array(
			'service' => 'ad.relation.update.workflow',
			'args' => array('batchid', 'btname'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "set `btname`='\${btname}' where `batchid`=\${batchid}",
			'escparam' => array('btname')
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
<?php 
require_once(SBSERVICE);

/**
 *	@class BatchInfoWorkflow
 *	@desc Returns information for batch using ID
 *
 *	@param batchid long int Batch ID [memory]
 *
 *	@return batchid string Batch ID [memory]
 *	@return btname string Batch name [memory]
 *	@return resume string Batch resume space [memory]
 *	@return photo string Batch photo space [memory]
 *s
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('batchid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Batch information given successfully';
		
		$workflow = array(
		array(
			'service' => 'ad.relation.unique.workflow',
			'args' => array('batchid'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "where `batchid`=\${batchid}",
			'errormsg' => 'Invalid Batch ID'
		),
		array(
			'service' => 'adcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0.btname' => 'btname', 'result.0.resume' => 'resume', 'result.0.photo' => 'photo')
		),
		array(
			'service' => 'ad.reference.read.workflow',
			'input' => array('id' => 'batchid')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batchid', 'btname', 'resume', 'photo');
	}
	
}

?>
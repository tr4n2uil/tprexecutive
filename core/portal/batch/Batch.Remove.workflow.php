<?php 
require_once(SBSERVICE);

/**
 *	@class BatchRemoveWorkflow
 *	@desc Removes batch by ID
 *
 *	@param batchid long int Batch ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param portalid long int Portal ID [memory] optional default 0
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
			'optional' => array('portalid' => 0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'executive.batch.info.workflow'
		),
		array(
			'service' => 'transpera.entity.remove.workflow',
			'input' => array('id' => 'batchid', 'parent' => 'portalid'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'type' => 'batch',
			'sqlcnd' => "where `batchid`=\${id}",
			'errormsg' => 'Invalid Batch ID',
			'destruct' => array(
				array(
					'service' => 'storage.directory.remove.workflow',
					'input' => array('dirid' => 'resumes', 'stgid' => 'portalid')
				),
				array(
					'service' => 'transpera.reference.remove.workflow',
					'input' => array('parent' => 'portalid', 'id' => 'notes')
				)
			),
			'successmsg' => 'Batch removed successfully'
		));
		
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
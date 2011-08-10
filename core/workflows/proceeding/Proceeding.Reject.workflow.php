<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingRejectWorkflow
 *	@desc Rejects the proceeding
 *
 *	@param procid long int Proceeding ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingRejectWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'procid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$workflow = array(
		array(
			'service' => 'gridevent.event.reject.workflow',
			'input' => array('eventid' => 'procid')
		),
		array(
			'service' => 'executive.proceeding.init.workflow'
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
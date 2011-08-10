<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingInfoWorkflow
 *	@desc Returns proceeding information by ID
 *
 *	@param procid long int Proceeding ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return proceeding array Proceeding information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('procid', 'keyid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Proceeding information given successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.relation.unique.workflow',
			'args' => array('procid'),
			'conn' => 'exconn',
			'relation' => '`proceedings`',
			'sqlcnd' => "where `procid`=\${procid}",
			'errormsg' => 'Invalid Proceeding ID'
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'proceeding')
		),
		array(
			'service' => 'sb.reference.read.workflow',
			'input' => array('id' => 'procid')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('proceeding');
	}
	
}

?>
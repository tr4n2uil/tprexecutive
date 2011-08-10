<?php 
require_once(SBSERVICE);

/**
 *	@class StudentBatchWorkflow
 *	@desc Returns all students enrolment year information
 *
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return batches array Students enrolment year information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentBatchWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Student enrolment year information given successfully';
		
		$service = array(
			'service' => 'sb.relation.select.workflow',
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlprj' => 'distinct `year`',
			'sqlcnd' => "order by `year` desc",
			'check' => false,
			'output' => array('result' => 'batches')
		);
		
		return $kernel->run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batches');
	}
	
}

?>
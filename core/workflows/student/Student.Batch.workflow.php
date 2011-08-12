<?php 
require_once(SBSERVICE);

/**
 *	@class StudentBatchWorkflow
 *	@desc Returns all students enrolment year information
 *
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return batches array Students enrolment year information [memory]
 *	@return admin integer Is admin [memory]
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
		
		$workflow = array(
		array(
			'service' => 'sb.relation.select.workflow',
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlprj' => 'distinct `year`',
			'sqlcnd' => "order by `year` desc",
			'check' => false,
			'output' => array('result' => 'batches')
		),
		array(
			'service' => 'sb.reference.authorize.workflow',
			'id' => 0,
			'admin' => true,
			'action' => 'add'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batches', 'admin');
	}
	
}

?>
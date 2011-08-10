<?php 
require_once(SBSERVICE);

/**
 *	@class StudentRemoveWorkflow
 *	@desc Removes student by ID
 *
 *	@param stuid long int Student ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'stuid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Student removed successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.delete.workflow',
			'parent' => 0,
			'input' => array('id' => 'stuid')
		),
		array(
			'service' => 'sb.relation.delete.workflow',
			'args' => array('stuid'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `stuid`=\${stuid}",
			'errormsg' => 'Invalid Student ID'
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
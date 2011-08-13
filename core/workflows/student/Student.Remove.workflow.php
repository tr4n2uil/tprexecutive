<?php 
require_once(SBSERVICE);

/**
 *	@class StudentRemoveWorkflow
 *	@desc Removes student by ID
 *
 *	@param stuid long int Student ID [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
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
			'required' => array('keyid', 'stuid'),
			'optional' => array('batchid' => 0)
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
			'service' => 'executive.batch.info.workflow',
			'output' => array('resume' => 'btresume', 'photo' => 'btphoto')
		),
		array(
			'service' => 'executive.student.info.workflow'
		),
		array(
			'service' => 'sb.reference.delete.workflow',
			'input' => array('id' => 'stuid', 'parent' => 'batchid')
		),
		array(
			'service' => 'sb.relation.delete.workflow',
			'args' => array('stuid'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `stuid`=\${stuid}",
			'errormsg' => 'Invalid Student ID'
		),
		array(
			'service' => 'gridview.content.remove.workflow',
			'input' => array('cntid' => 'home'),
			'siteid' => 0
		),
		array(
			'service' => 'griddata.storage.remove.workflow',
			'input' => array('stgid' => 'resume', 'spaceid' => 'btresume')
		),
		array(
			'service' => 'griddata.storage.remove.workflow',
			'input' => array('stgid' => 'photo', 'spaceid' => 'btphoto')
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
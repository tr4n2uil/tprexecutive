<?php 
require_once(SBSERVICE);

/**
 *	@class StudentInfoWorkflow
 *	@desc Returns student information by ID
 *
 *	@param stuid long int Student ID [memory] optional default false
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return student array Student information [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('stuid' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Student information given successfully';
		$attr = $memory['stuid'] ? 'stuid' : 'owner';
		$memory['stuid'] = $memory['stuid'] ? $memory['stuid'] : $memory['keyid'];
		
		$workflow = array(
		array(
			'service' => 'sb.relation.unique.workflow',
			'args' => array('stuid'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `$attr`=\${stuid}",
			'errormsg' => 'Invalid Student ID'
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'student', 'result.0.stuid' => 'stuid')
		),
		array(
			'service' => 'sb.reference.read.workflow',
			'input' => array('id' => 'stuid')
		),
		array(
			'service' => 'sb.reference.authorize.workflow',
			'id' => 0,
			'admin' => true,
			'action' => 'child'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('student', 'admin');
	}
	
}

?>
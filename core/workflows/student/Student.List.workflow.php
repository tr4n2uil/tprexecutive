<?php 
require_once(SBSERVICE);

/**
 *	@class StudentListWorkflow
 *	@desc Returns all students information with year and course
 *
 *	@param year integer Enrolment year [memory]
 *	@param course string Course [memory] optional default 'B Tech' ('B Tech', 'IDD')
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return students array Students information [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'year'),
			'optional' => array('course' => 'B Tech')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Student information given successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('year', 'course'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `year`=\${year} and `course`='\${course}' order by `cgpa` desc",
			'escparam' => array('course'),
			'check' => false,
			'output' => array('result' => 'students')
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
		return array('students', 'course', 'year', 'admin');
	}
	
}

?>
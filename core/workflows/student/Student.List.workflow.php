<?php 
require_once(SBSERVICE);

/**
 *	@class StudentListWorkflow
 *	@desc Returns all students information with year and course
 *
 *	@param course string Course [memory] optional default 'B Tech' ('B Tech', 'IDD')
 *	@param keyid long int Usage Key ID [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
 *	@param btname string Batch name [memory] optional default ''
 *
 *	@return students array Students information [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return btname string Batch name [memory]
  *	@return btphoto long int Batch Photo Space [memory]
  *	@return btresume long int Batch Resume Space [memory]
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
			'required' => array('keyid'),
			'optional' => array('batchid' => 0, 'btname' => '', 'course' => 'B Tech')
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
			'service' => 'executive.batch.info.workflow',
			'output' => array('resume' => 'btresume', 'photo' => 'btphoto')
		),
		array(
			'service' => 'sb.reference.children.workflow',
			'input' => array('id' => 'batchid')
		),
		array(
			'service' => 'sbcore.data.list.service',
			'args' => array('children'),
			'default' => array(-1),
			'attr' => 'child'
		),
		array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('list', 'course'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `stuid` in \${list} and `course`='\${course}' order by `cgpa` desc",
			'escparam' => array('list', 'course'),
			'check' => false,
			'output' => array('result' => 'students')
		),
		array(
			'service' => 'sb.reference.authorize.workflow',
			'input' => array('id' => 'batchid'),
			'admin' => true,
			'action' => 'add'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('students', 'batchid', 'btname', 'course', 'admin', 'btphoto', 'btresume');
	}
	
}

?>
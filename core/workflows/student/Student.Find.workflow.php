<?php 
require_once(SBSERVICE);

/**
 *	@class StudentFindWorkflow
 *	@desc Returns student information by email
 *
 *	@param email email Student Email [memory]
 *
 *	@return student array Student information [memory]
 *	@return name string Student name [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return home long int Student Home [memory]
 *	@return resume long int Student Resume [memory]
 *	@return photo long int Student Photo [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentFindWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('email')
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
			'service' => 'sb.relation.unique.workflow',
			'args' => array('email'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `email`='\${email}'",
			'escparam' => array('email'),
			'errormsg' => 'Invalid Student Email'
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'student', 'result.0.stuid' => 'stuid', 'result.0.owner' => 'owner', 'result.0.name' => 'name', 'result.0.home' => 'home', 'result.0.resume' => 'resume', 'result.0.photo' => 'photo')
		),
		array(
			'service' => 'sb.reference.read.workflow',
			'input' => array('id' => 'stuid')
		),
		array(
			'service' => 'sb.reference.parent.workflow',
			'input' => array('id' => 'stuid', 'keyid' => 'owner'),
			'output' => array('parent' => 'batchid')
		),
		array(
			'service' => 'executive.batch.info.workflow',
			'input' => array('keyid' => 'owner'),
			'output' => array('resume' => 'btresume', 'photo' => 'btphoto')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('student', 'batchid', 'name', 'home', 'resume', 'photo', 'btresume', 'btphoto');
	}
	
}

?>
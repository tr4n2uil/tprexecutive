<?php 
require_once(SBSERVICE);

/**
 *	@class GradeInfoWorkflow
 *	@desc Returns grade information by ID
 *
 *	@param gradeid/id long int Grade ID [memory]
 *	@param keyid long int Usage Key ID [memory] optional default false
 *	@param user string Key User [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
 *	@param btname/name string Batch name [memory] optional default ''
 *
 *	@return grade array Grade information [memory]
 *	@return btname string Batch name [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class GradeInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('gradeid'),
			'optional' => array('keyid' => false, 'user' => '', 'btname' => false, 'name' => '', 'batchid' => STUDENT_PORTAL_ID, 'id' => 0),
			'set' => array('id', 'name')
		); 
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['gradeid'] = $memory['gradeid'] ? $memory['gradeid'] : $memory['id'];
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'gradeid', 'parent' => 'batchid', 'cname' => 'name', 'pname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`gradees`',
			'sqlcnd' => "where `gradeid`=\${id}",
			'errormsg' => 'Invalid Grade ID',
			'type' => 'grade',
			'successmsg' => 'Grade information given successfully',
			'output' => array('entity' => 'grade')
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('grade'),
			'params' => array('grade.btname' => 'btname', 'grade.resumes' => 'resumes', 'grade.notes' => 'notes')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('grade', 'btname', 'batchid', 'admin', 'btname', 'resumes', 'notes');
	}
	
}

?>
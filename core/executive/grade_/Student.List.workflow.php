<?php 
require_once(SBSERVICE);

/**
 *	@class StudentListWorkflow
 *	@desc Returns all students information in portal container
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param batchid long int Portal ID [memory] optional default PORTAL_ID
 *	@param btname string Portal name [memory] optional default ''
 *	@param pgsz long int Paging Size [memory] optional default false
 *	@param pgno long int Paging Index [memory] optional default 1
 *	@param total long int Paging Total [memory] optional default false
 *
 *	@return students array Students information [memory]
 *	@return batchid long int Portal ID [memory]
 *	@return btname string Portal name [memory]
 *	@return admin integer Is admin [memory]
 *	@return total long int Paging Total [memory]
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
			'optional' => array('batchid' => STUDENT_PORTAL_ID, 'btname' => '', 'pgsz' => 25, 'pgno' => 0, 'total' => false),
			'set' => array('batchid', 'btname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'input' => array('id' => 'batchid', 'pname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlprj' => '`stdid`, `username`, `name`, `resume`, `home`, `interests`',
			'sqlcnd' => "where `stdid` in \${list} and `ustatus`<>'N' order by `cgpa` desc",
			'type' => 'student',
			'successmsg' => 'Students information given successfully',
			'output' => array('entities' => 'students'),
			'mapkey' => 'stdid',
			'mapname' => 'student'
		);
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('students', 'batchid', 'btname', 'total', 'pgsz', 'pgno');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class StudentListWorkflow
 *	@desc Returns all students information in portal container
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param batchid/id long int Portal ID [memory] optional default STUDENT_PORTAL_ID
 *	@param btname/name string Portal name [memory] optional default ''
 *	@param pgsz long int Paging Size [memory] optional default false
 *	@param pgno long int Paging Index [memory] optional default 1
 *	@param total long int Paging Total [memory] optional default false
 *
 *	@param filter string Filter [memory] optional default false
 *	@param year string Year [memory] optional default false
 *	@param course string course [memory] optional default false
 *
 *	@return students array Students information [memory]
 *	@return batchid long int Portal ID [memory]
 *	@return btname string Portal name [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return pgsz long int Paging Size [memory]
 *	@return pgno long int Paging Index [memory]
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
			'optional' => array('batchid' => false, 'id' => STUDENT_PORTAL_ID, 'btname' => false, 'name' => '', 'pgsz' => false, 'pgno' => 0, 'total' => false, 'padmin' => true),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['batchid'] = $memory['batchid'] ? $memory['batchid'] : $memory['id'];
		$memory['btname'] = $memory['btname'] ? $memory['btname'] : $memory['name'];
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'input' => array('id' => 'batchid', 'pname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlprj' => '`stdid`, `username`, `name`, `email`, `rollno`, `resume`, `home`, `interests`',
			'sqlcnd' => "where `stdid` in \${list} order by `rollno`",
			'type' => 'person',
			'successmsg' => 'Students information given successfully',
			'output' => array('entities' => 'students'),
			'mapkey' => 'stdid',
			'mapname' => 'student'
		);
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('students', 'id', 'batchid', 'btname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz');
	}
	
}

?>
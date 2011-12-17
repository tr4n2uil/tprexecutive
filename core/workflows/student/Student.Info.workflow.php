<?php 
require_once(SBSERVICE);

/**
 *	@class StudentInfoWorkflow
 *	@desc Returns student information by ID
 *
 *	@param stuid long int Student ID [memory] optional default false
 *	@param keyid long int Usage Key ID [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
 *
 *	@return student array Student information [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return home long int Student Home [memory]
 *	@return resume long int Student Resume [memory]
 *	@return photo long int Student Photo [memory]
 *	@return btresume long int Batch Resume Space [memory]
 *	@return btphoto long int Batch Photo Space [memory]
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
			'optional' => array('batchid' => 0, 'stuid' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Student information given successfully';
		$attr = $memory['stuid'] ? 'stuid' : 'owner';
		$memory['stuid'] = $memory['stuid'] ? $memory['stuid'] : $memory['keyid'];
		
		$workflow = array(
		array(
			'service' => 'executive.batch.info.workflow',
			'output' => array('resume' => 'btresume', 'photo' => 'btphoto')
		),
		array(
			'service' => 'transpera.relation.unique.workflow',
			'args' => array('stuid'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `$attr`=\${stuid}",
			'errormsg' => 'Invalid Student ID'
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'student', 'result.0.stuid' => 'stuid', 'result.0.home' => 'home', 'result.0.resume' => 'resume', 'result.0.photo' => 'photo')
		),
		array(
			'service' => 'gauge.track.read.workflow',
			'input' => array('id' => 'stuid')
		),
		array(
			'service' => 'transpera.reference.authorize.workflow',
			'input' => array('id' => 'batchid'),
			'admin' => true,
			'action' => 'add'
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('student', 'batchid', 'admin', 'home', 'resume', 'photo', 'btresume', 'btphoto');
	}
	
}

?>
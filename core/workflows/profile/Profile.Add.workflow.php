<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileAddWorkflow
 *	@desc Adds new profile
 *
 *	@param name string Profile name [memory]
 *	@param email string Email [memory]
 *	@param password string Password [memory]
 *	@param rollno string Roll number [memory]
 *	@param phone string Phone [memory] optional default ''
 *	@param course string Course [memory] optional default 'B Tech' ('B Tech', 'IDD')
 *	@param cgpa float CGPA [memory] optional default '0.0'
 *	@param keyid long int Usage Key ID [memory]
 *	@param owner long int Owner Key ID [memory] optional default keyid
 *
 *	@return prid long int Profile ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'name', 'email', 'password', 'rollno'),
			'optional' => array('phone' => '', 'course' => 'B Tech', 'cgpa' => 0.0, 'owner' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['owner'] = $memory['owner'] ? $memory['owner'] : $memory['keyid'];
		$memory['msg'] = 'Profile added successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.create.workflow',
			'input' => array('keyvalue' => 'password'),
			'parent' => 0,
			'level' => 1,
			'type' => 'child',
			'output' => array('id' => 'prid')
		),
		array(
			'service' => 'griddata.storage.add.workflow',
			'stgname' => '['.$memory['rollno'].'] '.$memory['name'].'.pdf',
			'filepath' => EXROOT.'storage/resumes/',
			'filename' => '['.$memory['rollno'].'] '.$memory['name'].'.pdf',
			'mime' => 'application/pdf',
			'output' => array('stgid' => 'resume')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('prid', 'name', 'owner', 'email', 'phone', 'rollno', 'course', 'cgpa', 'resume'),
			'conn' => 'exconn',
			'relation' => '`profiles`',
			'sqlcnd' => "(`prid`, `name`, `owner`, `email`, `phone`, `rollno`, `course`, `cgpa`, `resume`) values (\${prid}, '\${name}', \${owner}, '\${email}', '\${phone}', '\${rollno}', '\${course}', \${cgpa}, \${resume})",
			'escparam' => array('name', 'email', 'phone', 'rollno', 'course')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('prid');
	}
	
}

?>
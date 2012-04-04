<?php 
require_once(SBSERVICE);

/**
 *	@class StudentAddWorkflow
 *	@desc Adds new student
 *
 *	@param name string Student name [memory]
 *	@param username string Student username [memory]
 *	@param email string Email [memory]
 *	@param rollno string Roll no [memory]
 *
 *	@param keyid long int Usage Key [memory]
 *	@param batchid long int Batch ID [memory] optional default STUDENT_PORTAL_ID
 *	@param btname string Batch Name [memory] optional default ''
 *	@param level integer Web level [memory] optional default 1 (batch admin access allowed)
 *
 *	@return stdid long int Student ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'name', 'username', 'email', 'rollno'),
			'optional' => array('batchid' => STUDENT_PORTAL_ID, 'level' => 2, 'btname' => ''),
			'set' => array('batchid', 'btname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Student created successfully. Registration verification pending.';
		$memory['level'] = 2;
		
		$memory['verb'] = 'registered';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'executive.batch.info.workflow'
		),
		array(
			'service' => 'people.person.add.workflow',
			'input' => array('peopleid' => 'batchid', 'cname' => 'username'),
			'country' => 'India',
			'human' => false,
			'recaptcha_challenge_field' => false, 
			'recaptcha_response_field' => false,
			'device' => 'mail'
		),
		array(
			'service' => 'display.board.add.workflow',
			'input' => array('forumid' => 'notes', 'fname' => 'btname', 'user' => 'username'),
			'bname' => $memory['name']."'s Notes",
			'desc' => 'Links, Discussions and Interview Materials',
			'level' => 2,
			'output' => array('boardid' => 'home')
		),
		array(
			'service' => 'storage.file.add.workflow',
			'filename' => '['.$memory['rollno'].'] '.$memory['name'].'.pdf',
			'mime' => 'application/pdf',
			'input' => array('dirid' => 'resumes', 'user' => 'username'),
			'level' => 2,
			'output' => array('fileid' => 'resume')
		),
		array(
			'service' => 'executive.grade.add.workflow',
			'level' => 2,
			'output' => array('gradeid' => 'grade', 'grade' => 'info')
		),
		array(
			'service' => 'transpera.relation.insert.workflow',
			'args' => array('pnid', 'owner', 'username', 'name', 'email', 'rollno', 'resume', 'home', 'grade'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "(`stdid`,`owner`, `username`, `name`, `email`, `rollno`, `resume`, `home`, `grade`) values (\${pnid}, \${owner}, '\${username}', '\${name}', '\${email}', '\${rollno}', \${resume}, \${home}, \${grade})",
			'escparam' => array('username', 'name', 'email', 'rollno'),
			'output' => array('id' => 'stdid')
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
		
		$memory = Snowblozm::run(array(
			'service' => 'people.person.send.workflow'
		), $memory);
		
		if($memory['valid'])
			$memory['msg'] = 'Student created successfully. Verification sent successfully.';
		else
			$memory['msg'] = 'Student created successfully. Error sending verification mail.';
		
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('stdid');
	}
	
}

?>
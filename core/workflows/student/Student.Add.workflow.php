<?php 
require_once(SBSERVICE);

/**
 *	@class StudentAddWorkflow
 *	@desc Adds new student
 *
 *	@param name string Profile name [memory]
 *	@param email string Email [memory]
 *	@param password string Password [memory]
 *	@param rollno string Roll number [memory]
 *	@param phone string Phone [memory] optional default ''
 *	@param course string Course [memory] optional default 'B Tech' ('B Tech', 'IDD')
 *	@param year integer Enrolment year [memory]
 *	@param cgpa float CGPA [memory] optional default '0.0'
 *	@param interests string Interests [memory] optional default ''
 *	@param keyid long int Usage Key ID [memory]
  *	@param batchid long int Batch ID [memory] optional default 0
 *	@param level integer Web level [memory] optional default 1 (batch admin access allowed)
 *
 *	@return stuid long int Student ID [memory]
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
			'required' => array('keyid', 'name', 'email', 'password', 'rollno', 'year'),
			'optional' => array('batchid' => 0, 'level' => 1, 'phone' => '', 'course' => 'B Tech', 'cgpa' => 0.0, 'interests' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Student added successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.create.workflow',
			'input' => array('keyvalue' => 'password', 'parent' => 'batchid'),
			'output' => array('id' => 'stuid')
		),
		array(
			'service' => 'executive.batch.info.workflow'
		),
		array(
			'service' => 'gridview.content.add.workflow',
			'cntname' => 'home-'.$memory['name'],
			'cntstype' => 1,
			'cntstyle' => '',
			'cntttype' => 1,
			'cnttpl' => '<h3>Welcome to ${content.name}\'s Home Page</h3>',
			'cntdtype' => 1,
			'cntdata' => '{"name":"'.$memory['name'].'"}',
			'output' => array('cntid' => 'home')
		),
		array(
			'service' => 'griddata.space.info.workflow',
			'input' => array('spaceid' => 'resume')
		),
		array(
			'service' => 'griddata.storage.add.workflow',
			'filename' => '['.$memory['rollno'].'] '.$memory['name'].'.pdf',
			'mime' => 'application/pdf',
			'input' => array('spaceid' => 'resume', 'filepath' => 'sppath'),
			'output' => array('stgid' => 'resume')
		),
		array(
			'service' => 'griddata.space.info.workflow',
			'input' => array('spaceid' => 'photo')
		),
		array(
			'service' => 'griddata.storage.add.workflow',
			'filename' => '['.$memory['rollno'].'] '.$memory['name'].'.png',
			'mime' => 'image/png',
			'input' => array('spaceid' => 'photo', 'filepath' => 'sppath'),
			'output' => array('stgid' => 'photo')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('stuid', 'name', 'owner', 'email', 'phone', 'rollno', 'course', 'year', 'cgpa', 'interests', 'resume', 'photo', 'home'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "(`stuid`, `name`, `owner`, `email`, `phone`, `rollno`, `course`, `year`, `cgpa`, `interests`, `resume`, `photo`, `home`) values (\${stuid}, '\${name}', \${owner}, '\${email}', '\${phone}', '\${rollno}', '\${course}', \${year}, \${cgpa}, '\${interests}', \${resume}, \${photo}, \${home})",
			'escparam' => array('name', 'email', 'phone', 'rollno', 'course', 'interests')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('stuid');
	}
	
}

?>
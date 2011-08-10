<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyAddWorkflow
 *	@desc Adds new company
 *
 *	@param name string Company name [memory]
 *	@param email string Email [memory]
 *	@param password string Password [memory]
 *	@param site string Website URL [memory] optional default ''
 *	@param interests string Interests [memory] optional default ''
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return comid long int Company ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'name', 'email', 'password'),
			'optional' => array('site' => '', 'interests' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Company added successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.create.workflow',
			'input' => array('keyvalue' => 'password'),
			'parent' => 0,
			'level' => 1,
			'authorize' => 'edit:child',
			'output' => array('id' => 'comid')
		),
		array(
			'service' => 'griddata.storage.add.workflow',
			'filepath' => 'storage/photos/',
			'filename' => '['.$memory['email'].'] '.$memory['name'].'.png',
			'mime' => 'image/png',
			'output' => array('stgid' => 'photo')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('comid', 'name', 'owner', 'email', 'site', 'interests', 'photo'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "(`comid`, `name`, `owner`, `email`, `site`, `interests`, `photo`) values (\${comid}, '\${name}', \${owner}, '\${email}', '\${site}', '\${interests}', \${photo})",
			'escparam' => array('name', 'email', 'site', 'interests')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('comid');
	}
	
}

?>
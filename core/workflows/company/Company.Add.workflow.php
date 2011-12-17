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
 *	@param indid long int Industry ID [memory] optional default 0
 *	@param level integer Web level [memory] optional default 1 (industry admin access allowed)
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
			'optional' => array('indid' => 0, 'level' => 1, 'site' => '', 'interests' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Company added successfully';
		
		$workflow = array(
		array(
			'service' => 'transpera.reference.create.workflow',
			'input' => array('keyvalue' => 'password', 'parent' => 'indid'),
			'authorize' => 'edit:add:remove',
			'level' => 2,
			'output' => array('id' => 'comid')
		),
		array(
			'service' => 'store.storage.add.workflow',
			'filename' => '['.$memory['email'].'] '.$memory['name'].'.png',
			'mime' => 'image/png',
			'spaceid' => 0,
			'output' => array('stgid' => 'photo')
		),
		array(
			'service' => 'transpera.relation.insert.workflow',
			'args' => array('comid', 'name', 'owner', 'email', 'site', 'interests', 'photo'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "(`comid`, `name`, `owner`, `email`, `site`, `interests`, `photo`) values (\${comid}, '\${name}', \${owner}, '\${email}', '\${site}', '\${interests}', \${photo})",
			'escparam' => array('name', 'email', 'site', 'interests')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('comid');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyAddWorkflow
 *	@desc Adds new company
 *
 *	@param name string Company name [memory]
 *	@param username string Company username [memory]
 *	@param email string Email [memory]
 *	@param phone string Phone [memory] optional default ''
 *	@param scope string Field Scope [memory] optional default ''
 *	@param site string Website URL [memory] optional default ''
 *	@param country string Country [memory] optional default India
 *	@param page string Detail Page [memory] optional default ''
 *
 *	@param keyid long int Usage Key [memory]
 *	@param portalid long int Batch ID [memory] optional default COMPANY_PORTAL_ID
 *	@param pname string Batch Name [memory] optional default ''
 *	@param level integer Web level [memory] optional default 1 (portal admin access allowed)
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
			'required' => array('keyid', 'name', 'username', 'email'),
			'optional' => array('portalid' => COMPANY_PORTAL_ID, 'level' => 2, 'pname' => '', 'phone' => '', 'scope' => '', 'site' => '', 'country' => 'India', 'page' => ''),
			'set' => array('portalid', 'pname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['level'] = 1;
		$memory['verb'] = 'registered';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'cbcore.random.string.service',
			'length' => 8,
			'output' => array('random' => 'password')
		),
		array(
			'service' => 'people.person.add.workflow',
			'input' => array('peopleid' => 'portalid', 'cname' => 'username'),
			'human' => false,
			'recaptcha_challenge_field' => false, 
			'recaptcha_response_field' => false,
			'device' => 'mail'
		),
		array(
			'service' => 'display.board.add.workflow',
			'input' => array('bname' => 'name', 'forumid' => 'notes', 'fname' => 'pname'),
			'level' => 2,
			'output' => array('boardid' => 'home')
		),
		array(
			'service' => 'storage.directory.add.workflow',
			'name' => 'storage/private/folders/'.$memory['username'],
			'path' => 'storage/private/folders/'.$memory['username'],
			'input' => array('stgid' => 'portalid'),
			'output' => array('dirid' => 'folder')
		),
		array(
			'service' => 'transpera.relation.insert.workflow',
			'args' => array('pnid', 'owner', 'username', 'name', 'email', 'phone', 'site', 'scope', 'page', 'folder', 'home'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "(`comid`,`owner`, `username`, `name`, `email`, `phone`, `site`, `scope`, `page`, `resume`, `home`) values (\${pnid}, \${owner}, '\${username}', '\${name}', '\${email}', '\${phone}', '\${site}', '\${scope}', '\${page}', \${resume}, \${home})",
			'escparam' => array('username', 'name', 'email', 'phone', 'site', 'scope', 'page'),
			'output' => array('id' => 'comid')
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
		
		$memory = Snowblozm::run(array(
			'service' => 'people.person.send.workflow'
		), $memory);
		
		if($memory['valid'])
			$memory['msg'] = 'Company created successfully. Verification sent successfully.';
		else
			$memory['msg'] = 'Company created successfully. Error sending verification mail. Please resend verification mail <a href="!/view/#verify" class="navigate">here</a>';
		
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('comid');
	}
	
}

?>
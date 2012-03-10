<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileAddWorkflow
 *	@desc Adds new profile
 *
 *	@param name string Profile name [memory]
 *	@param username string Profile username [memory]
 *	@param password string Password [memory] 
 *	@param recaptcha_challenge_field string Challenge [memory]
 *	@param recaptcha_response_field string Response [memory] 
 *	@param country string Country [memory]
 *	@param email string Email [memory] optional default false
 *	@param phone string Phone [memory] optional default false
 *	@param device string Device to verify [memory] optional default 'mail' ('mail', 'sms')
 *	@param location long int Location [memory] optional default 0
 *
 *	@param org string Organization [memory]
 *	@param dept string Department [memory]
 *	@param post string Post [memory]
 *	@param utype string Profile Type [memory] optional default 'S' ('S', 'P')
 *	@param links string Links [memory] optional default ''
 *	@param motto string Motto [memory] optional default ''
 *
 *	@param keyid long int Usage Key [memory] optional default false
 *	@param portalid long int Portal ID [memory] optional default PORTAL_ID
 *	@param level integer Web level [memory] optional default 1 (portal admin access allowed)
 *
 *	@return plid long int Profile ID [memory]
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
			'required' => array('name', 'username', 'password','recaptcha_challenge_field', 'recaptcha_response_field', 'country', 'org', 'dept', 'post'),
			'optional' => array('keyid' => false, 'email' => false, 'phone' => false, 'portalid' => PORTAL_ID, 'level' => 1, 'location' => 0, 'device' => 'mail', 'utype' => 'S', 'links' => '', 'motto' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Profile created successfully. Please verify your registration.';
		$memory['portalid'] = PORTAL_ID;
		$memory['level'] = 1;
		
		$memory['device'] = 'mail';
		$memory['verb'] = 'registered';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'people.person.add.workflow',
			'input' => array('peopleid' => 'portalid', 'cname' => 'username'),
		),
		array(
			'service' => 'transpera.relation.insert.workflow',
			'args' => array('pnid', 'username', 'name', 'country', 'owner', 'org', 'dept', 'post', 'links', 'motto', 'utype'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlcnd' => "(`plid`, `username`, `name`, `country`, `owner`, `org`, `dept`, `post`, `links`, `motto`, `utype`) values (\${pnid}, '\${username}', '\${name}', '\${country}', \${owner}, '\${org}', '\${dept}', '\${post}', '\${links}', '\${motto}', '\${utype}')",
			'escparam' => array('username', 'name', 'country', 'org', 'dept', 'post', 'links', 'motto', 'utype'),
			'output' => array('id' => 'plid')
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory = Snowblozm::run(array(
			'service' => 'people.person.send.workflow'
		), $memory);
		
		if($memory['valid'])
			$memory['msg'] = 'Profile created successfully. Please verify your registration.';
		else
			$memory['msg'] = 'Profile created successfully. Error sending verification mail. Please resend verification mail <a href="!/view/#verify" class="navigate">here</a>';
		
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('plid');
	}
	
}

?>
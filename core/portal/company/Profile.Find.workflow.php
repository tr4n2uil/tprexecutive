<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileFindWorkflow
 *	@desc Returns profile information by user
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Profile User [memory]
 *	@param name string Profile Name [memory] optional default user
 *	@param portalid long int Portal ID [memory] optional default PORTAL_ID
 *
 *	@return profile array Profile information [memory]
 *	@return person array Person information [memory]
 *	@return contact array Profile contact information [memory]
 *	@return personal array Profile personal information [memory]
 *	@return plid long int Profile ID [memory]
 *	@return name string Profile name [memory]
 *	@return title string Profile title [memory]
 *	@return thumbnail long int Profile thumbnail ID [memory]
 *	@return dirid long int Thumbnail Directory ID [memory]
 *	@return username string Profile username [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return admin integer Is admin [memory]
 *	@return chain array Chain data [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileFindWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('user', 'keyid'),
			'optional' => array('portalid' => PORTAL_ID, 'name' => false),
			'set' => array('name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Profile information given successfully';
		$memory['name'] = $memory['name'] ? $memory['name'] : $memory['user'];
		
		$workflow = array(
		array(
			'service' => 'people.person.find.workflow'
		),
		array(
			'service' => 'transpera.relation.unique.workflow',
			'args' => array('name'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlprj' => '`plid`, `name`, `username`, `country`, `org`, `dept`, `post`, `links`, `motto`, `utype`',
			'sqlcnd' => "where `username`='\${name}'",
			'escparam' => array('name'),
			'errormsg' => 'Invalid Username',
			'successmsg' => 'Profile information given successfully'
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'profile', 'result.0.plid' => 'plid', /* 'profile.name' => 'name', 'profile.title' => 'title', 'profile.thumbnail' => 'thumbnail', 'profile.username' => 'username'*/)
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid']) return $memory;
		
		$memory['id'] = $memory['plid'];
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('profile', 'person', 'contact', 'personal', 'plid', 'id', /*'name', 'title', 'thumbnail', 'username',*/ 'dirid', 'portalid', 'admin', 'chain');
	}
	
}

?>
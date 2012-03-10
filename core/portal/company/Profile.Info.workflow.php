<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileInfoWorkflow
 *	@desc Returns profile information by ID
 *
 *	@param plid/id string Profile ID [memory] optional default false
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string User name [memory] optional default ''
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
class ProfileInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('user' => '', 'plid' => false, 'portalid' => PORTAL_ID, 'id' => 0),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Profile information given successfully';
		$attr = $memory['plid'] ? 'plid' : ($memory['id'] ? 'plid' : 'owner');
		$memory['plid'] = $memory['plid'] ? $memory['plid'] : ($memory['id'] ? $memory['id'] : $memory['keyid']);
		
		// args arguments
		$memory['auth'] = isset($memory['auth']) ? $memory['auth'] : true;
		
		$workflow = array(
		array(
			'service' => 'people.person.info.workflow',
			'input' => array('pnid' => 'plid', 'peopleid' => 'portalid')
		),
		array(
			'service' => 'transpera.relation.unique.workflow',
			'args' => array('plid'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlprj' => '`plid`, `name`, `username`, `country`, `org`, `dept`, `post`, `links`, `motto`, `utype`',
			'sqlcnd' => "where `$attr`='\${plid}'",
			'errormsg' => 'Invalid Profile ID',
			'successmsg' => 'Profile information given successfully',
			'output' => array('entity' => 'profile')
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'profile', /*'result.0.plid' => 'plid', 'profile.name' => 'name', 'profile.title' => 'title', 'profile.thumbnail' => 'thumbnail', 'profile.username' => 'username'*/)
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('profile', 'person', 'contact', 'personal', 'plid', /*'name', 'title', 'thumbnail', 'username',*/ 'dirid', 'portalid', 'admin', 'chain');
	}
	
}

?>

<?php 
require_once(SBSERVICE);

/** TODO
 *	@class ProfileRemoveWorkflow
 *	@desc Removes profile by ID
 *
 *	@param plid long int Profile ID [memory]
 *	@param portalid long int Portal ID [memory] optional default 5
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'plid'),
			'optional' => array('portalid' => 5)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Profile removed successfully';
		
		$workflow = array(
		array(
			'service' => 'portal.profile.info.workflow'
		),
		array(
			'service' => 'transpera.entity.remove.workflow',
			'input' => array('id' => 'plid', 'parent' => 'portalid'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlcnd' => "where `plid`=\${id}",
			'errormsg' => 'Invalid Profile ID',
			'successmsg' => 'Profile removed successfully'
			'destruct' => array(
			array(
				'service' => 'storage.file.remove.workflow',
				'input' => array('fileid' => 'thumbnail'),
				'dirid' => PERSON_THUMB
			))
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
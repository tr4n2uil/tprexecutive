<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileEditWorkflow
 *	@desc Edits profile using ID
 *
 *	@param plid long int Profile ID [memory]
 *	@param name string Profile name [memory]
 *	@param title string Title [memory]
 *	@param phone string Phone [memory]
 *	@param dateofbirth string Date of birth [memory] (Format YYYY-MM-DD)
 *	@param gender string Gender [memory]  (M=Male F=Female N=None)
 *	@param address string Address [memory] 
 *	@param country string Country [memory]
 *	@param location long int Location [memory] optional default 0
 *
 *	@param org string Organization [memory]
 *	@param dept string Department [memory]
 *	@param post string Post [memory]
 *	@param links string Links [memory]
 *	@param motto string Motto [memory]
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Username [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'plid', 'name', 'phone', 'address', 'country', 'org', 'dept', 'post', 'links', 'motto'),
			'optional' => array('location' => 0, 'title' => '', 'dateofbirth' => '', 'gender' => 'N')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'people.person.edit.workflow',
			'input' => array('pnid' => 'plid')
		),
		array(
			'service' => 'people.person.update.workflow',
			'input' => array('pnid' => 'plid'),
			'email' => false,
			'device' => 'sms'
		),
		array(
			'service' => 'transpera.relation.update.workflow',
			'args' => array('plid', 'country', 'org', 'dept', 'post', 'links', 'motto'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlcnd' => "set `country`='\${country}', `org`='\${org}', `dept`='\${dept}', `post`='\${post}', `links`='\${links}', `motto`='\${motto}' where `plid`=\${plid}",
			'escparam' => array('org', 'dept', 'post', 'links', 'motto', 'country'),
			'successmsg' => 'Profile edited successfully',
			'check' => false,
			'errormsg' => 'No Change / Invalid Profile ID'
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
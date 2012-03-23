<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyEditWorkflow
 *	@desc Edits company using ID
 *
 *	@param comid long int Company ID [memory]
 *	@param name string Company name [memory]
 *	@param site string Website URL [memory] optional default ''
 *	@param country string Country [memory] optional default India
 *	@param page string Detail Page [memory] optional default ''
 
 *	@param title string Title [memory]
 *	@param phone string Phone [memory]
 *	@param address string Address [memory] 
 *	@param location long int Location [memory] optional default 0
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Username [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'comid', 'name', 'phone', 'address', 'site', 'country', 'page'),
			'optional' => array('location' => 0, 'title' => '', 'dateofbirth' => '', 'gender' => 'N')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'transpera.reference.authorize.workflow',
			'input' => array('id' => 'comid'),
			'init' => false
		),
		array(
			'service' => 'people.person.edit.workflow',
			'input' => array('pnid' => 'comid'),
			'country' => 'India',
		),
		array(
			'service' => 'people.person.update.workflow',
			'input' => array('pnid' => 'comid'),
			'email' => false,
			'device' => 'sms'
		),
		array(
			'service' => 'transpera.relation.update.workflow',
			'args' => array('stuid', 'name', 'phone', 'site', 'country', 'page'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "set `name`='\${name}', `phone`='\${phone}', `site`='\${site}', `country`='\${country}', `page`='\${page}' where `comid`=\${comid}",
			'successmsg' => 'Company edited successfully',
			'check' => false,
			'escparam' => array('name', 'phone', 'site', 'country', 'page'),
			'errormsg' => 'No Change / Invalid Company ID'
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
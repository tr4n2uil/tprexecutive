<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyEditWorkflow
 *	@desc Updates company using ID
 *
 *	@param comid long int Company ID [memory]
 *	@param interests string Interests [memory]
 
 *	@param title string Title [memory]
 *	@param phone string Phone [memory]
 *	@param dateofbirth string Date of birth [memory] (Format YYYY-MM-DD)
 *	@param gender string Gender [memory]  (M=Male F=Female N=None)
 *	@param address string Address [memory] 
 *	@param country string Country [memory]
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
			'required' => array('keyid', 'user', 'comid', 'phone', 'address', 'interests'),
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
			'args' => array('stuid', 'phone', 'interests'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "set `phone`='\${phone}', `interests`='\${interests}' where `stuid`=\${stuid}",
			'successmsg' => 'Company updated successfully',
			'check' => false,
			'escparam' => array('phone', 'interests'),
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
<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyFindWorkflow
 *	@desc Returns company information by email
 *
 *	@param email long int Company Email [memory]
 *
 *	@return company array Company information [memory]
 *	@return comid long int Company ID [memory]
 *	@return name string Company Name [memory]
 *	@return indid long int Industry ID [memory]
 *	@return photo long int Company Photo [memory]
 *	@return indphoto long int Industry Photo Space [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyFindWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('email')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Company information given successfully';
		$memory['indphoto'] = 0;
		
		$workflow = array(
		array(
			'service' => 'ad.relation.unique.workflow',
			'args' => array('email'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "where `email`='\${email}'",
			'escparam' => array('email'),
			'errormsg' => 'Invalid Company Email'
		),
		array(
			'service' => 'adcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'company', 'result.0.comid' => 'comid', 'result.0.owner' => 'owner', 'result.0.name' => 'name', 'result.0.photo' => 'photo')
		),
		array(
			'service' => 'ad.reference.read.workflow',
			'input' => array('id' => 'comid')
		),
		array(
			'service' => 'ad.reference.parent.workflow',
			'input' => array('id' => 'comid', 'keyid' => 'owner'),
			'output' => array('parent' => 'indid')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('company', 'comid', 'name', 'photo', 'indid', 'indphoto');
	}
	
}

?>
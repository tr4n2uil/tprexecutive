<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyInfoWorkflow
 *	@desc Returns company information by ID
 *
 *	@param comid long int Company ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return company array Company information [memory]
 *	@return photo long int Company Photo [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'comid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Company information given successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.relation.unique.workflow',
			'args' => array('comid'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "where `comid`=\${comid}",
			'errormsg' => 'Invalid Company ID'
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'company', 'result.0.photo' => 'photo')
		),
		array(
			'service' => 'sb.reference.read.workflow',
			'input' => array('id' => 'comid')
		),
		array(
			'service' => 'sb.reference.authorize.workflow',
			'input' => array('id' => 'comid'),
			'admin' => true,
			'action' => 'edit'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('company', 'admin', 'photo');
	}
	
}

?>
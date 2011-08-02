<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyInfoWorkflow
 *	@desc Returns company information by ID
 *
 *	@param comid long int Company ID [memory]
 *
 *	@return company array Company information [memory]
 *	@return profiles array Company eligible profiles information [memory]
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
			'required' => array('comid')
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
			'service' => 'sb.reference.read.workflow',
			'input' => array('id' => 'comid')
		),
		array(
			'service' => 'sbcore.data.select.workflow',
			'args' => array('result'),
			'params' => array('result.0' => 'company', 'result.0.type' => 'type', 'result.0.eligibility' => 'eligibility', 'result.0.margin' => 'margin', 'result.0.max' => 'max', 'result.0.rejection' => 'rejection')
		),
		array(
			'service' => 'executive.company.eligibility.workflow'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('company', 'profiles');
	}
	
}

?>
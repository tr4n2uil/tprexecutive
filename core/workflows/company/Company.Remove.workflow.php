<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyRemoveWorkflow
 *	@desc Removes company by ID
 *
 *	@param comid long int Company ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyRemoveWorkflow implements Service {
	
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
	
		$memory['msg'] = 'Company removed successfully';
		
		$workflow = array(
		array(
			'service' => 'executive.company.info.workflow'
		),
		array(
			'service' => 'sb.reference.remove.workflow',
			'parent' => 0,
			'input' => array('id' => 'comid')
		),
		array(
			'service' => 'sb.relation.delete.workflow',
			'args' => array('comid'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "where `comid`=\${comid}",
			'errormsg' => 'Invalid Company ID'
		),
		array(
			'service' => 'griddata.storage.remove.workflow',
			'input' => array('stgid' => 'photo'),
			'spaceid' => 0
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
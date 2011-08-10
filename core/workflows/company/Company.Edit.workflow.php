<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyEditWorkflow
 *	@desc Edits company using ID
 *
 *	@param comid long int Company ID [memory]
 *	@param name string Company name [memory]
 *	@param site string Website URL [memory] optional default ''
 *	@param interests string Interests [memory] optional default ''
 *	@param keyid long int Usage Key ID [memory]
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
			'required' => array('keyid', 'comid', 'name', 'site', 'interests')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Company edited successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.authorize.workflow',
			'id' => 0,
			'type' => 'edit'
		),
		array(
			'service' => 'sb.relation.update.workflow',
			'args' => array('comid', 'name', 'site', 'interests'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "set `name`='\${name}', `site`='\${site}', `interests`='\${interests}' where `comid`=\${comid}",
			'escparam' => array('name', 'site', 'interests')
		),
		array(
			'service' => 'sb.reference.write.workflow',
			'input' => array('id' => 'comid')
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
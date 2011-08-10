<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyListWorkflow
 *	@desc Returns all companies information
 *
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return companies array Companies information [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Companies information given successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.relation.select.workflow',
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => 'order by `name`',
			'check' => false,
			'output' => array('result' => 'companies')
		),
		array(
			'service' => 'sb.reference.authorize.workflow',
			'id' => 0,
			'admin' => true,
			'action' => 'add'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('companies', 'admin');
	}
	
}

?>
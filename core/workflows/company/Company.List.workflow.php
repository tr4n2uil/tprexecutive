<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyListWorkflow
 *	@desc Returns all companies information in group 0
 *
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return companies array Companies information [memory]
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
			'service' => 'sb.reference.children.workflow',
			'id' => 0
		),
		array(
			'service' => 'sbcore.data.list.service',
			'args' => array('children')
		),
		array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('list'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "where `comid` in \${list} order by `deadline` desc",
			'escparam' => array('list'),
			'check' => false,
			'output' => array('result' => 'companies')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('companies');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingListWorkflow
 *	@desc Returns all proceedings information for company
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param comid long int Company ID [memory]
 *
 *	@return proceedings array Proceedings information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingListWorkflow implements Service {
	
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
		$memory['msg'] = 'Proceedings information given successfully';
		
		$workflow = array(
		array(
			'service' => 'ad.reference.children.workflow',
			'input' => array('id' => 'comid')
		),
		array(
			'service' => 'adcore.data.list.service',
			'args' => array('children'),
			'attr' => 'child'
		),
		array(
			'service' => 'ad.relation.select.workflow',
			'args' => array('list'),
			'conn' => 'exconn',
			'relation' => '`proceedings`',
			'sqlcnd' => "where `procid` in \${list} order by `deadline` desc",
			'escparam' => array('list'),
			'check' => false,
			'output' => array('result' => 'proceedings')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('proceedings');
	}
	
}

?>
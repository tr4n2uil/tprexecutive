<?php 
require_once(SBSERVICE);

/**
 *	@class BatchListWorkflow
 *	@desc Returns all batches information in department
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param deptid long int Department ID [memory] optional default 0
 *	@param deptname string Department name [memory] optional default ''
 *
 *	@return batches array Batch information [memory]
 *	@return deptid long int Department ID [memory]
 *	@return deptname string Department name [memory]
 *	@return admin integer Is admin [memory] 
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('deptid' => 0, 'deptname' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Batches information given successfully';
		
		$workflow = array(
		array(
			'service' => 'transpera.reference.children.workflow',
			'input' => array('id' => 'deptid')
		),
		array(
			'service' => 'cbcore.data.list.service',
			'args' => array('children'),
			'default' => array(-1),
			'attr' => 'child'
		),
		array(
			'service' => 'transpera.relation.select.workflow',
			'args' => array('list'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "where `batchid` in \${list} order by `btname`",
			'escparam' => array('list'),
			'check' => false,
			'output' => array('result' => 'batches')
		),
		array(
			'service' => 'transpera.reference.authorize.workflow',
			'input' => array('id' => 'deptid'),
			'admin' => true,
			'action' => 'add'
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batches', 'admin', 'deptid', 'deptname');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyListWorkflow
 *	@desc Returns all companies information
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param indid long int Industry ID [memory] optional default 0
 *	@param indname string Industry name [memory] optional default ''
 *
 *	@return companies array Companies information [memory]
 *	@return indid long int Industry ID [memory]
 *	@return indname string Industry name [memory]
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
			'required' => array('keyid'),
			'optional' => array('indid' => 0, 'indname' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Companies information given successfully';
		
		$workflow = array(
		array(
			'service' => 'transpera.reference.children.workflow',
			'input' => array('id' => 'indid')
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
			'relation' => '`companies`',
			'sqlcnd' => "where `comid` in \${list} order by `name`",
			'escparam' => array('list'),
			'check' => false,
			'output' => array('result' => 'companies')
		),
		array(
			'service' => 'transpera.reference.authorize.workflow',
			'input' => array('id' => 'indid'),
			'admin' => true,
			'action' => 'add'
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('companies', 'indid', 'indname', 'admin');
	}
	
}

?>
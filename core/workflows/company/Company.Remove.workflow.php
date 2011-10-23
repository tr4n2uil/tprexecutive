<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyRemoveWorkflow
 *	@desc Removes company by ID
 *
 *	@param comid long int Company ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param indid long int Industry ID [memory] optional default 0
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
			'required' => array('keyid', 'comid'),
			'optional' => array('indid' => 0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Company removed successfully';
		
		$workflow = array(
		array(
			'service' => 'executive.company.info.workflow'
		),
		array(
			'service' => 'ad.reference.remove.workflow',
			'input' => array('id' => 'comid', 'parent' => 'indid')
		),
		array(
			'service' => 'ad.relation.delete.workflow',
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
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
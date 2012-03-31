<?php 
require_once(SBSERVICE);

/**
 *	@class VisitRemoveWorkflow
 *	@desc Removes visit by ID
 *
 *	@param visitid long int Visit ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param comid long int Company ID [memory] optional default 0
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class VisitRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'visitid'),
			'optional' => array('comid' => 0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'executive.visit.info.workflow'
		),
		array(
			'service' => 'transpera.entity.remove.workflow',
			'input' => array('id' => 'visitid', 'parent' => 'comid'),
			'conn' => 'exconn',
			'relation' => '`visits`',
			'type' => 'visit',
			'sqlcnd' => "where `visitid`=\${id}",
			'errormsg' => 'Invalid Visit ID',
			'destruct' => array(
				array(
					'service' => 'storage.directory.remove.workflow',
					'input' => array('dirid' => 'files', 'stgid' => 'comid')
				),
				array(
					'service' => 'transpera.reference.remove.workflow',
					'input' => array('parent' => 'comid', 'id' => 'shortlist')
				)
			),
			'successmsg' => 'Visit removed successfully'
		));
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
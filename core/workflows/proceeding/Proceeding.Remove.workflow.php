<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingRemoveWorkflow
 *	@desc Removes proceeding by ID
 *
 *	@param comid long int Company ID [memory]
 *	@param procid long int Proceeding ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'comid', 'procid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Proceeding removed successfully';
		
		$workflow = array(
		array(
			'service' => 'gridevent.event.remove.workflow',
			'input' => array('seriesid' => 'comid', 'eventid' => 'procid')
		),
		array(
			'service' => 'ad.relation.delete.workflow',
			'args' => array('procid'),
			'conn' => 'exconn',
			'relation' => '`proceedings`',
			'sqlcnd' => "where `procid`=\${procid}",
			'errormsg' => 'Invalid Proceeding ID'
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
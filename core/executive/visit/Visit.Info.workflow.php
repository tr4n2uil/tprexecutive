<?php 
require_once(SBSERVICE);

/**
 *	@class VisitInfoWorkflow
 *	@desc Returns visit information by ID
 *
 *	@param visitid/id long int Visit ID [memory]
 *	@param keyid long int Usage Key ID [memory] optional default false
 *	@param user string Key User [memory]
 *	@param comid long int Company ID [memory] optional default 0
 *	@param comname/name string Company name [memory] optional default ''
 *
 *	@return visit array Visit information [memory]
 *	@return comname string Company name [memory]
 *	@return comid long int Company ID [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class VisitInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('visitid'),
			'optional' => array('keyid' => false, 'user' => '', 'comname' => false, 'name' => '', 'comid' => false, 'id' => 0),
			'set' => array('id', 'name')
		); 
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['visitid'] = $memory['visitid'] ? $memory['visitid'] : $memory['id'];
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'visitid', 'parent' => 'comid', 'cname' => 'name', 'pname' => 'comname'),
			'conn' => 'exconn',
			'relation' => '`visits`',
			'sqlcnd' => "where `visitid`=\${id}",
			'errormsg' => 'Invalid Visit ID',
			'type' => 'visit',
			'successmsg' => 'Visit information given successfully',
			'output' => array('entity' => 'visit')
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('visit'),
			'params' => array('visit.0.btname' => 'btname', 'visit.0.files' => 'files', 'visit.0.shortlist' => 'shortlist')
		));
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('visit', 'comname', 'comid', 'admin', 'btname', 'files', 'shortlist');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class VisitListWorkflow
 *	@desc Returns all visites information in portal
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param comid/id long int Company ID [memory] optional default 0
 *	@param comname/name string Company name [memory] optional default ''
 *
 *	@param pgsz long int Paging Size [memory] optional default 25
 *	@param pgno long int Paging Index [memory] optional default 0
 *	@param total long int Paging Total [memory] optional default false
 *	@param padmin boolean Is parent information needed [memory] optional default true
 *
 *	@return visites array Visits information [memory]
 *	@return comid long int Company ID [memory]
 *	@return comname string Company Name [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return pgsz long int Paging Size [memory]
 *	@return pgno long int Paging Index [memory]
 *	@return total long int Paging Total [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class VisitListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('user' => '', 'comid' => false, 'id' => 0, 'comname' => false, 'name' => '', 'pgsz' => 25, 'pgno' => 0, 'total' => false, 'padmin' => true),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['comid'] = $memory['comid'] ? $memory['comid'] : $memory['id'];
		$memory['comname'] = $memory['comname'] ? $memory['comname'] : $memory['name'];
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'input' => array('id' => 'comid', 'pname' => 'comname'),
			'conn' => 'exconn',
			'relation' => '`visits`',
			'type' => 'visit',
			'sqlcnd' => "where `visitid` in \${list} order by `visitdate` desc",
			'successmsg' => 'Visites information given successfully',
			'lsttrack' => true,
			'output' => array('entities' => 'visites'),
			'mapkey' => 'visitid',
			'mapname' => 'visit',
			'saction' => 'add'
		);
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('visites', 'comid', 'comname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz');
	}
	
}

?>
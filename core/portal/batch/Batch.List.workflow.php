<?php 
require_once(SBSERVICE);

/**
 *	@class BatchListWorkflow
 *	@desc Returns all batches information in portal
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param portalid/id long int Portal ID [memory] optional default 0
 *	@param plname/name string Portal name [memory] optional default ''
 *
 *	@param pgsz long int Paging Size [memory] optional default 25
 *	@param pgno long int Paging Index [memory] optional default 0
 *	@param total long int Paging Total [memory] optional default false
 *	@param padmin boolean Is parent information needed [memory] optional default true
 *
 *	@return batches array Batchs information [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return plname string Portal Name [memory]
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
class BatchListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('user' => '', 'portalid' => false, 'id' => 0, 'plname' => false, 'name' => '', 'pgsz' => 25, 'pgno' => 0, 'total' => false, 'padmin' => true),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['portalid'] = $memory['portalid'] ? $memory['portalid'] : $memory['id'];
		$memory['plname'] = $memory['plname'] ? $memory['plname'] : $memory['name'];
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'input' => array('id' => 'portalid', 'pname' => 'plname'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'type' => 'batch',
			'sqlprj' => '`batchid`, `btname`, `resumes`, `notes`, `dept`, `course`, `year`',
			'sqlcnd' => "where `batchid` in \${list} order by `batchid` desc",
			'successmsg' => 'Batches information given successfully',
			'lsttrack' => true,
			'output' => array('entities' => 'batches'),
			'mapkey' => 'batchid',
			'mapname' => 'batch',
			'saction' => 'add'
		);
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batches', 'portalid', 'plname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz');
	}
	
}

?>
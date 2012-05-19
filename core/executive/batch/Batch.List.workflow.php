<?php 
require_once(SBSERVICE);

/**
 *	@class BatchListWorkflow
 *	@desc Returns all batches information in portal
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param portalid/id long int Portal ID [memory] optional default STUDENT_PORTAL_ID
 *	@param plname/name string Portal name [memory] optional default ''
 *	@param filter string Filter [memory] optional default false
 *	@param year string Year [memory] optional default false
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
			'optional' => array('user' => '', 'portalid' => false, 'id' => STUDENT_PORTAL_ID, 'plname' => false, 'name' => 'IT BHU', 'pgsz' => false, 'pgno' => 0, 'total' => false, 'padmin' => true, 'filter' => false, 'year' => false),
			'set' => array('filter', 'year', 'id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['portalid'] = $memory['portalid'] ? $memory['portalid'] : $memory['id'];
		$memory['plname'] = $memory['plname'] ? $memory['plname'] : $memory['name'];
		
		$args = $esc = array();
		$qry = '';
		if($memory['filter']){
			if(is_numeric($memory['filter'])){
				$memory['year'] = $memory['filter'];
				$memory['dept'] = false;
				$qry = "and `year`=\${year}";
				array_push($args, 'year');
			}
			elseif(in_array($memory['filter'], array('cer', 'che', 'civ', 'cse', 'eee', 'ece', 'mec', 'met', 'min', 'phe', 'apc', 'apm', 'app', 'bce', 'bme', 'mst'))){
				$memory['dept'] = $memory['filter'];
				$qry = "and `dept`='\${dept}'";
				array_push($args, 'dept');
				array_push($esc, 'dept');
				
				if($memory['year']){
					$qry .= " and `year`=\${year}";
					array_push($args, 'year');
				}
			}
		}
		else {
			$memory['dept'] = false;
		}
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'input' => array('id' => 'portalid', 'pname' => 'plname'),
			'args' => $args,
			'conn' => 'exconn',
			'relation' => '`batches`',
			'type' => 'batch',
			'sqlprj' => "`batchid`, `btname`, `resumes`, `notes`, `dept`, `course`,`year`",
			'sqlcnd' => "where `batchid` in \${list} $qry order by `year` desc, `dept` asc, `course` asc",
			'escparam' => $esc,
			'successmsg' => 'Batches information given successfully',
			//'lsttrack' => true,
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
		return array('batches', 'id', 'portalid', 'plname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz', 'dept', 'year');
	}
	
}

?>
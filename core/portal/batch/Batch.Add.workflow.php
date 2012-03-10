<?php 
require_once(SBSERVICE);

/**
 *	@class BatchAddWorkflow
 *	@desc Adds new batch
 *
 *	@param btname string Batch name [memory]
 *	@param dept string Department [memory]
 *	@param course string Course [memory]
 *	@param year integer Year [memory] 
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param portalid long int Portal ID [memory] optional default 0
 *	@param plname string Portal Name [memory] optional default ''
 *	@param level integer Web level [memory] optional default false (inherit portal admin access)
 *	@param owner long int Owner ID [memory] optional default keyid
 *
 *	@return batchid long int Batch ID [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return plname string Portal Name [memory]
 *	@return batch array Batch information [memory]
 *	@return chain array Chain information [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'btname', 'dept', 'course', 'year'),
			'optional' => array('portalid' => 0, 'plname' => '', 'level' => false, 'owner' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['verb'] = 'added';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.add.workflow',
			'args' => array('btname', 'dept', 'course', 'year'),
			'input' => array('parent' => 'portalid', 'cname' => 'statement', 'pname' => 'plname'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'type' => 'batch',
			'sqlcnd' => "(`batchid`, `owner`, `btname`, `dept`, `course`, `year`) values (\${id}, \${owner}, '\${statement}', '\${dept}', '\${course}', \${year})",
			'escparam' => array('btname', 'dept', 'course'),
			'successmsg' => 'Batch added successfully',
			'output' => array('id' => 'batchid')
		),
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'batchid', 'parent' => 'portalid', 'cname' => 'name', 'plname' => 'plname'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "where `batchid`=\${id}",
			'errormsg' => 'Invalid Batch ID',
			'type' => 'batch',
			'successmsg' => 'Batch information given successfully',
			'output' => array('entity' => 'batch'),
			'auth' => false,
			'track' => false,
			'sinit' => false
		),
		array(
			'service' => 'guard.chain.info.workflow',
			'input' => array('chainid' => 'portalid'),
			'output' => array('chain' => 'pchain')
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
		
		$memory['padmin'] = $memory['admin'];
		$memory['admin'] = 1;
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batchid', 'portalid', 'plname', 'batch', 'chain', 'pchain', 'admin', 'padmin');
	}
	
}

?>
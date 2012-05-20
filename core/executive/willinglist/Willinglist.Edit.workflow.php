<?php 
require_once(SBSERVICE);

/**
 *	@class WillinglistEditWorkflow
 *	@desc Edits willinglist using ID
 *
 *	@param wgltid long int Willinglist ID [memory]
 *	@param name string Name [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param batchid long int Batch ID [memory] optional default 0
 *	@param btname string Batch Name [memory] optional default ''
 *
 *	@return wgltid long int Willinglist ID [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return btname string Batch Name [memory]
 *	@return willinglist array Willinglist information [memory]
 *	@return chain array Chain information [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillinglistEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'wgltid', 'name', 'batchid', 'btname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){		
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.edit.workflow',
			'args' => array('name'),
			'input' => array('id' => 'wgltid', 'cname' => 'name', 'parent' => 'batchid', 'btname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`willinglists`',
			'type' => 'willinglist',
			'sqlcnd' => "set `name`='\${name}' where `wgltid`=\${id}",
			'escparam' => array('name'),
			'check' => false,
			'successmsg' => 'Willinglist edited successfully'
		),
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'wgltid', 'parent' => 'batchid', 'cname' => 'name', 'btname' => 'btname'),
			'conn' => 'exconn',
			'relation' => '`willinglists`',
			'sqlprj' => '`wgltid`, `batchid`, `visitid`, `name`',
			'sqlcnd' => "where `wgltid`=\${id}",
			'errormsg' => 'Invalid Willinglist ID',
			'type' => 'willinglist',
			'successmsg' => 'Willinglist information given successfully',
			'output' => array('entity' => 'willinglist'),
			'auth' => false,
			'track' => false,
			'sinit' => false
		),
		array(
			'service' => 'guard.chain.info.workflow',
			'input' => array('chainid' => 'batchid'),
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
		return array('wgltid', 'batchid', 'btname', 'willinglist', 'chain', 'pchain', 'admin', 'padmin');
	}
	
}

?>
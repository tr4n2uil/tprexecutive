<?php 
require_once(SBSERVICE);

/**
 *	@class CutoffReplyWorkflow
 *	@desc Replies cutoff using ID
 *
 *	@param ctfid long int Cutoff ID [memory]
 *	@param reply string Cutoff reply [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param visitid long int Visit ID [memory] optional default 0
 *	@param pname string Visit Name [memory] optional default ''
 *
 *	@return ctfid long int Cutoff ID [memory]
 *	@return visitid long int Visit ID [memory]
 *	@return pname string Visit Name [memory]
 *	@return cutoff array Cutoff information [memory]
 *	@return chain array Chain information [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CutoffReplyWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'ctfid', 'reply', 'visitid', 'pname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['verb'] = 'replied';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.edit.workflow',
			'args' => array('reply'),
			'input' => array('id' => 'ctfid', 'cname' => 'reply'),
			'init' => false,
			'conn' => 'exconn',
			'relation' => '`cutoffs`',
			'type' => 'cutoff',
			'sqlcnd' => "set `reply`='\${reply}' where `ctfid`=\${id}",
			'escparam' => array('reply'),
			'check' => false,
			'successmsg' => 'Cutoff replied successfully'
		),
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'ctfid', 'parent' => 'visitid', 'cname' => 'name', 'pname' => 'pname'),
			'conn' => 'exconn',
			'relation' => '`cutoffs`',
			'sqlcnd' => "where `ctfid`=\${id}",
			'errormsg' => 'Invalid Cutoff ID',
			'type' => 'cutoff',
			'successmsg' => 'Cutoff information given successfully',
			'output' => array('entity' => 'cutoff'),
			'auth' => false,
			'track' => false,
			'chadm' => false
		),
		array(
			'service' => 'guard.chain.info.workflow',
			'input' => array('chainid' => 'visitid'),
			'output' => array('chain' => 'pchain')
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory['padmin'] = 1;
		$memory['admin'] = 1;
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('visitid', 'pname', 'cutoff', 'chain', 'pchain', 'admin', 'padmin');
	}
	
}

?>
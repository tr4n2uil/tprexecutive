<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileInfoWorkflow
 *	@desc Returns profile information by ID
 *
 *	@param prid long int Profile ID [memory]
 *
 *	@return profile array Profile information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('prid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Profile information given successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.relation.unique.workflow',
			'args' => array('prid'),
			'conn' => 'exconn',
			'relation' => '`profiles`',
			'sqlcnd' => "where `prid`=\${prid}",
			'errormsg' => 'Invalid Profile ID',
			'output' => array('result' => 'profile')
		),
		array(
			'service' => 'sb.reference.read.workflow',
			'input' => array('id' => 'prid')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('profile');
	}
	
}

?>
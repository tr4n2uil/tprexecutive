<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileRemoveWorkflow
 *	@desc Removes profile by ID
 *
 *	@param prid long int Profile ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'prid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Profile removed successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.remove.workflow',
			'parent' => 0,
			'type' => 'child',
			'input' => array('id' => 'prid')
		),
		array(
			'service' => 'sb.relation.delete.workflow',
			'args' => array('prid'),
			'conn' => 'exconn',
			'relation' => '`profiles`',
			'sqlcnd' => "where `prid`=\${prid}",
			'errormsg' => 'Invalid Profile ID'
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
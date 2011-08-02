<?php 
require_once(SBSERVICE);

/**
 *	@class SlotListWorkflow
 *	@desc Returns all slots information for owner
 *
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return slots array Slots information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class SlotListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Slots information given successfully';
		
		$service = array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('keyid'),
			'conn' => 'exconn',
			'relation' => '`slots`',
			'sqlcnd' => "where `owner`=\${keyid} order by `type`, `status` desc",
			'output' => array('result' => 'slots')
		);
		
		return $kernel->run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('slots');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class SlotRemoveWorkflow
 *	@desc Removes slot by ID
 *
 *	@param slotid long int Slot ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class SlotRemoveWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'slotid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Slot removed successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.remove.workflow',
			'parent' => 0,
			'type' => 'child',
			'input' => array('id' => 'slotid')
		),
		array(
			'service' => 'sb.relation.update.workflow',
			'args' => array('slotid'),
			'conn' => 'exconn',
			'relation' => '`slots`',
			'sqlcnd' => "set status=0, dtime=now() where `slotid`=\${slotid}",
			'errormsg' => 'Invalid Slot ID'
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
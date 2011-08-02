<?php 
require_once(SBSERVICE);

/**
 *	@class SlotAddWorkflow
 *	@desc Adds new slot
 *
 *	@param name string Company name [memory]
 *	@param type integer Slot type [memory] (1, 2)
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return slotid long int Slot ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class SlotAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'name', 'type')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Slot added successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.add.workflow',
			'parent' => 1,
			'level' => 1,
			'type' => 'child',
			'output' => array('id' => 'slotid')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('slotid', 'name', 'type', 'keyid'),
			'conn' => 'exconn',
			'relation' => '`slots`',
			'sqlcnd' => "(`slotid`, `name`, `type`, `owner`, `status`, `ctime`) values (\${slotid}, '\${name}', \${type}, \${keyid}, 1, now())",
			'escparam' => array('name')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('slotid');
	}
	
}

?>
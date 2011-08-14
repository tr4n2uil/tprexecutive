<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingAddWorkflow
 *	@desc Adds new proceeding to company
 *
 *	@param name string Proceeding name [memory]
 *	@param year string Proceeding year [memory]
 *	@param type string Proceeding type [memory] ('Training', 'Placement')
 *	@param eligibility float Eligibility CGPA [memory]
 *	@param margin float Margin CGPA [memory] optional default 0.0
 *	@param max integer Maximum applications [memory] optional default 85
 *	@param deadline string Deadline time [memory] (YYYY-MM-DD hh:mm:ss format)
 *	@param rejection string Rejection list [memory] optional default '0'
 *	@param keyid long int Usage Key ID [memory]
 *	@param owner long int Owner ID [memory] optional default keyid
 *	@param comid long int Company ID [memory]
 *
 *	@return procid long int Proceeding ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'name', 'comid', 'year', 'type', 'eligibility', 'deadline'),
			'optional' => array('owner' => false, 'max' => 85, 'rejection' => '0', 'margin' => 0.0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Proceeding added successfully';
		$memory['owner'] = $memory['owner'] ? $memory['owner'] : $memory['keyid'];
		
		$workflow = array(
		array(
			'service' => 'gridevent.event.add.workflow',
			'input' => array('seriesid' => 'comid'),
			'authorize' => 'edit:add:remove',
			'level' => 2,
			'output' => array('eventid' => 'procid')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('procid', 'name', 'owner', 'year', 'type', 'eligibility', 'margin', 'max', 'deadline'),
			'conn' => 'exconn',
			'relation' => '`proceedings`',
			'sqlcnd' => "(`procid`, `name`, `owner`, `year`, `type`, `eligibility`, `margin`, `max`, `deadline`) values (\${procid}, '\${name}', \${owner}, '\${year}', '\${type}', \${eligibility}, \${margin}, \${max}, '\${deadline}')",
			'escparam' => array('name', 'year', 'deadline', 'type')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('procid');
	}
	
}

?>
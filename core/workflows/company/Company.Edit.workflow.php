<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyEditWorkflow
 *	@desc Edits company using ID
 *
 *	@param comid long int Company ID [memory]
 *	@param name string Company name [memory]
 *	@param type integer Company type [memory] (1, 2)
 *	@param eligibility float Eligibility CGPA [memory]
 *	@param margin float Margin CGPA [memory]
 *	@param max integer Maximum applications [memory]
 *	@param rejection string Rejection list [memory]
 *	@param deadline string Deadline [memory] (YYYY-MM-DD hh:mm:ss format)
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'comid', 'name', 'type', 'eligibility', 'margin', 'deadline', 'max', 'rejection')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Company edited successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.authorize.workflow',
			'id' => 0,
			'type' => 'edit'
		),
		array(
			'service' => 'sb.relation.update.workflow',
			'args' => array('comid', 'name', 'type', 'eligibility', 'margin', 'deadline', 'max', 'rejection'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "set `name`='\${name}', `type`=\${type}, `eligibility`=\${eligibility}, `margin`=\{margin}, `deadline`='\${deadline}', `max`=\${max}, `rejection`='\${rejection}' where `comid`=\${comid}",
			'escparam' => array('name', 'deadline', 'rejection')
		),
		array(
			'service' => 'sb.reference.write.workflow',
			'input' => array('id' => 'comid')
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
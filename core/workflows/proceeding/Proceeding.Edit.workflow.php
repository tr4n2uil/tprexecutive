<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingEditWorkflow
 *	@desc Edits proceeding using ID
 *
 *	@param procid long int Proceeding ID [memory]
 *	@param type string Proceeding type [memory] ('Training', 'Placement')
 *	@param eligibility float Eligibility CGPA [memory]
 *	@param margin float Margin CGPA [memory]
 *	@param max integer Maximum applications [memory]
 *	@param deadline string Deadline time [memory] (YYYY-MM-DD hh:mm:ss format)
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'procid', 'year', 'type', 'eligibility', 'margin', 'deadline', 'max')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Proceeding edited successfully';
		
		$workflow = array(
		array(
			'service' => 'ad.reference.authorize.workflow',
			'input' => array('id' => 'procid')
		),
		array(
			'service' => 'ad.relation.update.workflow',
			'args' => array('procid', 'year', 'type', 'eligibility', 'margin', 'deadline', 'max'),
			'conn' => 'exconn',
			'relation' => '`proceedings`',
			'sqlcnd' => "set `year`='\${year}', `type`='\${type}', `eligibility`=\${eligibility}, `margin`=\${margin}, `deadline`='\${deadline}', `max`=\${max} where `procid`=\${procid}",
			'escparam' => array('year', 'deadline', 'type')
		),
		array(
			'service' => 'ad.reference.write.workflow',
			'input' => array('id' => 'procid')
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
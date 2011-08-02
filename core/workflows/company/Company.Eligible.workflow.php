<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyEligibleWorkflow
 *	@desc Returns company eligible profiles
 *
 *	@param eligibility float Eligibility CGPA [memory]
 *	@param margin float Margin CGPA [memory] optional default 0.0
 *	@param type integer Company type [memory] (1, 2)
 *	@param max integer Maximum applications [memory] optional default 85
 *	@param rejection string Rejection list [memory] optional default '0'
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return profiles array Company eligible profiles information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'eligibility', 'type'),
			'optional' => array('max' => 85, 'rejection' => '0', 'margin' => 0.0)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Company eligible profiles given successfully';
		
		$service = array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('keyid', 'eligibility', 'max', 'rejection'),
			'conn' => 'exconn',
			'relation' => '`profiles`',
			'sqlcnd' => "where `cgpa` >= (\${cgpa} - \${margin}) and `prid` not in (\${rejection}) and (case \type when 1 then (select count(`slotid`)<5 from `slots` where `owner`=\${keyid} and `type`=1) when 2 then (select count(`slotid`)<2 from `slots` where `owner`=\${keyid} and `type`=2) end) limit \${max}",
			'escparam' => array('rejection'),
			'errormsg' => 'Invalid Eligibility Parameters',
			'output' => array('result' => 'profiles')
		);
		
		return $kernel->run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('profiles');
	}
	
}

?>
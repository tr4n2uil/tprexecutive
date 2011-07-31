<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyAddWorkflow
 *	@desc Adds new company
 *
 *	@param name string Company name [memory]
 *	@param type integer Company type [memory] (1, 2)
 *	@param eligibility float Eligibility CGPA [memory]
 *	@param max integer Maximum applications [memory] optional default 85
 *	@param rejection string Rejection list [memory] optional default '0'
 *	@param deadline string Deadline [memory] (YYYY-MM-DD hh:mm:ss format)
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return comid long int Company ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'name', 'type', 'eligibility', 'deadline'),
			'optional' => array('max' => 85, 'rejection' => '0')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Company added successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.add.workflow',
			'parent' => 0,
			'output' => array('id' => 'comid')
		),
		array(
			'service' => 'cloudview.content.add.workflow',
			'cntname' => 'home-'.$memory['name'],
			'cntstype' => 2,
			'cntstyle' => 'style-company-home',
			'cntttype' => 2,
			'cnttpl' => 'tpl-company-home',
			'cntdtype' => 1,
			'cntdata' => json_encode(array('threshold' => 3)),
			'output' => array('cntid' => 'home')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('comid', 'name', 'type', 'deadline', 'eligibility', 'max', 'rejection', 'home'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "(`comid`, `name`, `type`, `deadline`, `eligibility`, `max`, `rejection`, `home`) values (\${comid}, '\${name}', \${type}, '\${deadline}', \${eligibility}, \${max}, '\${rejection}', \${home})",
			'escparam' => array('name', 'deadline', 'rejection')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('comid');
	}
	
}

?>
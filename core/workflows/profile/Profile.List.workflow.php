<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileListWorkflow
 *	@desc Returns all profiles information in group 0
 *
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return profiles array Profiles information [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileListWorkflow implements Service {
	
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
	
		$memory['msg'] = 'Profile information given successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.children.workflow',
			'id' => 0,
			'type' => 'list'
		),
		array(
			'service' => 'sbcore.data.list.service',
			'args' => array('children')
		),
		array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('list'),
			'conn' => 'exconn',
			'relation' => '`profiles`',
			'sqlcnd' => "where `prid` in \${list} order by `cgpa` desc",
			'escparam' => array('list'),
			'output' => array('result' => 'profiles')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('profiles');
	}
	
}

?>
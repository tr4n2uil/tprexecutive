<?php 
require_once(SBSERVICE);

/**
 *	@class StudentStageWorkflow
 *	@desc Returns all students information within stage of proceeding
 *
 *	@param stageid long int Stage ID [memory]
 *	@param eventid long int Event ID [memory] optional default 0
 *	@param ename string Event name [memory] optional default ''
 *	@param stname string Stage name [memory] optional default ''
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@return students array Students information [memory]
 *	@return ename string Event name [memory]
 *	@return eventid long int Event ID [memory]
 *	@return stname string Stage name [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentStageWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'stageid'),
			'optional' => array('eventid' => 0, 'ename' => '', 'stname' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['msg'] = 'Student stage information given successfully';
		
		$workflow = array(
		array(
			'service' => 'gridevent.selection.stage.workflow'
		),
		array(
			'service' => 'sbcore.data.list.service',
			'args' => array('selections'),
			'attr' => 'owner',
			'default' => array(0)
		),
		array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('list'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "where `owner` in \${list} order by `cgpa` desc",
			'escparam' => array('list'),
			'check' => false,
			'output' => array('result' => 'students')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('students', 'ename', 'eventid', 'stname', 'admin');
	}
	
}

?>
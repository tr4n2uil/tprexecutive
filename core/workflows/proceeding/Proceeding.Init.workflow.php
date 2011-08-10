<?php 
require_once(SBSERVICE);

/**
 *	@class ProceedingInitWorkflow
 *	@desc Initializes the proceeding with default list into selections
 *
 *	@param procid long int Proceeding ID [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProceedingInitWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'procid')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$workflow = array(
		array(
			'service' => 'sb.relation.unique.workflow',
			'args' => array('procid'),
			'conn' => 'exconn',
			'relation' => '`proceedings`',
			'sqlcnd' => "where `procid`=\${procid} and `deadline` >= now()",
			'errormsg' => 'Beyond Proceeding Deadline',
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0.eligibility' => 'eligibility', 'result.0.margin' => 'margin', 'result.0.max' => 'max', 'result.0.owner' => 'superuser')
		),
		array(
			'service' => 'gridevent.event.info.workflow',
			'input' => array('eventid' => 'procid')
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('event'),
			'params' => array('event.rejection' => 'rejection')
		),
		array(
			'service' => 'gridevent.stage.list.workflow',
			'input' => array('eventid' => 'procid', 'keyid' => 'superuser'),
			'asc' => true
		),
		array(
			'service' => 'sbcore.data.select.service',
			'args' => array('stages'),
			'params' => array('stages.0.stageid' => 'stageid')
		),
		array(
			'service' => 'gridevent.event.selected.workflow',
			'select' => array(1 => 2, 2 => 1),
			'input' => array('eventid' => 'procid')
		),
		array(
			'service' => 'sbcore.data.list.service',
			'args' => array('selections'),
			'output' => array('result' => 'selected')
		),
		array(
			'service' => 'sb.relation.select.workflow',
			'args' => array('eligibility', 'margin', 'max', 'rejection'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlprj' => 'owner',
			'sqlcnd' => "where `cgpa` >= (\${eligibility} - \${margin}) and `owner` not in (\${rejection}) limit \${max}",
			'escparam' => array('rejection'),
			'check' => false,
			'output' => array('result' => 'eligible')
		),
		array(
			'service' => 'sbcore.data.list.service',
			'args' => array('eligible'),
			'output' => array('result' => 'eligible')
		));
		
		$memory = $kernel->execute($workflow, $memory);
		
		if(!$memory['valid'])
			return $memory;
		
		$superuser = $memory['superuser'];
		$stageid = $memory['stageid'];
		$eventid = $memory['procid'];
		$students = array_diff($memory['eligible'], $memory['selected']);
		
		if(count($students)){
			foreach($students as $student){
				$service = array(
					'service' => 'gridevent.selection.add.workflow',
					'keyid' => $superuser,
					'owner' => $student,
					'stageid' => $stageid,
					'eventid' => $eventid
				);
				$memory = $kernel->run($service);
				if(!$memory['valid'])
					return $memory;
			}
		}
		
		$memory['valid'] = true;
		$memory['msg'] = 'Proceeding initialized successfully';
		$memory['status'] = 200;
		$memory['details'] = 'Successfully executed';
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>
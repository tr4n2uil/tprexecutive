<?php 
require_once(SBSERVICE);

/**
 *	@class StudentUpdateWorkflow
 *	@desc Updates student using ID
 *
 *	@param stuid long int Student ID [memory]
 *	@param phone string Phone [memory]
 *	@param cgpa float CGPA [memory]
 *	@param interests string Interests [memory]
 *	@param sgpa1 float SGPA I [memory]
 *	@param sgpa2 float SGPA II [memory]
 *	@param sgpa3 float SGPA III [memory]
 *	@param sgpa4 float SGPA IV [memory]
 *	@param sgpa5 float SGPA V [memory]
 *	@param sgpa6 float SGPA VI [memory]
 *	@param sgpa7 float SGPA VII [memory]
 *	@param sgpa8 float SGPA VIII [memory]
 *	@param sgpa9 float SGPA IX [memory]
 *	@param sgpa10 float SGPA X [memory]
 *	@param ygpa1 float YGPA I [memory]
 *	@param ygpa2 float YGPA II [memory]
 *	@param ygpa3 float YGPA III [memory]
 *	@param ygpa4 float YGPA IV [memory]
 *	@param ygpa5 float YGPA V [memory]
 *	@param keyid long int Usage Key ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentUpdateWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'stuid', 'phone', 'cgpa', 'interests', 'sgpa1', 'sgpa2', 'sgpa3', 'sgpa4', 'sgpa5', 'sgpa6', 'sgpa7', 'sgpa8', 'sgpa9', 'sgpa10', 'ygpa1', 'ygpa2', 'ygpa3', 'ygpa4', 'ygpa5')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
	
		$memory['msg'] = 'Student updated successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.authorize.workflow',
			'input' => array('id' => 'stuid'),
			'type' => 'edit'
		),
		array(
			'service' => 'sb.relation.update.workflow',
			'args' => array('stuid', 'phone', 'cgpa', 'interests', 'sgpa1', 'sgpa2', 'sgpa3', 'sgpa4', 'sgpa5', 'sgpa6', 'sgpa7', 'sgpa8', 'sgpa9', 'sgpa10', 'ygpa1', 'ygpa2', 'ygpa3', 'ygpa4', 'ygpa5'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "set `phone`='\${phone}', `cgpa`=\${cgpa}, `interests`='\${interests}', `sgpa1`=\${sgpa1}, `sgpa2`=\${sgpa2}, `sgpa3`=\${sgpa3}, `sgpa4`=\${sgpa4}, `sgpa5`=\${sgpa5}, `sgpa6`=\${sgpa6}, `sgpa7`=\${sgpa7}, `sgpa8`=\${sgpa8}, `sgpa9`=\${sgpa9}, `sgpa10`=\${sgpa10}, `ygpa1`=\${ygpa1}, `ygpa2`=\${ygpa2}, `ygpa3`=\${ygpa3}, `ygpa4`=\${ygpa4}, `ygpa5`=\${ygpa5} where `stuid`=\${stuid}",
			'escparam' => array('phone', 'interests')
		),
		array(
			'service' => 'sb.reference.write.workflow',
			'input' => array('id' => 'stuid')
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